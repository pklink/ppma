<?php


class CSVAction extends CAction
{

    /**
     * @return void
     */
    public function run()
    {
        $model = new ImportCsvUploadForm();

        // upload form (first step) was submitted
        if (isset($_POST['ImportCsvUploadForm'])) {
            $model->attributes = $_POST['ImportCsvUploadForm'];

            // validate upload
            if ($model->validate()) {
                $models = array();

                // get file
                $file        = CUploadedFile::getInstance($model, 'file');
                $fileContent = trim(file_get_contents($file->tempName));
                $fileLines   = explode("\n", $fileContent);

                // relations between CSV and ImportCsvForm
                $csvToObject = array(
                    0 => 'name',
                    1 => 'url',
                    2 => 'comment',
                    3 => 'tags',
                    4 => 'username',
                    5 => 'password'
                );

                // traverse uploaded file per line
                foreach ($fileLines as $index => $line) {
                    // skip first line (header)
                    if ($index == 0) {
                        continue;
                    }

                    // parse line to array
                    $csv = str_getcsv($line);

                    if (count($csv) < 1) {
                        continue;
                    }

                    // create model
                    $tmpModel = new ImportCsvForm();

                    // set array values to model
                    foreach ($csvToObject as $position => $name) {
                        if (!isset($csv[$position])) {
                            break;
                        }

                        $tmpModel->{$csvToObject[$position]} = $csv[$position];
                    }

                    $models[] = $tmpModel;
                }
            }
        } elseif (isset($_POST['ImportCsvForm'])) { // import
            $models = array();
            $valid = true;

            foreach ($_POST['ImportCsvForm'] as $data) {
                $model = new ImportCsvForm();
                $model->attributes = $data;
                $valid = $model->validate();

                $models[] = $model;

                if (!$valid) {
                    Yii::app()->user->setFlash('hasError', true);
                }
            }

            if ($valid) {
                foreach ($models as $model) {
                    $entry = new Entry('create');
                    $entry->name = $model->name;
                    $entry->url = $model->url;
                    $entry->username = $model->username;
                    $entry->password = $model->password;
                    $entry->tagList = $model->tags;
                    $entry->comment = $model->comment;
                    $entry->save();
                    $entry->resaveTags();
                }

                Yii::app()->user->setFlash('success', 'Your CSV was successfully imported!');
                $this->controller->redirect(array('/entry/index'));
            }
        }
        // render upload form
        if (!isset($models)) {
            $this->controller->render('csv-upload', array('model' => $model, 'maxImport' => ceil(ini_get('max_input_vars') / 6)));
        } else { // render import form
            $this->controller->render('csv-import', array('models' => $models));
        }
    }

}
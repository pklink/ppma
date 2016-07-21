<?php


class PHPPassManagerAction extends CAction
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
                    1 => 'name',
                    3 => 'username',
                    4 => 'url',
                    5 => 'password',
                    6 => 'hash',
                    7 => 'iv',
                    8 => 'comment'
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
                    $tmpModel = new ImportPhpPassManagerForm();

                    // set array values to model
                    foreach ($csvToObject as $position => $name) {
                        if (!isset($csv[$position])) {
                            break;
                        }

                        $tmpModel->{$csvToObject[$position]} = $csv[$position];
                    }

                    // encode encrypted password and iv
                    $tmpModel->password = base64_encode($tmpModel->password);
                    $tmpModel->iv       = base64_encode($tmpModel->iv);

                    $models[] = $tmpModel;
                }
            }
        } elseif (isset($_POST['ImportPhpPassManagerForm'])) { // import
            $models = array();
            $valid = true;

            foreach ($_POST['ImportPhpPassManagerForm'] as $data) {
                $model = new ImportPhpPassManagerForm();
                $model->attributes = $data;
                $valid = $model->validate();

                $models[] = $model;

                if (!$valid) {
                    Yii::app()->user->setFlash('hasError', true);
                }
            }

            if ($valid) {
                /* @var PhpPassManagerDecryptorComponent $decryptor */
                $decryptor = Yii::app()->phpPassManagerDecryptor;

                /* @var ImportPhpPassManagerForm[] $models */
                foreach ($models as $model) {
                    $iv       = base64_decode($model->iv);
                    $password = base64_decode($model->password);
                    $password = $decryptor->decrypt($password, $model->masterPassword, $iv);

                    $entry = new Entry('create');
                    $entry->name = $model->name;
                    $entry->url = $model->url;
                    $entry->username = $model->username;
                    $entry->password = $password;
                    $entry->comment = $model->comment;
                    $entry->tagList = 'import';
                    $entry->save();
                    $entry->resaveTags();
                }

                Yii::app()->user->setFlash('success', 'Your CSV was successfully imported!');
                $this->controller->redirect(array('/entry/index'));
            }
        }

        // render upload form
        if (!isset($models)) {
            $this->controller->render('phppassmanager-upload', array(
                'model'     => $model,
                'maxImport' => ceil(ini_get('max_input_vars') / 13)
            ));
        } else { // render import form
            $this->controller->render('phppassmanager-import', array(
                'models' => $models
            ));
        }
    }

}
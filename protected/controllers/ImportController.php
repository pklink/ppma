<?php

class ImportController extends Controller
{

    /**
     *
     * @var string
     */
    public $layout = 'column2';


    /**
     *
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('csv'),
                'users' => array('@'),
                'expression' => 'Yii::app()->user->isAdmin',
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }


    /**
     *
     * @return void
     */
    public function actionCsv()
    {
        $model = new ImportCsvUploadForm();

        // upload form (first step) was submitted
        if (isset($_POST['ImportCsvUploadForm'])) {
            $model->attributes = $_POST['ImportCsvUploadForm'];

            // validate upload
            if ($model->validate()) {
                $models = array();

                // get file
                $file = CUploadedFile::getInstance($model, 'file');
                $fileContent = trim(file_get_contents($file->tempName));
                $fileLines = explode("\n", $fileContent);

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
                    foreach ($csvToObject as $index => $name) {
                        if (!isset($csv[$index])) {
                            break;
                        }

                        $tmpModel->$csvToObject[$index] = $csv[$index];
                    }

                    $models[] = $tmpModel;
                }
            }
        } elseif (isset($_POST['ImportCsvForm'])) { // import
            //var_dump($_POST);die();
            $models = array();
            $valid = true;

            foreach ($_POST['ImportCsvForm'] as $index => $data) {
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
                $this->redirect(array('/entry/index'));
            }
        }
        // render upload form
        if (!isset($models)) {
            $this->render('csv-upload', array('model' => $model));
        } else { // render import form
            $this->render('csv-import', array('models' => $models));
        }
    }


    /**
     * (non-PHPdoc)
     * @see yii/web/CController#filters()
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
        ), parent::filters());
    }

}
<?php

class TagController extends Controller
{

    /**
     * @var string
     */
    public $layout = 'column2';

    /**
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('create', 'delete', 'index', 'update'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        // create model
        $model = new Tag('create');

        // form is submitted
        if (isset($_POST['Tag'])) {
            $model->attributes = $_POST['Tag'];

            // save model & redirect to list
            if ($model->save()) {
                // set flash
                Yii::app()->user->setFlash('success', 'The tag was created successfully.');

                // redirect to index
                $this->redirect(array('index'));
            }
        }

        // render view
        $this->render('create', array('model' => $model));
    }

    /**
     * @param int $id
     */
    public function actionDelete($id)
    {
        // get model
        $model = $this->loadModel($id);

        // if is not a post request => show form
        if (!Yii::app()->request->isPostRequest) {
            $this->render('delete', array('model' => $model));
            Yii::app()->end();
        }

        // delete entry
        $model->delete();

        // redirect if is not a ajax request
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(array('index'));
        }
    }

    /**
     * @param int $id
     * @return CActiveRecord
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        $model = Tag::model()->findbyPk($id);

        if ($model === null) {
            throw new CHttpException(404);
        } elseif ($model->userId != Yii::app()->user->id) {
            throw new CHttpException(403);
        }

        return $model;
    }

    /**
     * @return void
     */
    public function actionIndex()
    {
        $model = new Tag('search');
        $model->userId = Yii::app()->user->id;

        /* @var CHttpRequest $request */
        $request = Yii::app()->request;

        if ($request->getQuery('pagesize') != null) {
            /* @var Setting $setting */
            /** @noinspection PhpUndefinedMethodInspection */
            $setting = Setting::model()->name(Setting::PAGINATION_PAGE_SIZE_TAGS)->find();
            $pageSize = CPropertyValue::ensureInteger($request->getQuery('pagesize'));

            if ($pageSize > 0) {
                $setting->value = $pageSize;
                $setting->save();
            }
        }

        if (isset($_GET['Tag'])) {
            $model->attributes = $_GET['Tag'];
        }

        $this->render('index', array(
            'model' => $model,
        ));

    }

    /**
     * @param int $id
     * @return void
     */
    public function actionUpdate($id)
    {
        // get model
        $model = $this->loadModel($id);

        // check if form submitted and valid
        if (isset($_POST['Tag'])) {
            $model->attributes = $_POST['Tag'];

            // save entry
            if ($model->save()) {
                // set flash
                Yii::app()->user->setFlash('success', 'The tag was updated successfully.');

                // redirect to index
                $this->redirect(Yii::app()->request->getPost('returnUrl', array('index')));
            }
        }

        // render view
        $this->render('update', array('model' => $model));
    }

    /**
     * @return array
     */
    public function filters()
    {
        return array_merge(array(
            'accessControl',
        ), parent::filters());
    }
}

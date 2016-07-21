<?php

class EntryController extends Controller
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
                'actions' => array('create', 'delete', 'getData', 'index', 'update', 'searchName'),
                'users' => array('@'),
            ),
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * @param string $term
     */
    public function actionSearchName($term)
    {
        // escape $term
        $term = CPropertyValue::ensureString($term);

        // create criteria
        $c = new CDbCriteria();
        $c->distinct = true;
        $c->addSearchCondition('name', $term);
        $c->limit = 5;

        // save results
        $result = array();
        foreach (Entry::model()->findAll($c) as $model) {
            /* @var Entry $model */
            $result[] = $model->name;
        }

        // output result as JSON
        echo CJSON::encode($result);
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        // create form
        $model = new Entry('create');

        // form is submitted
        if (isset($_POST['Entry'])) {
            $model->attributes = $_POST['Entry'];

            // save model & redirect to index
            if ($model->save()) {
                $model->resaveTags();

                // set flash
                Yii::app()->user->setFlash('success', 'The entry was created successfully.');

                // redirect to index
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * @param int $id
     * @throws CHttpException
     */
    public function actionDelete($id)
    {
        /* @var CHttpRequest $request */
        $request = Yii::app()->request;

        // get model
        $model = $this->loadModel($id);

        if (!$request->isPostRequest) {
            $this->render('delete', array('model' => $model));
            Yii::app()->end();
        }

        // delete entry
        $model->delete();

        // redirect on non-ajax-request
        if (!$request->isAjaxRequest) {
            $this->redirect(array('index'));
        }
    }

    /**
     * @param int $id
     * @return Entry
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        $model = Entry::model()->findbyPk($id);

        if ($model === null) {
            throw new CHttpException(404);
        } elseif ($model->userId != Yii::app()->user->id) {
            throw new CHttpException(403);
        }

        return $model;
    }

    /**
     * @param int $id
     * @param bool $withPassword
     * @throws CHttpException
     */
    public function actionGetData($id, $withPassword = false)
    {
        // only ajax-request are allowed
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400);
        }

        // load model
        $model = $this->loadModel($id);

        // prepare array for response
        $return = array();

        // save attributes
        foreach (array_keys($model->attributeLabels()) as $property) {
            if ($model->hasAttribute($property) && !is_object($model->$property)) {
                $id = CHtml::activeId($model, $property);
                $return[$id] = $model->$property;
            }
        }

        // save tags
        $id = CHtml::activeId($model, 'tagList');
        $return[$id] = $model->tagList;

        // save password if flag is setted
        if ($withPassword) {
            $id = CHtml::activeId($model, 'password');
            $return[$id] = $model->getPassword();

            // increment view counter
            $model->incrementViewCounter();
        }

        header('Content-type: application/json');
        echo CJSON::encode($return);
    }


    /**
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Entry('search');
        $model->userId = Yii::app()->user->id;


        /* @var CHttpRequest $request */
        $request = Yii::app()->request;

        if ($request->getQuery('pagesize') != null) {
            /* @var Setting $setting */
            /** @noinspection PhpUndefinedMethodInspection */
            $setting = Setting::model()->name(Setting::PAGINATION_PAGE_SIZE_ENTRIES)->find();
            $pageSize = CPropertyValue::ensureInteger($request->getQuery('pagesize'));

            if ($pageSize > 0) {
                $setting->value = $pageSize;
                $setting->save();
            }
        }

        if (isset($_GET['Entry'])) {
            $model->attributes = $_GET['Entry'];
        }

        $this->render('index', array(
            'model'     => $model,
            'returnUri' => Yii::app()->request->requestUri
        ));
    }


    /**
     *
     * @param int $id
     * @return void
     */
    public function actionUpdate($id)
    {
        /* @var Entry $model */

        // load form
        $model = $this->loadModel($id);

        // set scenario
        $model->scenario = 'update';

        // check if form submitted and valid
        if (isset($_POST['Entry'])) {
            $model->attributes = $_POST['Entry'];

            // save entry
            if ($model->save() && !Yii::app()->request->isAjaxRequest) {
                $model->resaveTags();

                // set flash
                Yii::app()->user->setFlash('success', 'The entry was saved successfully.');

                // redirect to index
                $this->redirect(Yii::app()->request->getPost('returnUrl', array('index')));
            }
        } else {
            $model->incrementViewCounter();
        }

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

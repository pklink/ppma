<?php

class TagController extends Controller
{

    /**
     *
     * @var string
     */
    public $layout = 'column2';


    /**
     *
     * @param int $id
     * @return void
     */
    protected function _loadModel($id)
    {
        $model = Tag::model()->findbyPk($id);

        if ($model === null)
        {
            throw new CHttpException(404);
        }
        else if ($model->userId != Yii::app()->user->id)
        {
            throw new CHttpException(403);
        }

        return $model;
    }


    /**
     *
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('create', 'delete', 'index', 'update'),
                'users'   => array('@'),
            ),
            array(
                'deny',
                'users'   => array('*'),
            ),
        );
    }
    
    
    /**
     *
     * @return void
     */
    public function actionCreate()
    {
        // create form
        $form = new CForm('application.views.tag.forms.form', new Tag('create'));

        // form is submitted
        if($form->submitted('create') && $form->validate())
        {
            // save model & redirect to list
            if($form->model->save(false))
            {
                $this->redirect(array('index'));
            }
        }

        // render view
        if (Yii::app()->request->isAjaxRequest)
        {
            $this->renderPartial('create', array('form' => $form));
        }
        else
        {
            $this->render('create', array('form' => $form));
        }
    }
    
    
    /**
     *
     * @paramt int $id
     * @return void
     */
    public function actionDelete($id)
    {
        // we only allow deletion via POST request
        if(!Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400);
        }

        // get model
        $model = $this->_loadModel($id);

        // delete entry
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!Yii::app()->request->isAjaxRequest)
        {
            $this->redirect(array('index'));
        }
    }
    
    
    /**
     * 
     * @return void
     */
    public function actionIndex()
    {
        $model = new Tag('search');
        $model->userId = Yii::app()->user->id;

        if(isset($_GET['Tag']))
        {
            $model->attributes = $_GET['Tag'];
        }

        $this->render('list', array(
            'model' => $model,
        ));
        
    }

    
    /**
     *
     * @param int $id
     * @return void
     */
    public function actionUpdate($id)
    {
        // create form
        $form = new CForm('application.views.tag.forms.form', $this->_loadModel($id));

        // set scenario
        $form->model->scenario = 'update';

        // check if form submitted and valid
        if($form->submitted('update') && $form->validate())
        {
            // save entry
            if($form->model->save(false))
            {
                // redirect to index
                $this->redirect(array('index'));
            }
        }

        // render view
        if (Yii::app()->request->isAjaxRequest)
        {
            $this->renderPartial('update', array('form' => $form));
        }
        else
        {
            $this->render('update', array('form' => $form));
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

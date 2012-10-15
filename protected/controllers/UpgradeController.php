<?php

class UpgradeController extends Controller
{

    /**
     * 
     * @return boolean
     */
    protected function _is0_2Installed()
    {
        return !is_null( Tag::model()->tableSchema->getColumn('userId') );
    }
    
    
    
    /**
     * 
     * @return void
     */
    protected function _upgradeTo0_2()
    {
        if ($this->_is0_2Installed())
        {
            Yii::app()->user->setFlash('failure', true);
            $this->redirect(array('index'));
        }
        
        // Add Tag-column
        $cmd = Yii::app()->db->createCommand();
        $cmd->addColumn('Tag', 'userId', 'integer NOT NULL');
        $cmd->addForeignKey('user', 'Tag', 'userId', 'User', 'id', 'CASCADE', 'CASCADE');

        // Refresh DB-Schema
        Yii::app()->db->schema->refresh();
        Tag::model()->refreshMetaData();
        
        // Set user-IDs
        foreach (Tag::model()->findAll() as $model)
        {
            // Collect User-IDs
            $userIds = array();
            foreach ($model->entries as $entry)
            {
                $userIds[$entry->userId] = $entry->userId;
            }
            
            // Save tag with user relation
            foreach ($userIds as $userId)
            {
                $tag = new Tag();
                $tag->name = $model->name;
                $tag->userId = $userId;
                $tag->save(false);
            }
            
            // Remove tag
            $model->delete();
        }
        
        Yii::app()->user->setFlash('version', 0.2);
        $this->redirect(array('upgrade/success'));
    }
    

    /**
     *
     * @return void
     */
    public function actionIndex($version = '0.2')
    {
        $version = str_replace('.', '_', $version);
        
        if (method_exists($this, '_upgradeTo' . $version) && !Yii::app()->user->hasFlash('failure'))
        {
            $this->{'_upgradeTo' . $version}();
        }
        else
        {
            $this->render('ready');
        }
    }
    
    
    /**
     * 
     * @return void
     */
    public function actionSuccess()
    {
        if (!Yii::app()->user->hasFlash('version'))
        {
            $this->redirect(array('index'));
        }
        
        $this->render('success', array('version' => Yii::app()->user->getFlash('version')));
    }

}
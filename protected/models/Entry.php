<?php

/**
 *
 * @property string  $comment
 * @property string  $encryptedPassword
 * @property integer $id
 * @property string  $identifier
 * @property string  $name
 * @property string  $password
 * @property string  $tagList
 * @property Tag[]   $tags
 * @property string  $url
 * @property User    $user
 * @property integer $userId
 * @property string  $username
 * @property int     $viewCount
 */
class Entry extends CActiveRecord
{

    /**
     * (non-PHPdoc)
     * @see yii/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'comment'   => 'Comment',
            'id'        => 'ID',
            'name'      => 'Name',
            'password'  => 'Password',
            'tagList'   => 'Tags',
            'url'       => 'URL',
            'userId'    => 'User',
            'username'  => 'Username',
            'viewCount' => 'View Count'
        );
    }


    /**
     * (non-PHPdoc)
     * @see yii/CActiveRecord#afterDelete()
     */
    public function afterDelete()
    {
        $this->deleteTags();
        return parent::afterDelete();
    }


    /**
     * (non-PHPdoc)
     * @see yii/CActiveRecord#afterSave()
     */
    public function afterSave()
    {
        // delete all tag relations
        $this->deleteTags();

        // save tags and tag relations
        foreach ($this->tags as $tag)
        {
            // try to receive tag from db
            $model = Tag::model()->name( $tag->name )->userId( Yii::app()->user->id )->find();

            if (!is_object($model))
            {
                $model = $tag;
            }

            // save tag
            $model->name = $tag->name;
            $model->save();

            // save relation
            $relation = new EntryHasTag();
            $relation->entryId = $this->id;
            $relation->tagId   = $model->id;
            $relation->save();
        }

        return parent::afterSave();
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#beforeValidate()
     */
    public function beforeValidate()
    {
        // if model a new record set userId
        if ($this->isNewRecord)
        {
            $this->userId = Yii::app()->user->id;
        }

        return parent::beforeValidate();
    }


    /**
     *
     * @return void
     */
    public function deleteTags()
    {
        $relations = EntryHasTag::model()->entryId($this->id)->findAll();

        foreach ($relations as $relation)
        {
            $relation->delete();
        }
    }


    /**
     *
     * @return string
     */
    public function getPassword()
    {
        if (strlen($this->encryptedPassword) == 0)
        {
            return '';
        }

        return Yii::app()->user->decrypt($this->encryptedPassword);
    }


    /**
     *
     * @return string
     */
    public function getIdentifier()
    {
        if (strlen($this->name) >  0)
        {
            return $this->name;
        }
        else
        {
            return 'Entry #' . $this->id;
        }
    }


    /**
     *
     * @param boolean $asLinks
     * @return string
     */
    public function getTagList($asLinks = false)
    {
        if (count($this->tags) == 0)
        {
            return '';
        }

        $text = '';

        foreach ($this->tags as $tag)
        {
            if ($asLinks)
            {
                $text .= CHtml::link(CHtml::encode($tag->name), array('entry/index', 'Entry[tagList]' => $tag->name)) . ', ';
            }
            else
            {
                $text .= $tag->name . ', ';
            }
        }

        return substr(trim($text), 0, -1);
    }


    /**
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    /**
     * (non-PHPdoc)
     * @see yii/CActiveRecord#relations()
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'tags' => array(self::MANY_MANY, 'Tag', 'EntryHasTag(entryId, tagId)'),
        );
    }


    /**
     * (non-PHPdoc)
     * @see yii/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('comment', 'default', 'value' => NULL),

            array('id', 'safe', 'on'=>'search'),

            array('name', 'default', 'value' => NULL),
            array('name', 'length', 'max' => 255, 'skipOnError' => true),

            array('password', 'required'),
            array('password', 'length', 'max' => 255, 'skipOnError' => true),

            array('tagList', 'safe'),

            array('url', 'default', 'value' => NULL),
            array('url', 'length', 'max' => 255, 'skipOnError' => true),

            array('userId', 'required'),
            array('userId', 'numerical', 'integerOnly' => true, 'skipOnError' => true),

            array('username', 'default', 'value' => NULL),
            array('username', 'length', 'max' => 255, 'skipOnError' => true),

            array('viewCount', 'default', 'value' => 0),
            array('viewCount', 'numerical', 'integerOnly' => true),
            array('viewCount', 'unsafe'),
        );
    }


    /**
     *
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();

        // by search term
        if (Yii::app()->request->getParam('q') != null)
        {
            $term = Yii::app()->request->getParam('q');

            $criteria->distinct = true;
            $criteria->join = 'LEFT JOIN EntryHasTag AS eht ON eht.entryId=t.id '
                            . 'LEFT JOIN Tag ON Tag.id=eht.tagId';

            $criteria->compare('t.name', $term, true, 'OR');
            $criteria->compare('t.url', $term, true, 'OR');
            $criteria->compare('t.comment', $term, true, 'OR');
            $criteria->compare('t.username', $term, true, 'OR');
            $criteria->compare('Tag.name', $term, true, 'OR');
        }

        // by detail search
        else
        {
            $criteria->compare('t.name', $this->name, true);
            $criteria->compare('t.url', $this->url, true);
            $criteria->compare('t.comment', $this->comment);
            $criteria->compare('t.username', $this->username);

            if (strlen($this->tagList) > 0)
            {
                $c = new CDbCriteria();
                $c->join = 'INNER JOIN EntryHasTag AS eht ON eht.entryId=t.id '
                         . 'INNER JOIN Tag ON Tag.id=eht.tagId';
                $c->compare('Tag.name', $this->tagList);
                $criteria->mergeWith($c);
            }
        }

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }


    /**
     *
     * @param string $v
     * @return void
     */
    public function setPassword($v)
    {
        if (strlen($v) > 0)
        {
            $this->encryptedPassword = Yii::app()->user->encrypt($v);
        }
        else
        {
            $this->encryptedPassword = '';
        }
    }


    /**
     *
     * @param string $v
     * @return void
     */
    public function setTagList($v)
    {
        $tags  = array();
        $names = explode(',', $v);

        foreach ($names as $name)
        {
            $name = trim($name);

            if (strlen($name) > 0)
            {
                $tag       = new Tag();
                $tag->name = $name;
                $tags[]    = $tag;
            }
        }

        $this->tags = $tags;
    }


    /**
     * @return void
     */
    public function incrementViewCounter()
    {
        $this->viewCount++;
        $this->save(true, array('viewCount'));
    }

}

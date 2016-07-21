<?php

/**
 *
 * @property Entry[] $entries
 * @property string  $id
 * @property string  $name
 * @property User    $user
 * @property int     $userId
 * @method Tag find(string $condition = '', array $params = array())
 * @method Tag findByPk(int $pk, string $condition = '', array $params = array())
 */
class Tag extends CActiveRecord
{

    /**
     * @param string $className
     * @return Tag
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'userId' => 'User ID'
        );
    }

    /**
     * @return void
     */
    public function afterDelete()
    {
        // remove Entry relations
        EntryHasTag::model()->deleteAllByAttributes(array('tagId' => $this->id));

        parent::afterDelete();
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        /* @var WebUser $webUser */
        /** @noinspection PhpUndefinedFieldInspection */
        $webUser = Yii::app()->user;

        $this->name = trim($this->name);
        $this->userId = $webUser->id;

        return parent::beforeValidate();
    }

    /**
     * @return array
     */
    public function defaultScope()
    {
        return array(
            'order' => 'name ASC',
        );
    }

    /**
     * @return int
     */
    public function getEntryCounter()
    {
        return count($this->entries);
    }

    /**
     * @param string $v
     * @return Tag
     */
    public function name($v)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.name=:tname',
            'params' => array(':tname' => $v),
        ));

        return $this;
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'entries' => array(self::MANY_MANY, 'Entry', 'EntryHasTag(tagId, entryId)'),
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
        );
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        /* @var WebUser $user */
        /** @noinspection PhpUndefinedFieldInspection */
        $user = Yii::app()->user;

        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 255, 'skipOnError' => true),
            array('name', 'unique', 'criteria' => array('condition' => 'userId=' . $user->id), 'skipOnError' => true),
            array('userId', 'required'),
            array('userId', 'exist', 'className' => 'User', 'attributeName' => 'id'),
            array('userId', 'unsafe'),
            array('id, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('userId', $this->userId, true);

        /* @var Setting $pageSize */
        $pageSize = Setting::model()->name(Setting::PAGINATION_PAGE_SIZE_TAGS)->find();

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'name' => CSort::SORT_ASC
                )
            ),
            'pagination' => array(
                'pageSize' => $pageSize->value
            )
        ));
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function userId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.userId=:userId',
            'params' => array(':userId' => $id),
        ));

        return $this;
    }
}

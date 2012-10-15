<?php

/**
 *
 * @property Entry  $entry
 * @property string $entryId
 * @property Tag    $tag
 * @property string $tagId
 */
class EntryHasTag extends CActiveRecord
{

    /**
     * (non-PHPdoc)
     * @see yii/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'entryId' => 'Entry ID',
            'tagId'   => 'Tag ID',
        );
    }


    /**
     * Scope
     *
     * @param integer $v
     * @return Tag
     */
    public function entryId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'entryId=:entryId',
            'params'    => array(':entryId' => $id),
        ));

        return $this;
    }


    /**
     * @return EntryHasTag
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
            'tag'   => array(self::BELONGS_TO, 'Tag', 'tagId'),
            'entry' => array(self::BELONGS_TO, 'Entry', 'entryId'),
        );
    }


    /**
     * (non-PHPdoc)
     * @see yii/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('entryId, tagId', 'required'),
            array('entryId, tagId', 'length', 'max' => 10),
        );
    }


    /**
     * Scope
     *
     * @param integer $id
     * @return Tag
     */
    public function tagId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'tagId=:tagId',
            'params'    => array(':tagId' => $id),
        ));

        return $this;
    }


    /**
     * Scope
     *
     * @param integer $id
     * @return Tag
     */
    public function userId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'join'      => 'INNER JOIN Entry AS e ON e.id=t.entryId',
            'condition' => 'e.userId=:userId',
            'params'    => array(':userId' => $id),
        ));

        return $this;
    }

}
<?php

/**
 *
 * @property Entry  $entry
 * @property string $entryId
 * @property Tag    $tag
 * @property string $tagId
 * @method EntryHasTag find(string $condition = '', array $params = array())
 * @method EntryhasTag findByPk(int $pk, string $condition = '', array $params = array())
 */
class EntryHasTag extends CActiveRecord
{

    /**
     * @param string $className
     * @return EntryHasTag
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
            'entryId' => 'Entry ID',
            'tagId' => 'Tag ID',
        );
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function entryId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'entryId=:entryId',
            'params' => array(':entryId' => $id),
        ));

        return $this;
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'tag' => array(self::BELONGS_TO, 'Tag', 'tagId'),
            'entry' => array(self::BELONGS_TO, 'Entry', 'entryId'),
        );
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('entryId, tagId', 'required'),
            array('entryId, tagId', 'length', 'max' => 10),
        );
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function tagId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'tagId=:tagId',
            'params' => array(':tagId' => $id),
        ));

        return $this;
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function userId($id)
    {
        $this->getDbCriteria()->mergeWith(array(
            'join' => 'INNER JOIN Entry AS e ON e.id=t.entryId',
            'condition' => 'e.userId=:userId',
            'params' => array(':userId' => $id),
        ));

        return $this;
    }
}

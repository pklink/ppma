<?php

/**
 *
 * @property string  $encryptionKey
 * @property integer $id
 * @property boolean $isAdmin
 * @property string  $password
 * @property string  $salt
 * @property string  $username
 */
class User extends CActiveRecord
{

    /**
     * (non-PHPdoc)
     * @see yii/CModel#afterConstruct()
     */
    public function afterConstruct()
    {
        $this->salt = md5(rand());

        return parent::afterConstruct();
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'encryptionKey' => 'Encryption Key',
            'id'            => 'ID',
            'isAdmin'       => 'Is User Admin?',
            'password'      => 'Password',
            'salt'          => 'Salt',
            'username'      => 'Username',
        );
    }


    /**
     *
     * @param CEvent $event
     * @return void
     */
    public function generateEncryptionKey(CEvent $event)
    {
        if (strlen($this->password) > 0)
        {
            $key = md5(rand());
            $this->encryptionKey = Yii::app()->securityManager->encrypt($key, $this->password);
        }
    }


    /**
     *
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    /**
     *
     * @param CEvent $event
     * @return void
     */
    public function padPassword(CEvent $event)
    {
        if (strlen($this->password) > 0)
        {
            $this->password = Yii::app()->securityManager->padUserPassword($this->password, $this);
        }
    }


    /**
     * (non-PHPdoc)
     * @see yii/CActiveRecord#relations()
     */
    public function relations()
    {
        return array(
            'entries' => array(self::HAS_MANY, 'Entry', 'userId')
        );
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('encryptionKey', 'required'),
            array('encryptionKey', 'unsafe'),

            array('isAdmin', 'default', 'value' => false),
            array('isAdmin', 'boolean'),
            array('isAdmin', 'unsafe'),

            array('password', 'required'),
            array('password', 'length', 'max' => 40, 'skipOnError' => true),

            array('salt', 'required'),
            array('salt', 'length', 'max' => 32, 'skipOnError' => true),

            array('username', 'required'),
            array('username', 'length', 'max' => 255, 'skipOnError' => true),
            array('username', 'unique', 'className' => 'User', 'attributeName' => 'username', 'skipOnError' => true),
        );
    }


    /**
     *
     * @param CEvent $event
     * @return void
     */
    public function saltPassword(CEvent $event)
    {
        if (strlen($this->password) > 0)
        {
            $this->password = sha1($this->salt . $this->password);
        }
    }

}
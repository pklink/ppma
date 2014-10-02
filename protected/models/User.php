<?php

/**
 * @property string  $encryptionKey
 * @property integer $id
 * @property boolean $isAdmin
 * @property string  $password
 * @property string  $salt
 * @property string  $username
 *
 * @property array onBeforeValidate
 * @method User find(string $condition = '', array $params = array())
 * @method User findByPk(int $pk, string $condition = '', array $params = array())
 */
class User extends CActiveRecord
{

    /**
     *
     * @param string $className
     * @return User
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return void
     */
    public function afterConstruct()
    {
        $this->salt = md5(rand());
        parent::afterConstruct();
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'encryptionKey' => 'Encryption Key',
            'id' => 'ID',
            'isAdmin' => 'Is User Admin?',
            'password' => 'Password',
            'salt' => 'Salt',
            'username' => 'Username',
        );
    }

    /**
     * @param CEvent $event
     * @return void
     */
    public function generateEncryptionKey(CEvent $event)
    {
        if (strlen($this->password) > 0) {
            $key = md5(rand());
            $this->encryptionKey = Yii::app()->securityManager->encrypt($key, $this->password);
        }
    }

    /**
     * @param CEvent $event
     * @return void
     */
    public function padPassword(CEvent $event)
    {
        if (strlen($this->password) > 0) {
            /* @var SecurityManager $securityManager */
            $securityManager = Yii::app()->securityManager;

            $this->password = $securityManager->padUserPassword($this->password, $this);
        }
    }

    /**
     * @return array
     */
    public function relations()
    {
        return array(
            'entries' => array(self::HAS_MANY, 'Entry', 'userId')
        );
    }

    /**
     * @return array
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
     * @param CEvent $event
     * @return void
     */
    public function saltPassword(CEvent $event)
    {
        if (strlen($this->password) > 0) {
            $this->password = sha1($this->salt . $this->password);
        }
    }
}

<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    /**
     *
     * @var User
     */
    protected $_model;


    public function authenticate()
    {
        // get user by username
        $model = User::model()->find('username=:username', array(':username' => $this->username));

        // pad password
        if ($model instanceof User)
        {
            $this->password = Yii::app()->securityManager->padUserPassword($this->password, $model);
        }

        // check username
        if (is_null($model)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }

        // check password
        else if (sha1($model->salt . $this->password) != $model->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }

        // login success
        else {
            $this->_model = $model;
            Yii::app()->user->encryptionKey = Yii::app()->securityManager->decrypt($model->encryptionKey, $this->password);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }


    /**
     * (non-PHPdoc)
     * @see yii/web/auth/CUserIdentity#getId()
     */
    public function getId()
    {
        return $this->_model->id;
    }

}
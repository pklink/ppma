<?php

class UserIdentity extends CUserIdentity
{

    /**
     * @var User
     */
    protected $model;

    /**
     * @return bool
     * @throws CException
     */
    public function authenticate()
    {
        /* @var User $model */
        // get user by username
        $model = User::model()->find('username=:username', array(':username' => $this->username));

        // pad password
        if ($model instanceof User) {
            $this->password = Yii::app()->securityManager->padUserPassword($this->password, $model);
        }

        // check username
        if (is_null($model)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (sha1($model->salt . $this->password) != $model->password) { // check password
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            // login success
            $this->model = $model;

            /* @var SecurityManager $securityManager */
            $securityManager = Yii::app()->securityManager;

            /* @var WebUser $webUser */
            $webUser = Yii::app()->user;

            $webUser->encryptionKey = $securityManager->decrypt($model->encryptionKey, $this->password);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->model->id;
    }
}

<?php

class LoginForm extends CFormModel
{

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('username', 'required'),
            array('password', 'required'),
            array('password', 'authenticate', 'skipOnError' => true),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'password' => 'Password',
            'username' => 'Username',
        );
    }


    /**
     * @param string $attribute
     * @param array  $params
     * @return void
     */
    public function authenticate($attribute, $params)
    {
        /* @var WebUser $webUser */
        /** @noinspection PhpUndefinedFieldInspection */
        $webUser = Yii::app()->user;

        $identity = new UserIdentity($this->username, $this->password);
        $identity->authenticate();

        switch($identity->errorCode)
        {
            case UserIdentity::ERROR_NONE:
                $webUser->login($identity);
                break;
            case UserIdentity::ERROR_USERNAME_INVALID:
            case UserIdentity::ERROR_PASSWORD_INVALID:
            default:
                $this->addError('username', 'Login is incorrect.');
                break;
        }
    }
}

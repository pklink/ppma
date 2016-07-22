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
     * @var boolean
     */
    public $rememberMe;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('username', 'required'),
            array('password', 'required'),
            array('password', 'authenticate', 'skipOnError' => true),
            array('rememberMe', 'safe'),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'password'   => 'Password',
            'username'   => 'Username',
            'rememberMe' => 'Remember Login',
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
                if ($this->rememberMe) {
                    $webUser->login($identity, 3600*24*7);
                } else {
                    $webUser->login($identity);
                }
                break;
            case UserIdentity::ERROR_USERNAME_INVALID:
            case UserIdentity::ERROR_PASSWORD_INVALID:
            default:
                $this->addError('username', 'Login is incorrect.');
                break;
        }
    }
}

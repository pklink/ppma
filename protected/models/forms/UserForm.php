<?php

class UserForm extends CFormModel
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
     * @var string
     */
    public $passwordRepeat;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('username', 'required'),
            array('password', 'required'),
            array('passwordRepeat', 'required'),
            array('passwordRepeat', 'compare', 'compareAttribute' => 'password'),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'password'       => 'Password',
            'passwordRepeat' => 'Repeat Password',
            'username'       => 'Username',
        );
    }

}

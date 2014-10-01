<?php

class CreateConfigForm extends CFormModel
{

    /**
     * @var string
     */
    public $server;

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
    public $name;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('password', 'safe'),
            array('server', 'required'),
            array('username', 'required'),
            array('username', 'testConnection', 'skipOnError' => true),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Database',
            'password' => 'Password',
            'server' => 'Server',
            'username' => 'Username',
        );
    }

    /**
     * @param string $attribute
     * @param array $params
     * @return void
     */
    public function testConnection($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $res = @mysql_connect($this->server, $this->username, $this->password);

            if (!$res) {
                $this->addError('db', 'Login data are wrong. Error message: ' . mysql_error());
            } elseif (!mysql_select_db($this->name, $res)) {
                $this->addError('db', 'Database does not exist.');
            }
        }
    }
}

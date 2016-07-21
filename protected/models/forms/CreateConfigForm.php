<?php

class CreateConfigForm extends CFormModel
{

    /**
     * @var string
     */
    public $server;

    /**
     * @var int
     */
    public $port = 3306;

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
            array('port', 'required'),
            array('port', 'numerical'),
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
            'port' => 'Port',
            'server' => 'Server',
            'username' => 'Username',
        );
    }

    /**
     * @return void
     */
    public function testConnection()
    {
        if (!$this->hasErrors()) {
            $dsn = sprintf('mysql:dbname=%s;host=%s', $this->name, $this->server);
            $pdo = null;

            try {
                new PDO($dsn, $this->username, $this->password);
            } catch (PDOException $e) {
                /* @var PDO $pdo */
                $this->addError('db', 'Cannot connect to MySQL server. Error message: ' . $e->getMessage());
            }
        }
    }
}

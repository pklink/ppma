<?php

class ImportPhpPassManagerForm extends CFormModel
{

    /**
     * @var string
     */
    public $name;

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
    public $masterPassword;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var string
     */
    public $iv;

    /**
     * @var string
     */
    public $hash;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('comment', 'default', 'value' => null),
            array('name', 'default', 'value' => null),
            array('name', 'length', 'max' => 255, 'skipOnError' => true),
            array('password', 'required'),
            array('password', 'length', 'max' => 255, 'skipOnError' => true),
            array('url', 'default', 'value' => null),
            array('url', 'length', 'max' => 255, 'skipOnError' => true),
            array('username', 'default', 'value' => null),
            array('username', 'length', 'max' => 255, 'skipOnError' => true),
            array('iv', 'required'),
            array('masterPassword', 'required'),
            array('masterPassword', 'validateHash', 'skipOnError' => true),
            array('hash', 'safe'),
        );
    }

    public function validateHash() {
        /* @var PhpPassManagerDecryptorComponent $decryptor */
        /** @noinspection PhpUndefinedFieldInspection */
        $decryptor = Yii::app()->phpPassManagerDecryptor;
        $password = $decryptor->decrypt(base64_decode($this->password), $this->masterPassword, base64_decode($this->iv));
        if (md5($password) != $this->hash) {
            $this->addError('masterPassword', 'Incorrect master password');
        }
    }

}

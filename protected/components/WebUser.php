<?php

/**
 *
 * @property string $encryptionKey
 */
class WebUser extends CWebUser
{

    /**
     *
     * @param string $text
     * @return string
     */
    public function decrypt($text)
    {
        return Yii::app()->securityManager->decrypt($text, $this->encryptionKey);
    }


    /**
     *
     * @param string $text
     * @return string
     */
    public function encrypt($text)
    {
        return Yii::app()->securityManager->encrypt($text, $this->encryptionKey);
    }


    /**
     *
     * @return string
     */
    public function getEncryptionKey()
    {
        if ($this->isGuest)
        {
            throw new CException('Guest has no encryption key');
        }

        return $this->getState('__encryptionKey');
    }
    
    
    /**
     * 
     * @return boolean
     */
    public function getIsAdmin()
    {
        return User::model()->findByPk( Yii::app()->user->id )->isAdmin == 1;
    }


    /**
     *
     * @param string $value
     * @return void
     */
    public function setEncryptionKey($value)
    {
        return $this->setState('__encryptionKey', $value);
    }


}
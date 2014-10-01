<?php

class PasswordForm extends CFormModel
{

    /**
     * @var string
     */
    public $oldPassword;

    /**
     * @var string
     */
    public $newPassword;

    /**
     * @var string
     */
    public $newPasswordRepeat;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('oldPassword', 'required'),
            array('oldPassword', 'checkPassword', 'skipOnError' => true),
            array('newPassword', 'required'),
            array('newPasswordRepeat', 'required'),
            array('newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword', 'skipOnError' => true)
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'newPassword' => 'New Password',
            'newPasswordRepeat' => 'Repeat Password',
            'oldPassword' => 'Old Password',
        );
    }

    /**
     * @param string $attribute
     * @param array $params
     * @return void
     */
    public function checkPassword($attribute, $params)
    {
        /* @var SecurityManager $securityManager */
        $securityManager = Yii::app()->securityManager;

        /* @var WebUser $webUser */
        /** @noinspection PhpUndefinedFieldInspection */
        $webUser = Yii::app()->user;

        /* @var User $user */
        $user = User::model()->findByPk($webUser->id);
        $password = sha1($user->salt . $securityManager->padUserPassword($this->$attribute, $user));

        if (!is_object($user) || $password != $user->password) {
            $this->addError($attribute, $this->getAttributeLabel($attribute) . ' is wrong.');
        }
    }
}

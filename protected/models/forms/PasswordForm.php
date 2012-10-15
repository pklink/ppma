<?php

class PasswordForm extends CFormModel
{

    /**
     *
     * @var string
     */
    public $oldPassword;

    /**
     *
     * @var string
     */
    public $newPassword;

    /**
     *
     * @var string
     */
    public $newPasswordRepeat;


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
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
     * (non-PHPdoc)
     * @see yii/base/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'newPassword'       => 'New Password',
            'newPasswordRepeat' => 'Repeat Password',
            'oldPassword'       => 'Old Password',
        );
    }


    /**
     *
     * @param string $attribute
     * @param array  $params
     * @return void
     */
    public function checkPassword($attribute, $params)
    {
        $user = User::model()->findByPk(Yii::app()->user->id);

        if (!is_object($user) || sha1($user->salt . Yii::app()->securityManager->padUserPassword($this->$attribute, $user)) != $user->password)
        {
            $this->addError($attribute, $this->getAttributeLabel($attribute) . ' is wrong.');
        }
    }

}

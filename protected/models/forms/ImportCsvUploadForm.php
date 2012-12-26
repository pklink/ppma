<?php

class ImportCsvUploadForm extends CFormModel
{

    /**
     * @var CUploadedFile
     */
    public $file;


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#rules()
     */
    public function rules()
    {
        return array(
            array('file', 'file', 'types' => 'csv'),
        );
    }


    /**
     * (non-PHPdoc)
     * @see yii/base/CModel#attributeLabels()
     */
    public function attributeLabels()
    {
        return array(
            'file' => 'CSV-File',
        );
    }

}

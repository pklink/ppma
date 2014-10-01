<?php

class ImportCsvUploadForm extends CFormModel
{

    /**
     * @var CUploadedFile
     */
    public $file;

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            array('file', 'file', 'types' => 'csv'),
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'file' => 'CSV-File',
        );
    }
}

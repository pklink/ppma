<?php

class EntryButtonColumn extends ButtonColumn
{

    /**
     * @var string
     */
    public $template = '{website}{copyUsername}{copyPassword}{update}{delete}';

    /**
     * @var array
     */
    public $buttons = array(
        'website' => array(
            'label' => '<i class="foundicon-access-network"></i>',
            'url' => '$data->url',
            'options' => array('title' => 'Visit Website', 'target' => '_blank'),
        ),
        'copyUsername' => array(
            'label' => '<i class="foundicon-address-book"></i>',
            'options' => array(
                'title' => 'Copy Username',
                'class' => 'copy-to-clipboard',
                'data-clipboard-text' => ''
            ),
        ),
        'copyPassword' => array(
            'label' => '<i class="foundicon-page"></i>',
            'options' => array(
                'title' => 'Copy Password',
                'class' => 'copy-to-clipboard',
                'data-clipboard-text' => ''
            ),
        ),

    );

    /**
     * @return void
     */
    protected function initDefaultButtons()
    {
        parent::initDefaultButtons();

        // update-button
        $this->buttons['update'] = array(
            'label' => '<i class="foundicon-edit"></i>',
            'options' => array(
                'title' => 'Update',
                'data-reveal-id' => 'entry-form-modal',
                'class' => 'update-entry',
            ),
            'url' => 'array("entry/update", "id" => $data->id, "returnUrl" => Yii::app()->request->requestUri)',
        );
    }

    /**
     * @param string $id
     * @param array $button
     * @param int $row
     * @param mixed $data
     */
    protected function renderButton($id, $button, $row, $data)
    {
        // add rel-attribute to update-button
        if ($id == 'update') {
            $button['options']['rel'] = CHtml::normalizeUrl(
                array('entry/getData', 'id' => $data->id, 'withPassword' => 1)
            );
        }

        // add username to copy button
        if ($id == 'copyUsername') {
            $button['options']['data-clipboard-text'] = $data->username;
        }

        // add password to copy button
        if ($id == 'copyPassword') {
            $button['options']['data-clipboard-text'] = $data->password;
        }

        // render website only if url available
        if ($id != 'website' || strlen($data->url) > 0) {
            parent::renderButton($id, $button, $row, $data);
        }
    }

    /**
     * @param int $row
     * @param mixed $data
     */
    protected function renderDataCellContent($row, $data)
    {
        if (strlen($data->url) == 0) {
            echo '<div class="placeholder"></div>';
        }

        parent::renderDataCellContent($row, $data);
    }
}

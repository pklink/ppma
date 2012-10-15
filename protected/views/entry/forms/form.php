<?php

return array(
    'elements' => array(
        'name' => array(
            'type'      => 'text',
            'size'      => '60',
            'maxlength' => 255,
        ),
        'username' => array(
            'type'      => 'text',
            'size'      => '60',
            'maxlength' => 255,
        ),
        'password' => array(
            'type'         => 'password',
            'size'         => '60',
            'maxlength'    => 255,
            'layout'       => '{label} {input} <a class="show-hide-password">Show</a> {error}',
            'autocomplete' => 'off',
        ),
        'url' => array(
            'type'      => 'text',
            'size'      => '60',
            'maxlength' => 255,
        ),
        'tagList' => array(
            'type' => 'text',
            'size' => '60',
            'hint' => 'Separate tags with comma'
        ),
        'comment' => array(
            'type' => 'textarea',
            'cols' => '50',
            'rows' => 6,
        ),
    ),

    'buttons'=>array(
        'create' => array(
            'type'  => 'submit',
            'label' => 'Create',
            'on'    => 'create',
        ),
        'update' => array(
            'type'  => 'submit',
            'label' => 'Save',
            'on'    => 'update',
        ),
    ),
);
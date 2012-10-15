<?php

return array(
    'elements' => array(
        'name' => array(
            'type'      => 'text',
            'size'      => '60',
            'maxlength' => 255,
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
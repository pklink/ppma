<?php

return array(
    'elements' => array(
        'server' => array(
            'type'  => 'text',
            'size'  => '60',
        ),
        'port' => array(
            'type'  => 'number',
            'size'  => '5',
        ),
        'username' => array(
            'type'  => 'text',
            'size'  => '60',
        ),
        'password' => array(
            'type'  => 'password',
            'size'  => '60',
        ),
        'name' => array(
            'type'  => 'text',
            'size'  => '60',
        ),
    ),

    'buttons'=>array(
        'create' => array(
            'type'  => 'submit',
            'label' => 'Create Config',
            'class' => 'button radius',
        ),
    ),
);
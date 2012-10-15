<?php

return array(
    'elements' => array(
        'username' => array(
            'type'      => 'text',
            'maxlength' => 32,
        ),
        'password' => array(
            'type'      => 'password',
            'maxlength' => 32,
            'value'     => '',
        ),
    ),

    'buttons'=>array(
        'login' => array(
            'type'  => 'submit',
            'label' => 'Login',
            'class' => 'button',
        ),
    ),
);
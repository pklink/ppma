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
        'passwordRepeat' => array(
            'type'      => 'password',
            'maxlength' => 32,
            'value'     => '',
        ),
    ),

    'buttons'=>array(
        'register'=>array(
            'type'  => 'submit',
            'label' => 'Register',
            'class' => 'button radius',
        ),
    ),
);
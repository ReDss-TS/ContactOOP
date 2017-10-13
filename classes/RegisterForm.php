<?php

class RegisterForm extends Forms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Register',
            'actionFile' => 'Register',
            'submitBtn'  => 'Register',
            'backBtn'    => 'Login'
    ];

    //structure of the input field
    protected $structure  = [
            [
                'name'  => 'user_login',
                'label' => 'Login',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_pass',
                'label' => 'Password',
                'type'  => 'Password'
            ]
    ];
    
}

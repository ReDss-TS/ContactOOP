<?php

class LoginForm extends Forms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Login',
            'actionFile' => 'Login',
            'submitBtn'  => 'Enter',
            'backBtn'    => 'Register'
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

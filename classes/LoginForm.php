<?php

class LoginForm extends Forms
{   
    private $strusture  = [
            [
                'name'  => 'user_login'
                'label' => 'Login',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_pass'
                'label' => 'Password',
                'type'  => 'Password'
            ]
    ];
    
}

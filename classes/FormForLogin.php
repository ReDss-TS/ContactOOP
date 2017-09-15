<?php

class FormForLogin extends Forms
{

    public $elementsOfForm = [
            'user_login' => 'Login',
            'user_pass'  => 'Password'
    ];
    
    public function buildForm($listWithErrors)
    {
        //structure of form for login
        foreach ($this->elementsOfForm as $key => $value) {
            $typeOfInput = ($key == 'user_pass') ? 'password' : 'text';
            $errorLabel = (!empty($listWithErrors)) ? "<label for =\"$key\" class = \"ErrorLabel\">$listWithErrors[$key]</label>" : '';
            $loginForm = $this->structureForForm($key, $value, '', $typeOfInput, '', $errorLabel);
        }
        return $loginForm;
    }
}

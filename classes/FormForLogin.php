<?php

class FormForLogin extends Forms
{

    public $elementsOfForm = [
            'user_login' => [
                'label' => 'Login',
                'type'  => 'text'
            ],
            'user_pass'  => [
                'label' => 'Password',
                'type'  => 'Password'
            ]
    ];
    
    public function buildForm($listWithErrors)
    {
        //structure of form for login
        foreach ($this->elementsOfForm as $key => $value) {
            $errorLabel = (!empty($listWithErrors)) ? "<label for =\"$key\" class = \"ErrorLabel\">$listWithErrors[$key]</label>" : '';
            $this->htmlFieldForInput($key, $value['label'], '', $value['type'], '', $errorLabel);
            $loginForm = $this->getHtmlFieldForInput();
        }
        return $loginForm;
    }
}

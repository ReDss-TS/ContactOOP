<?php

class FormForLogin extends Forms
{

    public function buildForm($listWithErrors)
    {
        //structure of form for login
        foreach ($this->elementsOfUserForm as $key => $value) {
            $typeOfInput = ($key == 'user_pass') ? 'password' : 'text';
            $errorLabel = (!empty($listWithErrors)) ? "<label for =\"$key\" class = \"ErrorLabel\">$listWithErrors[$key]</label>" : '';
            $loginForm = $this->structureForForm();
        }
        return $loginForm;
    }
}

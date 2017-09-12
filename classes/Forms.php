<?php

abstract class Forms
{
    public $structureForForm = '';
    public $elementsOfUserForm = [
            'user_login' => 'Login',
            'user_pass'  => 'Password'
    ];
    public $elementsOfInsertForm = [
            'user_name'     => 'First Name',
            'user_surname'  => 'Last Name',
            'user_mail'     => 'Email',
            'user_hPhone'   => 'Home Phone',
            'user_wPhone'   => 'Work Phone',
            'user_cPhone'   => 'Cell Phone',
            'user_address1' => 'Address1',
            'user_address2' => 'Address2',
            'user_city'     => 'City',
            'user_state'    => 'State',
            'user_zip'      => 'ZIP',
            'user_country'  => 'Country',
            'user_birthday' => 'Birthday'
    ];
    /*
    public $key = '';
    public $value = '';
    public $withRadioBtn = '';
    public $typeOfInput = '';
    public $inputValue = '';
    public $errorLabel = '';
    */

    public function structureForForm() {
        $key = '';
        $value = '';
        $withRadioBtn = '';
        $typeOfInput = '';
        $inputValue = '';
        $errorLabel = '';
        $this->structureForForm .= "<div class = \"field\">
                        <label for =\"$key\">$value:</label>
                        $withRadioBtn
                        <input class = \"text\" id = '" . $key . "' name = \"$key\" type = \"$typeOfInput\" $inputValue />
                        <br/>
                        $errorLabel
                        </div>";
        return $this->structureForForm;
    }

}

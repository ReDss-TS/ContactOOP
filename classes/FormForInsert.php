<?php

class FormForInsert extends Forms
{
    public $elementsOfForm = [
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
    
    public function buildForm($inputValues, $numRadio, $listWithErrors)
    {
        if (!empty($inputValues)) {
            $inputValues = $filter->sanitizeSpecialChars($inputValues);
        }
        //structure of form for insert data
        foreach ($this->elementsOfForm as $key => $value) {
	        $withRadioBtn = ($key == 'user_hPhone' || $key == 'user_wPhone'|| $key == 'user_cPhone') ? $this->addRadioBtn($key, $numRadio) : '';
	        $typeOfInput = ($key == 'user_pass') ? 'password' : 'text';
	        $inputValue = (!empty($inputValues)) ? "value='$inputValues[$key]'" : '';
	        $errorLabel = (!empty($listWithErrors)) ? "<label for =\"$key\" class = \"ErrorLabel\">$listWithErrors[$key]</label>" : '';
	        $insertForm = $this->structureForForm($key, $value, $withRadioBtn, $typeOfInput, $inputValue, $errorLabel);
        }
        return $insertForm;
    }

    private function addRadioBtn($val, $checkValue)
    {
        $radioNum = 0;
        switch ($val) {
            case "user_hPhone":
                $radioNum = 1;
                break;
            case "user_wPhone":
                $radioNum = 2;
                break;
            case "user_cPhone":
                $radioNum = 3;
                break;
        }
        $isChecked = ($radioNum == $checkValue) ? 'checked' : '';
        $formRadio = "<input id = \"idPhone$radioNum\" type = \"radio\" name = \"bestPhone\" value = $radioNum $isChecked>";
        return $formRadio;
    }

}

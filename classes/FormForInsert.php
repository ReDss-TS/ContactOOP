<?php

class FormForInsert extends Forms
{
    public function buildForm($inputValues, $numRadio, $listWithErrors)
    {
        if (!empty($inputValues)) {
            $inputValues = $filter->sanitizeSpecialChars($inputValues);
        }
        //structure of form for insert data
        foreach ($this->elementsOfInsertForm as $key => $value) {
	        $withRadioBtn = ($key == 'user_hPhone' || $key == 'user_wPhone'|| $key == 'user_cPhone') ? $this->addRadioBtn($key, $numRadio) : '';
	        $typeOfInput = ($key == 'user_pass') ? 'password' : 'text';
	        $inputValue = (!empty($inputValues)) ? "value='$inputValues[$key]'" : '';
	        $errorLabel = (!empty($listWithErrors)) ? "<label for =\"$key\" class = \"ErrorLabel\">$listWithErrors[$key]</label>" : '';
	        $insertForm = $this->structureForForm();
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

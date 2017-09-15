<?php

abstract class Forms
{
    public $structureForForm = '';
    public $elementsOfForm = []; //abstract public $elementsOfForm? 

    public function structureForForm($key, $value, $withRadioBtn, $typeOfInput, $inputValue, $errorLabel) {
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

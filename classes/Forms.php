<?php

abstract class Forms
{
    protected $elementsOfForm = [];

    protected $htmlFieldForInput = '';

    //abstract protected function buildForm($inputValues, $numRadio, $listWithErrors);

    public function htmlFieldForInput($key, $value, $withRadioBtn, $typeOfInput, $inputValue, $errorLabel) 
    {
        $this->htmlFieldForInput .= "<div class = \"field\">
                        <label for =\"$key\">$value:</label>
                        $withRadioBtn
                        <input class = \"text\" id = '" . $key . "' name = \"$key\" type = \"$typeOfInput\" $inputValue />
                        <br/>
                        $errorLabel
                        </div>";
    }

    public function getHtmlFieldForInput()
    {
        return $this->htmlFieldForInput;
    }
}

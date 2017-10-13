<?php

abstract class Forms
{
    protected $actionsForm = [];
    protected $actionsBtn = [];

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

    //______________________________________________

    // protected $elementsForForm = [
    //         'login' => [
    //             'header'     => 'Login',
    //             'actionFile' => 'Login',
    //             'submitBtn'  => 'Enter',
    //             'backBtn'    => 'Register'
    //         ],
    //         'register' => [
    //             'header'     => 'Register',
    //             'actionFile' => 'Login',
    //             'submitBtn'  => 'Register',
    //             'backBtn'    => 'Login'
    //         ],
    //         'insert' => [
    //             'header'     => 'Add Contact',
    //             'actionFile' => 'Login',
    //             'submitBtn'  => 'Add',
    //             'backBtn'    => 'Index'
    //         ],
    //         'update' => [
    //             'header'     => 'Edit',
    //             'actionFile' => 'Login',
    //             'submitBtn'  => 'Done',
    //             'backBtn'    => 'Index'
    //         ]
    // ];

    //array with input data and results of validation
    private $data = [];

    function __construct($formData) {
        if (!empty($formData)) {
            $this->data = $formData;
        } else {
            $this->data['data'] = '';
            $this->data['validate'] = '';
        }
        
    }

    public function startForm()
    {
        $form = "
            <div class = 'editBlock' id = 'editBlock'>
                <form method = 'post' action=" . $this->elements['actionFile'] . ".php>
                <div class = 'editBlockHead' id = 'editBlockHead'>
                    <h2>
                        " . $this->elements['header'] . "
                    </h2>
                </div>";
        return $form;
    }

    public function endForm()
    {
        $form = "
            </form>
            </div>";
        return $form;
    }

    public function renderInput($name, $label, $typeOfInput)
    {
        $inputData = (!empty($this->data['data'])) ? $this->data['data'][$name] : '';
        $validateData = (!empty($this->data['validate'])) ? $this->data['validate'][$name] : '';
        
        $input = "<div class = \"field\">
                        <label for ='$name'>$label:</label>
                        <input class = \"text\" id = '$name' name = '$name' type = '$typeOfInput' $inputData />
                        <br/>
                        $validateData
                        </div>";
        return $input;
    }

    public function submitBtn()
    {
        $submitBtn = $this->elements['submitBtn'];
        $backBtn = $this->elements['backBtn'];
        $btns = "<br/>
                <input class = 'button' type = 'submit' name = '" . $submitBtn . "Btn' value = '$submitBtn'/>
                <a href = '$backBtn.php' class='button'>$backBtn</a>";
        return $btns;
    }

    public function render()
    {
        $html = '';
        $html .= $this->startForm();
        foreach($this->structure as $field){
            $html .= $this->renderInput($field['name'], $field['label'], $field['type']);
        }
        $html .= $this->submitBtn();
        $html .= $this->endForm();
        return $html;
    }
}

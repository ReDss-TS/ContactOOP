<?php

abstract class Forms
{
    //array with input data and results of validation and radioButtons;
    protected $data = [];
    //array with keys to be contained in $data;
    protected $dataKeys = [
        'data',
        'validate',
        'radio'
    ];

    function __construct($formData) {
        $this->data = $formData;       
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
        foreach ($this->dataKeys as $value) {
            $parameters[$value] = (isset($this->data[$value][$name])) ? $this->data[$value][$name] : '';
            if ($value == 'radio') {
                $parameters[$value] = (isset($this->data[$value])) ? $this->data[$value] : '';
            }
        }
        $radioBtn = (method_exists(get_class($this), 'renderRadioBtn')) ? $this->renderRadioBtn($name, $parameters['radio']) : '';

        $input = "<div class = \"field\">
                    <label for ='$name'>$label:</label>
                    $radioBtn
                    <input class = \"text\" id = '$name' name = '$name' type = '$typeOfInput' value=\"" . $parameters['data'] . "\" />
                    <br/>
                    " . $parameters['validate'] . "
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

<?php

class Forms
{
    public $elementsOfForm = [
        'user_form' => [
            'user_login' => 'Login',
            'user_pass'  => 'Password'
        ],
        'insert_form' => [
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
        ]
    ];

    public function buildForm($typeOfForm, $inputValues, $numRadio, $listWithErrors)
    {
        if (!empty($inputValues)) {
            $inputValues = $filter -> sanitizeSpecialChars($inputValues);
        }
        //structure of form for insert data
        $structureForForm = '';
        foreach ($this->elementsOfForm as $keyElement => $valueElement) {
        	if ($keyElement == $typeOfForm) {
	        	foreach ($valueElement as $key => $value) {
	            	$withRadioBtn = ($key == 'user_hPhone' || $key == 'user_wPhone'|| $key == 'user_cPhone') ? addRadioBtn($key, $numRadio) : '';
	            	$typeOfInput = ($key == 'user_pass') ? 'password' : 'text';
	            	$inputValue = (!empty($inputValues)) ? "value='$inputValues[$key]'" : '';
	            	$errorLabel = (!empty($listWithErrors)) ? "<label for =\"$key\" class = \"ErrorLabel\">$listWithErrors[$key]</label>" : '';
	            	$structureForForm .= "<div class = \"field\">
	                	<label for =\"$key\">$value:</label>
	                	$withRadioBtn
	                	<input class = \"text\" id = '" . $key . "' name = \"$key\" type = \"$typeOfInput\" $inputValue />
	                	<br/>
	                	$errorLabel
	                	</div>";
            	}
        	}
        }
        return $structureForForm;
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

    public function createHtmlBlock($head, $inputForm, $btn1 ,$btn2)
    {
        $structureForPage = "
            <div class = 'editBlock' id = 'editBlock'>
                <form method = 'post' action = 'index.php'>
                <div class = 'editBlockHead' id = 'editBlockHead'>
                    <h2>
                        $head
                    </h2>
                </div>
                $inputForm
                <br/>
                <input class = 'button' type = 'submit' name = '".$btn1."Btn' value = '$btn1'/>
                <a href = 'index.php' class='button'>$btn2</a>
                </form>
            </div>";
        return $structureForPage;
    }

    public function createHtmlTable($tableHeader, $tableData)
    {
        $Contacts = new Table();
        $data = $Contacts -> tableData($tableData);
        $structureTable = "
            <div class = 'tableBlock' id = 'tableBlock'>
                <table cellpadding = '10' id = 'table'>
                    <tr>
                    $tableHeader
                    </tr>
                    $data
                </table>
            </div>
            <br/>";

        echo $structureTable;
    }
    
    function createBtn($typeBtn, $idLine)
    {
        return "<form method = \"post\" action = " . $typeBtn . ".php>
            <input type= \"hidden\" name = \"idLine\" value = " . $idLine . " />
            <input class = " . $typeBtn . " Btn type=\"submit\" name = " . $typeBtn . " Btn value = " . $typeBtn . " />
            </form>";
    }
}

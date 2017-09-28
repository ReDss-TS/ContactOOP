<?php

class Pages
{
    public $elementsForForm = [
            'login' => [
                'header'   => 'Login',
                'rightBtn' => 'Enter',
                'leftBtn'  => 'Register'
            ],
            'register' => [
                'header'   => 'Register',
                'rightBtn' => 'Register',
                'leftBtn'  => 'Login'
            ],
            'insert' => [
                'header'   => 'Add Contact',
                'rightBtn' => 'Add',
                'leftBtn'  => 'Index'
            ],
            'update' => [
                'header'   => 'Edit',
                'rightBtn' => 'Done',
                'leftBtn'  => 'Index'
            ]
    ];

    public function mainPage()
    {
        $bodyPage = '';
        $data = new Table();
        $tableHeaders = $data->tableHeaders();

        $ContactObj = new Contacts();
        $selectDataForMainPage = $ContactObj->selectDataForMainPage();

        $filter = new Filters();
        $sanitizeDate = $filter->sanitizeSpecialCharsInMultiArrays($selectDataForMainPage);

        $tableForData = new StructureForm;
        $DataTable = $tableForData->createTable($tableHeaders, $sanitizeDate);

        $bodyPage .= $DataTable;
        return $bodyPage;
    }

    public function loginPage($link)
    {
        $listWithInputError = '';
        $formForLogin = new FormForLogin();
        $form = $formForLogin->buildForm($listWithInputError);

        $structureForm = new StructureForm;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == $link) {
                $loginPage = $structureForm->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }
        return $loginPage;
    }

    public function insertPage($link)
    {
        $listWithInputError = '';
        $inputValues = [];
        $selectedRadio = 0;

        $formForAddContacts = new FormForInsert();
        $form = $formForAddContacts->buildForm($inputValues, $selectedRadio, $listWithInputError);

        $structureForm = new StructureForm;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == $link) {
                $page = $structureForm->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }
        return $page;
    }

    //TODO
    public function updatePage($link)
    {
        $listWithInputError = '';
        $inputValues = Values::getInstance()->getValuesForUpdate($_POST['idLine']);

        $formForAddContacts = new FormForInsert();
        $form = $formForAddContacts->buildForm($inputValues['values'], $inputValues['selectedRadio'], $listWithInputError);

        $structureForm = new StructureForm;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == $link) {
                $page = $structureForm->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }
        return $page;
    }

}

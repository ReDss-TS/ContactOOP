<?php

class Pages
{
    protected $elementsForForm = [
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
    protected $listWithInputError = '';
    protected $inputValues = [];
    protected $selectedRadio = 0;


    private static $instance;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

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
        $formForAddContacts = new FormForInsert();
        $form = $formForAddContacts->buildForm($this->inputValues, $this->selectedRadio, $this->listWithInputError);

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
        if (isset($_POST['idLine'])) {
            $_SESSION['idLine'] = $_POST['idLine'];
        }
        $valuesObj = new Values;
        $inputValues = $valuesObj->getValuesForUpdate($_SESSION['idLine']);

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

    public function setProperties($listWithInputError, $inputValues, $selectedRadio)
    {
        $this->listWithInputError = $listWithInputError;
        $this->inputValues = $inputValues;
        $this->selectedRadio = $selectedRadio;
    }

}

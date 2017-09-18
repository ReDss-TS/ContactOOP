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
            ]
    ];

    private static $instance;

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

        $selectDataForMainPage = Contacts::getInstance()->selectDataForMainPage();

        $dbase = Db::getInstance();
        $result = $dbase->selectFromDB($selectDataForMainPage);

        $filter = new Filters();
        $sanitizeDate = $filter->sanitizeSpecialChars($result);

        $tableForData = StructureForm::getInstance();
        $DataTable = $tableForData->createTable($tableHeaders, $sanitizeDate);

        $bodyPage .= $DataTable;
        //$sessionManager->logout();
        return $bodyPage;
    }

    public function loginPage($link)
    {
        $listWithInputError = '';
        $formForLogin = new FormForLogin();
        $form = $formForLogin->buildForm($listWithInputError);

        foreach ($this->elementsForForm as $key => $value) {
            if ($key == $link) {
                $loginPage = StructureForm::getInstance()->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
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

        foreach ($this->elementsForForm as $key => $value) {
            if ($key == $link) {
                $page = StructureForm::getInstance()->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }
        return $page;
    }
}

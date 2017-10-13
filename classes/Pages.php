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
    protected $listWithInputError;
    protected $inputValues;
    protected $selectedRadio;

    protected $pageFirstResult;
    protected $resultsPerPage;


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

    public function index()
    {
        $bodyPage = '';
        $this->requireLogin();

        $paginationObj = new Pagination;
        $paginationObj->createPagination();
        
        
        $data = new Table();
        $tableHeaders = $data->tableHeaders();
        $ContactObj = new Contacts();
        $selectDataForMainPage = $ContactObj->selectDataForMainPage($this->pageFirstResult, $this->resultsPerPage);

        $filter = new Filters();
        //$sanitizeDate = $filter->sanitizeSpecialCharsInMultiArrays($selectDataForMainPage);
        $sanitizeDate = $filter->sanitizeSpecialChars($selectDataForMainPage);

        $tableForData = new FormStructure;
        $DataTable = $tableForData->createTable($tableHeaders, $sanitizeDate);

        $bodyPage .= $DataTable;

        $pagination =  $paginationObj->getPagination();
        $bodyPage .= $pagination;

        return $bodyPage;
    }

    private function requireLogin()
    {
        $signIn = new Sessions;
        $isSignIn = $signIn->issetLogin();
        if (!$isSignIn == true) {
            header("Location: login.php");
        }
        
    }

    public function login()
    {
        $listWithInputError = '';
        $sessions = new Sessions;

        if (isset($_POST['EnterBtn'])) {
            $this->authentication();
        }

        if ($sessions->issetLogin() == true) {
            header("Location: index.php");
        }

        $formForLogin = new FormForLogin();
        $form = $formForLogin->buildForm($listWithInputError);

        $structureForm = new FormStructure;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == 'login') {
                $loginPage = $structureForm->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }
        return $loginPage;
    }

    public function register()
    {
        $listWithInputError = '';
        $sessions = new Sessions;

        if (isset($_POST['RegisterBtn'])) {
            $listWithInputError = $this->registration();
        }

        if ($sessions->issetLogin() == true) {
            header("Location: index.php");
        }

        $formForLogin = new FormForLogin();
        $form = $formForLogin->buildForm($listWithInputError);

        $structureForm = new FormStructure;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == 'register') {
                $loginPage = $structureForm->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }
        return $loginPage;
    }

    private function authentication()
    {
        $sessions = new Sessions;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];
        $authentication = new Auth();
        $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
        $auth['is_auth'] == true ? $sessions->authenticationToSession($auth['user']) : $sessions->recordMessageInSession('auth', $auth['error_msg']);
    }

    private function registration()
    {
        $sessions = new Sessions;
        $validateObj = new Validate;
        $arrayData['user_login'] = $_POST['user_login'];
        $arrayData['user_pass'] = $_POST['user_pass'];

        $validateList = $validateObj->validateData($arrayData);
        $noEmptyValidateList = array_diff($validateList, array(''));

        if (empty($noEmptyValidateList)) {
            $registr = new Registration();
            $result = $registr->register($arrayData['user_login'], $arrayData['user_pass']);
            $sessions->recordMessageInSession('register', $result['msg']);
            return '';
        } else {
            return $validateList;
        }

    }

    public function insert()
    {   
        $this->requireLogin();
        if (isset($_POST['AddBtn'])) {
            $contacts = new Contacts;
            $labelsOfContact = $contacts->getLabelsOfContact();
            $valuesObj = new Values;
            $inputValues = $valuesObj->getInputValues($labelsOfContact);
            $isInserted = $valuesObj->insert($labelsOfContact, $inputValues);

            $sessions = new Sessions;
            if ($isInserted == true) {
                $sessions->recordMessageInSession('insert', "New record created successfully");
                header("Location: index.php");
            } else {
                $sessions->recordMessageInSession('insert', "New record not created");
            }
        }

        $formForAddContacts = new FormForInsert();
        $form = $formForAddContacts->buildForm($this->inputValues, $this->selectedRadio, $this->listWithInputError);

        $structureForm = new FormStructure;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == 'insert') {
                $page = $structureForm->createStructureForm($value['header'], $form, $value['rightBtn'], $value['leftBtn']);
            }
        }

        return $page;
    }

    //TODO
    public function update()
    {
        $this->requireLogin();
        $listWithInputError = '';
        if (isset($_POST['idLine'])) {
            $_SESSION['idLine'] = $_POST['idLine'];
        }
        $valuesObj = new Values;
        $inputValues = $valuesObj->getValuesForUpdate($_SESSION['idLine']);

        $this->setProperties($listWithInputError, $inputValues['values'], $inputValues['selectedRadio']);

        if (isset($_POST['DoneBtn'])) {
            $contacts = new Contacts;
            $labelsOfContact = $contacts->getLabelsOfContact();
            $valuesObj = new Values;
            $inputValues = $valuesObj->getInputValues($labelsOfContact);
            $isUpdated = $valuesObj->update($labelsOfContact, $inputValues, $_SESSION['idLine']);

            $sessions = new Sessions;
            if ($isUpdated == true) {
                $sessions->recordMessageInSession('update', "Record update successfully!");
                header("Location: index.php");
            } else {
                $sessions->recordMessageInSession('update', "New record not updated");
            }
        }

        $formForAddContacts = new FormForInsert();
        $form = $formForAddContacts->buildForm($this->inputValues, $this->selectedRadio, $this->listWithInputError);

        $structureForm = new FormStructure;
        foreach ($this->elementsForForm as $key => $value) {
            if ($key == 'update') {
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

    public function setPagesProperties($pageFirstResult, $resultsPerPage)
    {
        $this->pageFirstResult = $pageFirstResult;
        $this->resultsPerPage = $resultsPerPage;
    }

}

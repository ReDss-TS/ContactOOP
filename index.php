<?php

function __autoload($className)
{
    //$className = str_replace("..", "", $className);
    require_once("classes/$className.php");
}

session_start();
$bodyPage = '';
$dataForUpdate = array();
$selectedRadio = 0;
$listWithInputError = '';

$sessionManager = Sessions::getInstance();
$isSignIn = $sessionManager -> issetLogin();

if ($isSignIn == 'yes') {
    $data = new Table();
    $tableHeaders = $data -> tableHeaders();

    $selectDataForMainPage = Queries::getInstance() -> selectDataForMainPage();

    $dbase = Db::getInstance();
    $result = $dbase -> selectFromDB($selectDataForMainPage);

    $filter = new Filters();
    $sanitizeDate = $filter -> sanitizeSpecialChars($result);

    $tableForData = new Forms();
    $DataTable = $tableForData -> createHtmlTable($tableHeaders, $sanitizeDate);

    $bodyPage .= $DataTable;
    //$sessionManager -> logout();
} else {
    $formForLogin = new FormForLogin();
    $form = $formForLogin->buildForm($listWithInputError);
    $loginPage = HtmlElements::getInstance()->createHtmlBlock('Login', $form, 'Enter', 'Register');

    $bodyPage .= $sessionManager -> showMessages();
    $sessionManager -> unsetMessages();
    $bodyPage .= $loginPage;
}

if (isset($_POST['EnterBtn'])) {
       $arrayData['user_login'] = $_POST['user_login'];
       $arrayData['user_pass'] = $_POST['user_pass'];
       $authentication = new Auth();
       $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
       is_array($auth) ? $sessionManager->authenticationToSession($auth) : $sessionManager->recordMessageInSession('auth', $auth);
}

//$sessionManager -> logout();
include_once 'includes/headHtml.php';
echo $bodyPage;
include_once 'includes/footer.php';

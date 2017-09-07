<?php

include_once 'includes/headHtml.php';

function __autoload($className)
{
    //$className = str_replace("..", "", $className);
    require_once("classes/$className.php");
}

session_start();
$dataForUpdate = array();
$selectedRadio = 0;
$listWithInputError = '';

$sessionManager = new Sessions();
$login = $sessionManager -> issetLogin();

if ($login == 'yes') {
	$data = new Table();
	$tableHeaders = $data -> tableHeaders();

	$Queries = new Queries();
    $selectDataForMainPage = $Queries -> selectDataForMainPage();

	$dbase = Db::getInstance();
	$result = $dbase -> selectFromDB($selectDataForMainPage);

	$filter = new Filters();
	$sanitizeDate = $filter -> sanitizeSpecialChars($result);

	$tableForData = new Forms();
	$tableForData -> createHtmlTable($tableHeaders, $sanitizeDate);

	//$sessionManager -> logout();
} else {
	$formForLogin = new Forms();
	$form = $formForLogin->buildForm('user_form', $dataForUpdate, $selectedRadio, $listWithInputError);
	$page = $formForLogin->createHtmlBlock('Registration', $form, 'Enter', 'Register');
	echo $page;

	$sessionManager -> showMessages();
	$sessionManager -> unsetMessages();
}

if (isset($_POST['EnterBtn'])) {
   	$arrayData['user_login'] = $_POST['user_login'];
   	$arrayData['user_pass'] = $_POST['user_pass'];
   	$authentication = new Auth();
   	$authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
}

//$sessionManager -> logout();

include_once 'includes/footer.php';

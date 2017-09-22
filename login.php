<?php

include_once 'includes/initialFunc.php';

$loginPage = '';

$page = new Pages;
//TODO
//$loginPage .= $page->loginPage($_SERVER['REQUEST_URI']);  basename($_SERVER['SCRIPT_NAME'])
$loginPage .= $page->loginPage('login');

$sessions = new Sessions;

if (isset($_POST['EnterBtn'])) {
    $arrayData['user_login'] = $_POST['user_login'];
    $arrayData['user_pass'] = $_POST['user_pass'];
    $authentication = new Auth();
    $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
    $auth['is_auth'] == true ? $sessions->authenticationToSession($auth['user']) : $sessions->recordMessageInSession('auth', $auth['error_msg']);
}
$sessions->unsetMessages();
$bodyPage .= $loginPage;

$sessions = new Sessions;
if ($sessions->issetLogin() == true) {
    header("Location: index.php");
}

include_once 'includes/body.php';

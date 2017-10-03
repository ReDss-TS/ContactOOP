<?php

include_once 'includes/initialFunc.php';

$loginPage = '';

//$page = new Pages;
$loginPage .= Pages::getInstance()->loginPage('register');

$sessions = new Sessions;

if (isset($_POST['RegisterBtn'])) {
    $arrayData['user_login'] = $_POST['user_login'];
    $arrayData['user_pass'] = $_POST['user_pass'];
    $registr = new Registration();
    $result = $registr->register($arrayData['user_login'], $arrayData['user_pass']);
    $sessions->recordMessageInSession('register', $result['msg']);
}
$sessions->unsetMessages();
$bodyPage .= $loginPage;

include_once 'includes/body.php';
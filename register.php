<?php

include_once 'includes/autoloadClasses.php';
$bodyPage = '';
$loginPage = '';

$page = Pages::getInstance();
$loginPage .= $page->loginPage('register');

$sessions = Sessions::getInstance();

if (isset($_POST['RegisterBtn'])) {
    $arrayData['user_login'] = $_POST['user_login'];
    $arrayData['user_pass'] = $_POST['user_pass'];
    $registr = new Registration();
    $result = $registr->register($arrayData['user_login'], $arrayData['user_pass']);
    $sessions->recordMessageInSession('register', $result['msg']);
}

$bodyPage .= $sessions->showMessages();
$sessions->unsetMessages();
$bodyPage .= $loginPage;

include_once 'includes/header.php';
echo $bodyPage;
include_once 'includes/footer.php';
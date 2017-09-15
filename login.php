<?php

include_once 'includes/autoloadClasses.php';
$bodyPage = '';
$loginPage = '';

$page = Pages::getInstance();
//TODO
//$loginPage .= $page->loginPage($_SERVER['REQUEST_URI']);
$loginPage .= $page->loginPage('login');

$sessions = Sessions::getInstance();

if (isset($_POST['EnterBtn'])) {
    $arrayData['user_login'] = $_POST['user_login'];
    $arrayData['user_pass'] = $_POST['user_pass'];
    $authentication = new Auth();
    $auth = $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
    array_key_exists('msg', $auth) ? $sessions->recordMessageInSession('auth', $auth['msg']) : $sessions->authenticationToSession($auth);
}

$bodyPage .= $sessions->showMessages();
$sessions->unsetMessages();
$bodyPage .= $loginPage;

include_once 'includes/header.php';
echo $bodyPage;
include_once 'includes/footer.php';

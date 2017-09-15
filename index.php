<?php

include_once 'includes/autoloadClasses.php';

$bodyPage = '';

$sessions = Sessions::getInstance();
$isSignIn = $sessions->issetLogin();

if ($isSignIn == true) {
    $page = Pages::getInstance();
    $bodyPage .= $page->mainPage();
} else {
    header("Location: login.php");
}

$bodyPage .= $sessions->showMessages();
$sessions->unsetMessages();
$bodyPage .= $loginPage;

//$sessions->logout();
include_once 'includes/header.php';
echo $bodyPage;
include_once 'includes/footer.php';

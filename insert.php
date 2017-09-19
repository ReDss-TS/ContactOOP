<?php

include_once 'includes/autoloadClasses.php';

$bodyPage = '';

$sessions = Sessions::getInstance();
$isSignIn = $sessions->issetLogin();

if ($isSignIn == true) {
    $page = Pages::getInstance();
    $bodyPage .= $page->insertPage('insert'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

if (isset($_POST['AddBtn'])) {
    //TODO
}


$bodyPage .= $sessions->showMessages();
$sessions->unsetMessages();

//$sessions->logout();
include_once 'includes/header.php';
echo $bodyPage;
include_once 'includes/footer.php';
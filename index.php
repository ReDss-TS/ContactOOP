<?php

include_once 'includes/autoloadClasses.php';

$bodyPage = '';

$sessions = new Sessions;
$isSignIn = $sessions->issetLogin();

if ($isSignIn == true) {
    $page = new Pages;
    $bodyPage .= $page->mainPage();
} else {
    header("Location: login.php");
}

$bodyPage .= $sessions->showMessages();
$sessions->unsetMessages();

include_once 'includes/header.php';
echo $bodyPage;
include_once 'includes/footer.php';

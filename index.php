<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    $page = new Pages;
    $bodyPage .= $page->mainPage();
} else {
    header("Location: login.php");
}


$sessions->unsetMessages();
include_once 'includes/body.php';

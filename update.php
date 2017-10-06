<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    //$page = new Pages;
    $bodyPage .= Pages::getInstance()->updatePage('update'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

$sessions->unsetMessages();
include_once 'includes/body.php';
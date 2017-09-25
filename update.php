<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    $page = new Pages;
    $bodyPage .= $page->insertPage('update'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

if (isset($_POST['DoneBtn'])) {
    
}

$sessions->unsetMessages();
include_once 'includes/body.php';
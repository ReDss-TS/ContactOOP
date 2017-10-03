<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    //$page = new Pages;
    $bodyPage .= Pages::getInstance()->mainPage();
} else {
    header("Location: login.php");
}

$paginationObj = new Pagination;
$pagination =  $paginationObj->getPagination();
$bodyPage .= $pagination;
$sessions->unsetMessages();
include_once 'includes/body.php';

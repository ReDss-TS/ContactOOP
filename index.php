<?php

include_once 'includes/initialFunc.php';
$paginationObj = new Pagination;
$paginationObj->createPagination();

if ($isSignIn == true) {
    //$page = new Pages;
    $bodyPage .= Pages::getInstance()->mainPage();
} else {
    header("Location: login.php");
}

$pagination =  $paginationObj->getPagination();
$bodyPage .= $pagination;
$sessions->unsetMessages();
include_once 'includes/body.php';

// include_once 'includes/autoloadClasses.php';

// $bodyPage = '';

// $sessions = new Sessions;
// $isSignIn = $sessions->issetLogin();
// $bodyPage .= $sessions->showMessages();
// var_dump(basename($_SERVER['REQUEST_URI']));
// if ($isSignIn == true) {
//     $bodyPage .= Pages::getInstance()->mainPage();
// } else {
//     header("Location: login.php");
// }

// include_once 'includes/header.php';
// echo $bodyPage;
// include_once 'includes/footer.php';

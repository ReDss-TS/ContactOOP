<?php

include_once 'includes/initialFunc.php';

$loginPage = '';

$loginPage .= Pages::getInstance()->loginPage('login');

$sessions = new Sessions;

$sessions->unsetMessages();
$bodyPage .= $loginPage;

include_once 'includes/body.php';

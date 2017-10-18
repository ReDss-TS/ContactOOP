<?php

include_once 'includes/autoloadClasses.php';
$sessions = new Sessions;
$bodyPage = '';
$bodyPage .= $sessions->showMessages();

$requestMethod = basename($_SERVER['REQUEST_URI']);
$requestMethod = substr($requestMethod, 0, strpos($requestMethod, "."));

$bodyPage .= Pages::getInstance()->$requestMethod();

include_once 'includes/body.php';

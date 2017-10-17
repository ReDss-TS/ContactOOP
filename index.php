<?php

include_once 'includes/initialFunc.php';

$requestMethod = basename($_SERVER['REQUEST_URI']);
$requestMethod = substr($requestMethod, 0, strpos($requestMethod, "."));

$bodyPage .= Pages::getInstance()->$requestMethod();



$sessions->unsetMessages();
include_once 'includes/body.php';

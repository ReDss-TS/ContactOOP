<?php

include_once 'includes/autoloadClasses.php';

$bodyPage = '';

$sessions = new Sessions;
$isSignIn = $sessions->issetLogin();

$bodyPage .= $sessions->showMessages();

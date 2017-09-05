<?php

include_once 'includes/headHtml.php';

function __autoload($className)
{
    //$className = str_replace("..", "", $className);
    require_once("classes/$className.php");
}

$sessionManager = new Sessions();
$sessionManager -> showMessages();
$sessionManager -> unsetMessages();



if (isset($_POST['EnterBtn'])) {
    $arrayData['user_login'] = $_POST['user_login'];
    $arrayData['user_pass'] = $_POST['user_pass'];

    $authentication = new Auth();
    $authentication->authentication($arrayData['user_login'], $arrayData['user_pass']);
}

$allData = new Table();
$tableHeaders = $allData -> tableHeaders();

$tableForData = new Forms();
$tableWithData = $tableForData -> createHtmlTable($tableHeaders);

$sessionManager -> logout();

include_once 'includes/footer.php';

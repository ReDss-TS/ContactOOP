<?php

include_once 'includes/headHtml.php';

function __autoload($className)
{
    //$className = str_replace("..", "", $className);
    require_once("classes/$className.php");
}

$sessionManager = new SessionManager();

$conn = new DBManager();


include_once 'includes/footer.php';

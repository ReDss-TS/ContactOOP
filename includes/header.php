<?php

include_once 'includes/autoloadClasses.php';

$page = basename($_SERVER['SCRIPT_NAME']);
$header= new Header();
$title = $header->headTitle($page);
$btns = $header->headBtn($page);
?>


<!DOCTYPE html>
<html>
<head>
    <link href="styles/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="header" id="myHead">
        <h3>
           CONTACT MANAGEMENT
           <?php echo '</br>' . $title; ?>
           <?php echo $btns; ?>
        </h3>
    </div>
    <hr/>

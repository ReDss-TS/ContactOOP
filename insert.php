<?php

include_once 'includes/autoloadClasses.php';

$bodyPage = '';

$sessions = new Sessions;
$isSignIn = $sessions->issetLogin();

if ($isSignIn == true) {
    $page = new Pages;
    $bodyPage .= $page->insertPage('insert'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

if (isset($_POST['AddBtn'])) {
    $contacts = new Contacts;
    $labelsOfContact = $contacts->getLabelsOfContact();

    $inputValues = [];
    foreach ($labelsOfContact as $key => $value) {
        $inputValues[] = $_POST[$value];
    }
    $insert = new InsertValues;
    $isInserted = $insert->insert($labelsOfContact, $inputValues);

    $sessions = new Sessions;
	if ($isInserted == true) {
		$sessions->recordMessageInSession('insert', "New record created successfully");
		header("Location: index.php");
	} else {
        $sessions->recordMessageInSession('insert', "New record not created");
    }
}


$bodyPage .= $sessions->showMessages();
$sessions->unsetMessages();

//$sessions->logout();
include_once 'includes/header.php';
echo $bodyPage;
include_once 'includes/footer.php';
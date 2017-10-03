<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    //$page = new Pages;
    $bodyPage .= Pages::getInstance()->insertPage('insert'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

if (isset($_POST['AddBtn'])) {
    $contacts = new Contacts;
    $labelsOfContact = $contacts->getLabelsOfContact();
    $valuesObj = new Values;
    $inputValues = $valuesObj->getInputValues($labelsOfContact);
    $isInserted = $valuesObj->insert($labelsOfContact, $inputValues);

    $sessions = new Sessions;
	if ($isInserted == true) {
		$sessions->recordMessageInSession('insert', "New record created successfully");
		header("Location: index.php");
	} else {
        $sessions->recordMessageInSession('insert', "New record not created");
    }
}

include_once 'includes/body.php';

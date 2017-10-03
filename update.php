<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    //$page = new Pages;
    $bodyPage .= Pages::getInstance()->updatePage('update'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

if (isset($_POST['DoneBtn'])) {
    $contacts = new Contacts;
    $labelsOfContact = $contacts->getLabelsOfContact();
    $valuesObj = new Values;
    $inputValues = $valuesObj->getInputValues($labelsOfContact);
    $isUpdated = $valuesObj->update($labelsOfContact, $inputValues, $_SESSION['idLine']);

    $sessions = new Sessions;
	if ($isUpdated == true) {
		$sessions->recordMessageInSession('update', "Record update successfully!");
		header("Location: index.php");
	} else {
        $sessions->recordMessageInSession('update', "New record not updated");
    }
    //unset($_SESSION['idLine']);
}

$sessions->unsetMessages();
include_once 'includes/body.php';
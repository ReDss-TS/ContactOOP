<?php

include_once 'includes/initialFunc.php';

if ($isSignIn == true) {
    $page = new Pages;
    $bodyPage .= $page->updatePage('update'); //TODO basename($_SERVER['SCRIPT_NAME'])
} else {
    header("Location: login.php");
}

if (isset($_POST['DoneBtn'])) {
    $contacts = new Contacts;
    $labelsOfContact = $contacts->getLabelsOfContact();
   
    $inputValues = Values::getInstance()->getInputValues($labelsOfContact);
    $isUpdated = Values::getInstance()->update($labelsOfContact, $inputValues, $_POST['idLine']);

    $sessions = new Sessions;
	if ($isInserted == true) {
		$sessions->recordMessageInSession('update', "Record update successfully!");
		header("Location: index.php");
	} else {
        $sessions->recordMessageInSession('update', "New record not updated");
    }
}

$sessions->unsetMessages();
include_once 'includes/body.php';
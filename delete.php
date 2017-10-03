<?php

include_once 'includes/autoloadClasses.php';

$delete = new DeleteData;
$isDeleted = $delete->deleteContacts($_POST['idLine']);

$sessions = new Sessions;
if ($isDeleted == true) {
    $sessions->recordMessageInSession('delete', "Record deleted successfully!");
    header("Location: index.php");
} else {
    $sessions->recordMessageInSession('delete', "Record has not been deleted!");
}


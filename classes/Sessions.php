<?php

class Sessions
{
	function __construct()
    {	
    	session_start();
    	$dataForUpdate = array();
		$selectedRadio = 0;
		$listWithInputError = '';

        if (!(isset($_SESSION['login']))) {
            $formForLogin = new Forms();
			$form = $formForLogin->buildForm('user_form', $dataForUpdate, $selectedRadio, $listWithInputError);
			$page = $formForLogin->createHtmlBlock('Registration', $form, 'Enter', 'Register');
			echo $page;
        }
    }


	function recordMessageInSession($addressMsg, $msg)
	{
	    $_SESSION['message'][$addressMsg] = $msg;
	}

	function showMessages()
	{
	    $messages = '';
	    if (!empty($_SESSION['message'])) {
	        foreach ($_SESSION['message'] as $key => $value) {
	            $messages .= "<label class = \"msg\">$value</label><br/>";
	        }
	    }
	    echo $messages;
	}

	function unsetMessages()
	{
	    unset($_SESSION['message']);
	}

	function logout()
	{
    	session_destroy();
	}
}
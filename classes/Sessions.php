<?php

class Sessions
{
	function __construct()
    {	
        
    }

    function issetLogin() 
    {
    	if (isset($_SESSION['login'])) {
        	return 'yes';
        }
        return 'no';
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
<?php

class SessionManager
{
	function __construct()
    {
        if (!(isset($_SESSION['login']))) {
            header("Location: login.php");
            exit;
        }
    }
}
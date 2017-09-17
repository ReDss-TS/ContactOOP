<?php

class Logout
{
	private static $instance;

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function goOut()
    {
        session_destroy();
        header("Location: login.php");
    }
}
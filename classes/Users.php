<?php

class Users
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

    public function selectPasswordByLogin($login)
    {
        $selectQuery = "SELECT * FROM users where login = '$login'";
        return $selectQuery;
    }

    public function insertUserIntoDB($login, $pass)
    {
        $insertUserQuery = "INSERT INTO users (login, pass) VALUES ('$login', '$pass');";
        return $insertUserQuery;
    }
}
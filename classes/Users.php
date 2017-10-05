<?php

class Users
{
    public function selectPasswordByLogin($login)
    {
        $selectQuery = "SELECT * FROM users where login = '$login'";
        $resultSelect = Db::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($login, $pass)
    {
        $insertUserQuery = "INSERT INTO users (login, pass) VALUES ('$login', '$pass');";
        $resultInsert = Db::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
    }
}
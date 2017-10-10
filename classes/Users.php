<?php

class Users
{
    public function selectPasswordByLogin($login)
    {
        $dataForEscape['login'] = $login;
        $escapedData = Db::getInstance()->escapeData($dataForEscape);
        $selectQuery = "SELECT * FROM users where login = '" . $escapedData['login'] . "'";
        $resultSelect = Db::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($login, $pass)
    {
        $dataForEscape = [];
        $dataForEscape['login'] = $login;
        $dataForEscape['pass'] = $pass;
        $escapedData = Db::getInstance()->escapeData($dataForEscape);

        $insertUserQuery = "INSERT INTO users (login, pass) VALUES ('" . $escapedData['login'] . "', '" . $escapedData['pass'] . "');";
        $resultInsert = Db::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
    }
}
<?php

class Auth
{    
    function authentication($ulogin, $upass)
    {    
        $upass = md5($upass);
        $selectLogin = $this->createQuery($ulogin, $upass);
        $resultQuery = Db::getInstance()->selectFromDB($selectLogin);
        if (!empty($resultQuery)) {
            foreach ($resultQuery as $key => $value) {
                if ($value['pass'] === $upass) {
                    return $resultQuery;
                }
                return "Password is incorrect!";
            }
        }
        return "Login is incorrect";
    }

    function createQuery($ulogin, $upass)
    {
        $dataForAuthent = array();
        $dataForAuthent['login'] = $ulogin;
        $dataForAuthent['pass'] = $upass;

        $escapeData = Db::getInstance()->escapeData($dataForAuthent);
        $selectPasswordByLogin = Queries::getInstance()->selectPasswordByLogin($escapeData['login']);
        return $selectPasswordByLogin;
    }

}
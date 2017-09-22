<?php

class Registration
{    
    public function register($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $selectLogin = $this->createSelectLoginQuery($ulogin, $upass);
        $insertUser = $this->createInsertUserQuery($ulogin, $upass);

        $resultSelectLoginQuery = Db::getInstance()->selectFromDB($selectLogin);
        $resultInsertUserQuery = Db::getInstance()->insertToDB($insertUser);

        if ($resultSelectLoginQuery->num_rows > 0) {
            $msg['msg'] = 'login is busy! Please enter another login';
        } else {
            if ($resultInsertUserQuery === true) {
                $msg['msg'] = 'You have successfully registered!';
            } else {
                $msg['msg'] = "Error";
            }           
        }
        return $msg;
    }

    private function dataEscape($ulogin, $upass)
    {
        $dataForAuthent = array();
        $dataForAuthent['login'] = $ulogin;
        $dataForAuthent['pass'] = $upass;
        $escapeData = Db::getInstance()->escapeData($dataForAuthent);
        return $escapeData;
    }


    private function createSelectLoginQuery($ulogin, $upass)
    {
        $escapeData = $this->dataEscape($ulogin, $upass);
        $usersObj = new Users;
        $selectPasswordByLogin = $usersObj->selectPasswordByLogin($escapeData['login']);
        return $selectPasswordByLogin;
    }

    private function createInsertUserQuery($ulogin, $upass)
    {
        $escapeData = $this->dataEscape($ulogin, $upass);
        $usersObj = new Users;
        $insertUserIntoDB = $usersObj->insertUserIntoDB($escapeData['login'], $escapeData['pass']);
        return $insertUserIntoDB;
    }
}
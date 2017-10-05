<?php

class Registration
{    
    public function register($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $selectedLogin = $this->createSelectLoginQuery($ulogin, $upass);
        $insertedUser = $this->createInsertUserQuery($ulogin, $upass);

        if ($selectedLogin->num_rows > 0) {
            $msg['msg'] = 'login is busy! Please enter another login';
        } else {
            if ($insertedUser === true) {
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
        $selectedPasswordByLogin = $usersObj->selectPasswordByLogin($escapeData['login']);
        return $selectedPasswordByLogin;
    }

    private function createInsertUserQuery($ulogin, $upass)
    {
        $escapeData = $this->dataEscape($ulogin, $upass);
        $usersObj = new Users;
        $insertUserIntoDB = $usersObj->insertUserIntoDB($escapeData['login'], $escapeData['pass']);
        return $insertUserIntoDB;
    }
}
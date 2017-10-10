<?php

class Registration
{    
    public function register($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $selectedLogin = $this->createSelectLoginQuery($ulogin);
        if (is_array($selectedLogin)) {
            $msg['msg'] = 'login is busy! Please enter another login';
        } else {
            $insertedUser = $this->createInsertUserQuery($ulogin, $upass);
            if ($insertedUser === true) {
                $msg['msg'] = 'You have successfully registered!';
            } else {
                $msg['msg'] = "Error";
            }           
        }
        return $msg;
    }

    private function createSelectLoginQuery($ulogin)
    {
        $usersObj = new Users;
        return $usersObj->selectPasswordByLogin($ulogin);
    }

    private function createInsertUserQuery($ulogin, $upass)
    {
        $usersObj = new Users;
        $insertUserIntoDB = $usersObj->insertUserIntoDB($ulogin, $upass);
        return $insertUserIntoDB;
    }
}
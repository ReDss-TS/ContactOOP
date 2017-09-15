<?php

class Registration
{    
    public function registration($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5(trim($upass));
        $selectLogin = $this->createSelectLoginQuery($ulogin, $upass);
        $insertUser = $this->createInsertUserQuery($ulogin, $upass);

        $resultSelectLoginQuery = Db::getInstance()->selectFromDB($selectLogin);
        $resultInsertUserQuery = Db::getInstance()->insertToDB($selectLogin);

        if ($resultSelectLoginQuery->num_rows > 0) {
            $msg['msg'] = 'login is busy! Please enter another login';
        } else {
            if ($resultInsertUserQuery === true) {
                $msg['msg'] = 'You have successfully registered!';
            } else {
                $msg['msg'] = "Error: $mysql->error";
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
        $escapeData = $this->createQuery($ulogin, $upass);
        $selectPasswordByLogin = Queries::getInstance()->selectPasswordByLogin($escapeData['login']);
        return $selectPasswordByLogin;
    }

    private function createInsertUserQuery($ulogin, $upass)
    {
        $escapeData = $this->createQuery($ulogin, $upass);
        $insertUserIntoDB = Queries::getInstance()->insertUserIntoDB($escapeData['login']);
        return $insertUserIntoDB;
    }
}
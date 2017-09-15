<?php

class Auth
{    
    public function authentication($ulogin, $upass)
    {   
        $msg = [];
        $upass = md5($upass);
        $selectLogin = $this->createQuery($ulogin, $upass);
        $resultQuery = Db::getInstance()->selectFromDB($selectLogin);
        if (!empty($resultQuery)) {
            foreach ($resultQuery as $key => $value) {
                if ($value['pass'] === $upass) {
                    return $resultQuery;
                } else {
                    $msg['msg'] = 'Password is incorrect!';
                }
            }
        } else {
            $msg['msg'] = 'Login is incorrect';  
        }
        return $msg;
    }

    private function createQuery($ulogin, $upass)
    {
        $dataForAuthent = array();
        $dataForAuthent['login'] = $ulogin;
        $dataForAuthent['pass'] = $upass;

        $escapeData = Db::getInstance()->escapeData($dataForAuthent);
        $selectPasswordByLogin = Queries::getInstance()->selectPasswordByLogin($escapeData['login'], $escapeData['pass']);
        return $selectPasswordByLogin;
    }

}

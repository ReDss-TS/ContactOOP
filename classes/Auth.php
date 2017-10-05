<?php

class Auth
{    
    public function authentication($ulogin, $upass)
    {   
        $msg = [
            'is_auth' => '',
            'user' => '',
            'error_msg' => ''
        ];

        $upass = md5($upass);
        $selectedUserData = $this->selectLogin($ulogin, $upass);
        var_dump($selectedUserData);  
        if (!empty($selectedUserData)) {
            foreach ($selectedUserData as $key => $value) {
                if ($value['pass'] === $upass) {
                    $msg['is_auth'] = true;
                    $msg['user'] = $selectedUserData;
                } else {
                    $msg['is_auth'] = false;
                    $msg['error_msg'] = 'Password is incorrect!';
                }
            }
        } elseif ($selectedUserData->num_rows == 0) {
            $msg['is_auth'] = false;
            $msg['error_msg'] = 'Login is incorrect';
        } 
        return $msg;
    }

    private function selectLogin($ulogin, $upass)
    {
        $dataForAuthent = array();
        $dataForAuthent['login'] = $ulogin;
        $dataForAuthent['pass'] = $upass;

        $escapeData = Db::getInstance()->escapeData($dataForAuthent);
        $usersObj = new Users;
        $selectedPasswordByLogin = $usersObj->selectPasswordByLogin($escapeData['login']);
        return $selectedPasswordByLogin;
    }

}

<?php

class Auth
{    
    public function authentication($ulogin, $upass)
    {   
        $msg = [
            'is_auth' => 'false',
            'user' => '',
            'error_msg' => ''
        ];

        $upass = md5($upass);
        $selectedUserData = $this->selectLogin($ulogin, $upass);
        if (is_array($selectedUserData)) {
                if ($selectedUserData[0]['pass'] === $upass) {
                    $msg['is_auth'] = true;
                    $msg['user'] = $selectedUserData;
                } else {
                    $msg['is_auth'] = false;
                    $msg['error_msg'] = 'Password is incorrect!';
                }
        } elseif ($selectedUserData->num_rows == 0) {
            $msg['is_auth'] = false;
            $msg['error_msg'] = 'Login is incorrect';
        } 
        return $msg;
    }

    private function selectLogin($ulogin, $upass)
    {
        $usersObj = new Users;
        $selectedPasswordByLogin = $usersObj->selectPasswordByLogin($ulogin);
        return $selectedPasswordByLogin;
    }

}

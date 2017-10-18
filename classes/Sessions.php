<?php

class Sessions
{
    public function issetLogin() 
    {
        if (isset($_SESSION['login'])) {
            return true;
        }
        return false;
    }

    public function recordMessageInSession($addressMsg, $msg)
    {
        $_SESSION['message'][$addressMsg] = $msg;
    }

    public function showMessages()
    {
        $messages = '';
        if (!empty($_SESSION['message'])) {
            foreach ($_SESSION['message'] as $key => $value) {
                $messages .= "<label class = \"msg\">$value</label><br/>";
            }
        }
        $this->unsetMessages();
        return $messages;
    }

    private function unsetMessages()
    {
        unset($_SESSION['message']);
    }

    public function logout()
    {
        session_destroy();
    }

    public function authenticationToSession($authData)
    {    
        foreach ($authData as $key => $value) {
            $_SESSION['userId'] = $value['id'];
            $_SESSION['login'] = $value['login'];
        }
    }

    public function getUserID()
    {
        return $_SESSION['userId'];
    }
}

<?php

class Sessions
{
    private static $instance;

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

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
        return $messages;
    }

    public function unsetMessages()
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
}

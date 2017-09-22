<?php

class Logout
{
    public function goOut()
    {
        session_destroy();
        header("Location: login.php");
    }
}
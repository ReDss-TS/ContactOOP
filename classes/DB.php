<?php

class DB
{
    public $server = 'localhost';
    public $user   = 'admin';
    public $passwd = '7535';
    public $db     = 'contact_record';

    protected $dbCon;

    private static $_instance;

    protected function __construct()
    {
        $this->dbCon = mysqli_connect($this->server, $this->user, $this->passwd, $this->db);
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function getConnect()
    {
        return $this->dbCon;
    }

    function selectFromDB($sqlQuery)
    {
        $result = $this->dbCon->query($sqlQuery);
        if ($result->num_rows > 0) {
            while ($row =  $result->fetch_assoc()) {
                $array[] = $row;
            }
        }
        if (!empty($array)) {
            return $array;
        }
    }

}


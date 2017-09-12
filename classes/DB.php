<?php

class DB
{
    public $dbConf;
    public $conn;

    private static $instance;

    private function __construct()
    {
        $this->dbConf = include('includes/config.php');
        $this->conn = mysqli_connect($this->dbConf['server'], $this->dbConf['user'], $this->dbConf['passwd'], $this->dbConf['db']);

        if (mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }

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

    function selectFromDB($sqlQuery)
    {
        $result = $this->conn->query($sqlQuery);
        if ($result->num_rows > 0) {
            while ($row =  $result->fetch_assoc()) {
                $array[] = $row;
            }
        }
        if (!empty($array)) {
            return $array;
        }
    }

    function escapeData($data)
    {   
        foreach ($data as $key => $value) {
            $val = mysqli_real_escape_string($this->conn, $value);
            $this->ValidateData[$key] = $val;
        }
        return $this->ValidateData;
    }

}


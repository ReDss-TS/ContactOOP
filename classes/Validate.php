<?php

class Validate extends DB
{
    public $ValidateData = array();

    function __construct()
    {   
        parent::__construct();
    }

	function escapeData($data)
	{
    	foreach ($data as $key => $value) {
        	$val = mysqli_real_escape_string($this->dbCon, $value);
        	$this->ValidateData[$key] = $val;
    	}
    	return $this->ValidateData;
	}
}
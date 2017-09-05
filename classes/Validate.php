<?php

class Validate
{
	function escapeData($data)
	{
		$conn = new DB();
		$conn -> connect();
    	$array = array();
    	foreach ($data as $key => $value) {
        	$val = $conn -> escapeString($value);
        	$array[$key] = $val;
    	}
    	return $array;
	}
}
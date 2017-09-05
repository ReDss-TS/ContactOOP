<?php

class Auth
{
	function authentication($ulogin, $upass)
	{
	    $upass = md5($upass);
	    $dataForAuthent = array();
	    $dataForAuthent['login'] = $ulogin;
	    $dataForAuthent['pass'] = $upass;

	    $data = new Validate();
	    $escapeData = $data -> escapeData($dataForAuthent);

	    $selectQuery = "SELECT * FROM users where login ='" . $escapeData['login'] . "'";


	    $selectLogin = new DB();
		$selectLogin -> connect();
		$result = $selectLogin -> selectFromDB($selectQuery);

		$MessageInSession = new Sessions();

	    if (!empty($result)) {
	        foreach ($result as $key => $value) {
	            if ($value['pass'] === $upass) {
	                $_SESSION['userId'] = $value['id'];
	                $_SESSION['login'] = $value['login'];
	                header("Location: index.php");
	            } else {
					$MessageInSession -> recordMessageInSession('authent', "Password is incorrect!"); 
	            }
	        }
	    } else {
	    	$MessageInSession -> recordMessageInSession('authent', "Login is incorrect!");
	    }
	}
}
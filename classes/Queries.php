<?php

class Queries
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


	function selectDataForMainPage()
	{
        $userId = $_SESSION['userId'];
        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_phones.phone
                            FROM contact_list 
                                INNER JOIN contact_phones 
                                    ON contact_list.id = contact_phones.contactId
                                        WHERE contact_list.userId      = $userId
                                        AND contact_list.favoritePhone = contact_phones.phoneType";
	    return $selectQuery;
    }

    function selectPasswordByLogin($login)
    {
        $selectQuery = "SELECT * FROM users where login = '$login'";
        return $selectQuery;
    }
}
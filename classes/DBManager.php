<?php

class DBManager
{
    public $server = 'localhost';
    public $user   = 'admin';
    public $passwd = '7535';
    public $db     = 'contact_record';
    public $dbCon;

    function __construct()
    {
        $this->dbCon = mysqli_connect($this->server, $this->user, $this->passwd, $this->db);
    }

    function __destruct()
    {
        $this->close();
    }

    /*function selectMainPageData()
    {
        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_phones.phone
                    FROM contact_list 
                        INNER JOIN contact_phones 
                            ON contact_list.id = contact_phones.contactId
                                WHERE contact_list.userId      = $sessionUserId
                                AND contact_list.favoritePhone = contact_phones.phoneType
                                    ORDER BY $tablePlusOrder $sort 
                                        LIMIT $pageFirstResult , $resultsPerPage";

        $results = mysqli_query($this->dbCon, $selectQuery);
        return $results;
    }*/

    function selectFromDB($sqlQuery)
    {
        $result = $this->query($sqlQuery);
        if ($result->num_rows > 0) {
            while ($row =  $result->fetch_assoc()) {
                $array[] = $row;
            }
        }
        if (!empty($array)) {
            return $array;
        }
    }

    function authentication($ulogin, $upass)
    {
        $upass = md5($upass);
        $dataForAuthent['login'] = $ulogin;
        $dataForAuthent['pass'] = $upass;
        //$data = escapeData($mysql, $dataForAuthent);
        $selectQuery = "SELECT * FROM users where login ='" . $dataForAuthent['login'] . "'";

        $result = selectFromDB($selectQuery);

        if (!empty($result)) {
            foreach ($result as $key => $value) {
                if ($value['pass'] === $upass) {
                    $_SESSION['userId'] = $value['id'];
                    $_SESSION['login'] = $value['login'];
                    header("Location: index.php");
                } else {
                    echo "Password is incorrect!";
                }
            }
        } else {
             echo "Login is incorrect!";
        }
    }

}


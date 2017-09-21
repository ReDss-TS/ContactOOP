<?php

class Contacts
{
    public $labelsOfContact = [
        'user_name',
        'user_surname',
        'user_mail',
        'bestPhone',
        'user_hPhone',
        'user_wPhone',
        'user_cPhone',
        'user_address1',
        'user_address2',
        'user_city',
        'user_state',
        'user_zip',
        'user_country',
        'user_birthday'
    ];

    public function getLabelsOfContact()
    {
        return $this->labelsOfContact;
    }

    public function selectDataForMainPage()
    {
        $userId = $_SESSION['userId'];
        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_phones.phone
                            FROM contact_list 
                                INNER JOIN contact_phones 
                                    ON contact_list.id = contact_phones.contactId
                                        WHERE contact_list.userId      = $userId
                                        AND contact_list.favoritePhone = contact_phones.phoneType";

        $resultSelect = Db::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertDataToContactList($data)
    {
        $insertQuery = "INSERT INTO contact_list (userId, firstName, lastName, email, favoritePhone) VALUES (
            '" . $data['userId'] . "',
            '" . $data['user_name'] . "',
            '" . $data['user_surname'] . "',
            '" . $data['user_mail'] . "',
            '" . $data['bestPhone'] . "'
        )";
        $resultInsert = Db::getInstance()->insertToDB($insertQuery);
        $lastContactID = $this->getLastID($resultInsert);
        return $lastContactID;
    }

    private function getLastID($answer)
    {
        $lastID = Db::getInstance()->getLastId();
        if ($lastID != '') {
            return $lastID;
        } else {
            //TODO
            echo 'Error: getlastID';
        }
    }

    public function insertDataToContactPhones($contactID, $data)
    {
        foreach ($data as $key => $value) {
            $insertQuery = "INSERT INTO contact_phones (contactId, phone, phoneType) VALUES (
                '" . $contactID . "',
                '" . $value . "',
                '" . $key . "'
            )";
            $resultInsert = Db::getInstance()->insertToDB($insertQuery);
        }
        return $resultInsert;
    }

    public function insertDataToContactAddress($contactID, $data)
    {
        $insertQuery = "INSERT INTO contact_address (contactId, address1, address2, city, state, zip, country, birthday) VALUES (
            '" . $contactID . "',
            '" . $data['user_address1'] . "',
            '" . $data['user_address2'] . "',
            '" . $data['user_city'] . "',
            '" . $data['user_state'] . "',
            '" . $data['user_zip'] . "',
            '" . $data['user_country'] . "',
            '" . $data['user_birthday'] . "'
        )";
        $resultInsert = Db::getInstance()->insertToDB($insertQuery);
        return $resultInsert;
    }

    public function isInserted($result) //TODO
    {
        $amount = 0;
        $num = count($result);
        foreach ($result as $key => $value) {
            if (!empty($value)) {
                $amount++;
            }
        }
        if ($amount == $num) {
            return true;
        }
        return $amount;
    }
}
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

    private function getUserID()
    {
        $session = new Sessions;
        return $session->getUserID();
    }

    public function selectDataForMainPage()
    {
        $orderObj = new Order;
        $sortObj = new Sort;
        $userId = $this->getUserID();
        $order = $orderObj->getOrderBy();
        $sort = $sortObj->getSortBy();

        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_phones.phone
                            FROM contact_list 
                                INNER JOIN contact_phones 
                                    ON contact_list.id = contact_phones.contactId
                                        WHERE contact_list.userId      = $userId
                                        AND contact_list.favoritePhone = contact_phones.phoneType
                                            ORDER BY $order $sort";

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
        if (!empty($lastID)) {
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

    public function isDone($result) //TODO
    {
        $amount = 0;
        foreach ($result as $key => $value) {
            if (!empty($value)) {
                $amount++;
            }
        }
        if ($amount == count($result)) {
            return true;
        }
        return false;
    }

    public function deleteFromContactList($idLine)
    {
        $userId = $this->getUserID();
        return Db::getInstance()->delete("DELETE FROM contact_list WHERE id = '" . $idLine . "' AND userId = '" . $userId . "'");
    }

    public function selectAllData($idLine)
    {
        $userId = $this->getUserID();
        $selectQuery = "SELECT contact_list.id, contact_list.firstName, contact_list.lastName, contact_list.email, contact_list.favoritePhone, contact_address.address1, contact_address.address2, contact_address.city, contact_address.state, contact_address.zip, contact_address.country, contact_address.birthday 
                FROM contact_list 
                    INNER JOIN contact_address 
                        ON contact_list.id = contact_address.contactId
                            WHERE contact_list.userId = '" . $userId . "' AND contact_list.id = '" . $idLine . "'";

        $resultSelect = Db::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function selectPhones($idLine)
    {
        $userId = $this->getUserID();
        $selectQuery = "SELECT contact_phones.phone, contact_phones.phoneType 
                            FROM contact_phones 
                                WHERE contact_phones.contactId = '" . $idLine . "'";

        $resultSelect = Db::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function updateDataInContactList($data, $idContactList)
    {
        $userId = $this->getUserID();
        $updateQuery = "UPDATE contact_list 
            SET firstName     = '" . $data['user_name'] . "',
                lastName      = '" . $data['user_surname'] . "',
                email         = '" . $data['user_mail'] . "',
                favoritePhone = '" . $data['bestPhone'] . "' 
                    WHERE contact_list.id   = '" . $idContactList . "' 
                        AND contact_list.userId = '" . $userId . "'";
        $resultUpdate = Db::getInstance()->updateDB($updateQuery);
        return $resultUpdate;
    }

    public function updateDataToContactPhones($data, $idContactList)
    {
        foreach ($data as $key => $value) {
            $updateQuery = "INSERT INTO contact_phones (contactId, phone, phoneType) VALUES (
                '" . $idContactList . "',
                '" . $value . "',
                '" . $key . "'
                ) ON DUPLICATE KEY UPDATE phone = '" . $value . "'";
            $resultUpdate = Db::getInstance()->updateDB($updateQuery);
        }
        return $resultUpdate;
    }

    public function updateDataToContactAddress($data, $idContactList)
    {
        $userId = $this->getUserID();
        $updateQuery = "UPDATE contact_address, contact_list 
            SET address1 = '" . $data['user_address1'] . "',
                address2 = '" . $data['user_address2'] . "',
                city     = '" . $data['user_city'] . "',
                state    = '" . $data['user_state'] . "',
                zip      = '" . $data['user_zip'] . "',
                country  = '" . $data['user_country'] . "',
                birthday = '" . $data['user_birthday'] . "' 
                    WHERE contact_address.contactId = '" . $idContactList . "' 
                        AND contact_list.userId     = '" . $userId . "'";
        $resultUpdate = Db::getInstance()->updateDB($updateQuery);
        return $resultUpdate;
    }

    public function selectCountFromContactList()
    {
        $userId = $this->getUserID();
        $selectQuery = "SELECT COUNT(contact_list.id) 
                        FROM contact_list, contact_phones 
                            WHERE contact_list.id          = contact_phones.contactId 
                            AND contact_list.userId        = $userId
                            AND contact_list.favoritePhone = contact_phones.phoneType";

        $resultSelect = Db::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }
}
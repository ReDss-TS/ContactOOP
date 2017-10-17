<?php

class DeleteData
{
    public function deleteContacts($lineId)
    {
        $contactsObj = new Contacts;
        $isDeleted = $contactsObj->deleteFromContactList($lineId);
        return $isDeleted;
    }
}
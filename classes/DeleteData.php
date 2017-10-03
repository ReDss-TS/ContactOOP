<?php

class DeleteData
{
    public function deleteContacts($lineId)
    {
        $forEscape['idLine'] = $lineId;
        $data = Db::getInstance()->escapeData($forEscape);

        $contactsObj = new Contacts;
        $isDeleted = $contactsObj->deleteFromContactList($data['idLine']);
        return $isDeleted;
    }
}
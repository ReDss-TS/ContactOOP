<?php

class DeleteData
{
	public function deleteContacts($lineId)
	{
		$session = new Sessions;
        $userId = $session->getUserID();

        $forEscape['idLine'] = $lineId;
        $data = Db::getInstance()->escapeData($forEscape);

        $contactsObj = new Contacts;
        $isDeleted = $contactsObj->deleteFromContactList($data['idLine'], $userId);
        return $isDeleted;
	}
}
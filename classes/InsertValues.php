<?php

class InsertValues
{
	public function insert($labelsOfContact, $inputValues)
	{
		$data = $this->createAssociativeData($labelsOfContact, $inputValues);

		$validate = new Validate;
		//$validateMsgs = $validate->dataValidation($data);

		$session = new Sessions;
        $userId = $session->getUserID();
        
		$data = array('userId' => $userId) + $data;
		$data = Db::getInstance()->escapeData($data);

		$phonesObj = new Phones;
		$data['bestPhone'] = $phonesObj->choiceBestPhone(
											$data['bestPhone'], 
											$data['user_hPhone'], 
											$data['user_wPhone'], 
											$data['user_cPhone']
										);
		$contactObj = new Contacts;
		$results = [];
		$results['idContact'] = $contactObj->insertDataToContactList($data);
		$phones = $phonesObj->getPhones();
		$results['phones'] = $contactObj->insertDataToContactPhones($results['idContact'], $phones);
		$results['address'] = $contactObj->insertDataToContactAddress($results['idContact'], $data);

		$isInserted = $contactObj->insertDataToContactList($results);
		return $isInserted;

	}

	private function createAssociativeData($labelsOfContact, $inputValues)
	{
		for ($i = 0; $i < count($labelsOfContact); $i++) {
        	$data[$labelsOfContact[$i]] = $inputValues[$i];
    	}
    	return $data;
	}
}
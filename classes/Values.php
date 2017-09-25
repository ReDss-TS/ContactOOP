<?php

class Values
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

	public function getValuesForUpdate()
	{
		$forEscape['idLine'] = $_POST['idLine'];
        $escapeData = Db::getInstance()->escapeData($forEscape);

		$contactsObj =  new Contacts;
		$selectedData = $contactsObj->selectAllData($escapeData['idLine']);
		$selectedPhones = $contactsObj->selectPhones($escapeData['idLine']);

		$phonesObj =  new Phones;
		$phones = $phonesObj->sortPhonesByType($selectedPhones);

		foreach ($selectedData as $key => $value) {
			$valuesForUpdate = [
    			'selectedRadio' => $value['favoritePhone'],
    			'values' => [
        			'user_name'     => $value['firstName'],
        			'user_surname'  => $value['lastName'],
        			'user_mail'     => $value['email'],
        			'user_hPhone'   => $phones['hPhone'],
	        		'user_wPhone'   => $phones['wPhone'],
	        		'user_cPhone'   => $phones['cPhone'],
	        		'user_address1' => $value['address1'],
	        		'user_address2' => $value['address2'],
	        		'user_city'     => $value['city'],
	        		'user_state'    => $value['state'],
	        		'user_zip'      => $value['zip'],
	        		'user_country'  => $value['country'],
	        		'user_birthday' => $value['birthday'],
    			]
    		];
		}
		return $valuesForUpdate;
	}
}
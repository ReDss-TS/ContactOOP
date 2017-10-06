<?php

class Values
{
    protected $validateMsgs = '';
    protected $notEmptyValidateMsgs = '';

    public function getInputValues($labelsOfContact)
    {
        $inputValues = [];
        foreach ($labelsOfContact as $key => $value) {
            $inputValues[] = $_POST[$value];
        }
        return $inputValues;
    }

    public function insert($labelsOfContact, $inputValues)
    {
        $phonesObj = new Phones;
        $data = $this->preprocessingData($labelsOfContact, $inputValues);
        $data['bestPhone'] = $this->whichBestPhone($phonesObj, $data);
        if (empty($this->notEmptyValidateMsgs)) {    
            $contactObj = new Contacts;
            $results = [];
            $results['idContact'] = $contactObj->insertDataToContactList($data);
            $phones = $phonesObj->getPhones();
            $results['phones'] = $contactObj->insertDataToContactPhones($results['idContact'], $phones);
            $results['address'] = $contactObj->insertDataToContactAddress($results['idContact'], $data);
            $isInserted = $contactObj->isDone($results);
            return $isInserted;
        } else {
            //$pagesObj = new Pages;
            Pages::getInstance()->setProperties($this->validateMsgs, $data, $data['bestPhone']);
        }
    }

    public function update($labelsOfContact, $inputValues, $idLine)
    {    
        $phonesObj = new Phones;
        $data = $this->preprocessingData($labelsOfContact, $inputValues);
        $data['bestPhone'] = $this->whichBestPhone($phonesObj, $data);

        if (empty($this->notEmptyValidateMsgs)) {
            $contactObj = new Contacts;
            $results = [];
            $results['contacts'] = $contactObj->updateDataInContactList($data, $idLine);
            $phones = $phonesObj->getPhones();
            $results['phones'] = $contactObj->updateDataToContactPhones($phones, $idLine);
            $results['address'] = $contactObj->updateDataToContactAddress($data, $idLine);
            $isUpdated = $contactObj->isDone($results);
            return $isUpdated;
        } else {
            //$pagesObj = new Pages;
            Pages::getInstance()->setProperties($this->validateMsgs, $data, $data['bestPhone']);
        }
    }

    private function preprocessingData($labelsOfContact, $inputValues)
    {
        $data = $this->createAssociativeData($labelsOfContact, $inputValues);

        $validate = new Validate;
        $this->validateMsgs = $validate->validateData($data);
        $this->notEmptyValidateMsgs = array_diff($this->validateMsgs, array(''));

        $session = new Sessions;
        $userId = $session->getUserID();
        
        $data = array('userId' => $userId) + $data;
        $data = Db::getInstance()->escapeData($data);
        return $data;
    }

    private function createAssociativeData($labelsOfContact, $inputValues)
    {
        for ($i = 0; $i < count($labelsOfContact); $i++) {
            $data[$labelsOfContact[$i]] = $inputValues[$i];
        }
        return $data;
    }

    private function whichBestPhone($phonesObj, $data)
    {
        $bestPhone = $phonesObj->choiceBestPhone(
                                            $data['bestPhone'], 
                                            $data['user_hPhone'], 
                                            $data['user_wPhone'], 
                                            $data['user_cPhone']
                                        );
        return $bestPhone;
    }
    

    public function getValuesForUpdate($idLine)
    {
        $forEscape = [];
        $forEscape['idLine'] = $idLine;
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
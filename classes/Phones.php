<?php

class Phones
{	
	protected $phones = [];

    protected $typesOfPhone = [
        '0' => 'hPhone', //home Phone
        '1' => 'wPhone', //work Phone
        '2' => 'cPhone' //cell Phone
    ];

	public function choiceBestPhone($bestPhone, $hPhone, $wPhone, $cPhone)
	{
        $this->createPnonesArray($hPhone, $wPhone, $cPhone);
		$bestph = '';
		if (!empty($bestPhone)) {
        	$bestph = $bestPhone;
    	} else {
    		foreach ($this->phones as $key => $value) {
    			if (!empty($value)) {
    				$bestph = $key;
    				break;
    			}
    		}
    	}
    	return $bestph;
	}

	private function createPnonesArray($hPhone, $wPhone, $cPhone)
	{	
		$this->phones['1'] = $hPhone; //home Phone
        $this->phones['2'] = $wPhone; //work Phone
        $this->phones['3'] = $cPhone; //cell Phone
	}

    public function getPhones()
    {   
        return $this->phones;
    }

    public function sortPhonesByType($resultOfPhones)
    {
        $phones = [];
        foreach ($resultOfPhones as $key => $value) {
            foreach ($this->typesOfPhone as $k => $val) {
                if ($key == $k) {
                    $phones[$val] = $value['phone'];
                }
            }
        }
        return $phones;
    }
}
<?php

class Phones
{	
	public $phones = [
		'1' => '', //home Phone
        '2' => '', //work Phone
        '3' => ''	//cell Phone
	];

	public function choiceBestPhone($bestPhone, $hPhone, $wPhone, $cPhone)
	{
		$bestph = '';
		if (!empty($bestPhone)) {
        	$bestph = $bestPhone;
    	} else {
    		$this->createPnonesArray($hPhone, $wPhone, $cPhone);
    		foreach ($this->phones as $key => $value) {
    			if (!empty($value)) {
    				$bestph = $key;
    				break;
    			}
    		}
    	}
    	return $bestph;
	}

	private function createPnonesArray($hPhone, $wPhone, $cPhone);
	{	
		$this->phones = [
			'1' => $hPhone, //home Phone
        	'2' => $wPhone, //work Phone
        	'3' => $cPhone	//cell Phone
		];
	}

    public function getPhones()
    {
        return $this->phones;
    }
}
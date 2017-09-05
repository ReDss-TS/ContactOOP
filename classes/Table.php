<?php

class Table
{
    public $columnNames = array(
        'firstName' => 'First Name',
        'lastName'  => 'Last Name',
        'email'     => 'Email',
        'phone'     => 'Best phone',
        'edit'      => 'Edit',
        'delete'    => 'Delete'
    );

    public $tableHeader = '';
    public $sort = 'ASC';

    function tableHeaders()
    {
    	foreach ($this->columnNames as $key => $value) {
    		if ($key == 'edit' || $key == 'delete') {
        		$this->tableHeader .= "<th>$value</th>";
    		} else {
        		$this->tableHeader .= "<th><a class=\"columnNames\" href=\"?order=$key&sort=$this->sort\">$value</a></th>";
    		}
		}
		return $this->tableHeader;
    }

}
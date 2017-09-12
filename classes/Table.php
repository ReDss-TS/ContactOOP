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

    function tableData($data)
    {
        $Contacts = '';
        $Btn = new Forms();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $Contacts .= "
                <tr id = " . $value['id'] . ">
                    <td>" . $value['firstName'] . " </td>
                    <td>" . $value['lastName'] . " </td>
                    <td>" . $value['email'] . " </td>
                    <td>" . $value['phone'] . " </td>
                    <td>" . $Btn -> createBtn('edit', $value['id']) . " </td>
                    <td>" . $Btn -> createBtn('delete', $value['id']) . " </td>
                </tr> ";
            }
        }
        return $Contacts;
    }

}
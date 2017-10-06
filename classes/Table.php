<?php

class Table
{
    protected $columnNames = array(
        'firstName' => 'First Name',
        'lastName'  => 'Last Name',
        'email'     => 'Email',
        'phone'     => 'Best phone',
        'edit'      => 'Edit',
        'delete'    => 'Delete'
    );

    protected $tableHeader = '';
    protected $sortingTag = '&#8593;';

    public function tableHeaders()
    {   
        $orderObj = new Order;
        $sortObj = new Sort;
        $order = $orderObj->getOrder();
        $sort = $sortObj->changeSortBy();

        foreach ($this->columnNames as $key => $value) {
            if ($key == 'edit' || $key == 'delete') {
                $this->tableHeader .= "<th>$value</th>";
            } else {
                $this->sortingTag = ($key == $order && $sort == 'ASC') ? '&#8593;' : (($key == $order && $sort == 'DESC') ? '&#8595;' : '');
                $this->tableHeader .= "<th><a class=\"columnNames\" href=\"?order=$key&sort=$sort\">$value $this->sortingTag</a></th>";
            }
        }
        return $this->tableHeader;
    }

    public function tableData($data)
    {
        $Contacts = '';
        $Btn = new StructureForm;
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
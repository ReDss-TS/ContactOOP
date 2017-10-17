<?php

class MainTable extends Table
{
    //table column names
    protected $columnNames = [
        'firstName' => 'First Name',
        'lastName'  => 'Last Name',
        'email'     => 'Email',
        'phone'     => 'Best phone'
    ];

    protected $additionalСolumns = [
        //name   => executable file
        'edit'   => 'update',
        'delete' => 'delete'
    ];
    
    public function renderData($data)
    {
        $renderedData = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $renderedData .= "
                    <tr id = " . $value['id'] . ">
                        <td>" . $value['firstName'] . " </td>
                        <td>" . $value['lastName'] . " </td>
                        <td>" . $value['email'] . " </td>
                        <td>" . $value['phone'] . " </td>
                        <td>" . $this->createBtn('edit', $value['id']) . " </td>
                        <td>" . $this->createBtn('delete', $value['id']) . " </td>
                    </tr> ";
            }
        }
        return $renderedData;
    }

}

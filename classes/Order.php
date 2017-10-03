<?php

class Order
{   
    protected $orderBy = [
        'firstName',
        'lastName',
        'email',
        'phone'
    ];

    public function getOrder()
    {
        if (isset($_GET['order'])) {
            if ($_GET['order'] == 'firstName' || $_GET['order'] == 'lastName' || $_GET['order'] == 'email' || $_GET['order'] == 'phone') {
                $order = $_GET['order'];
            } else {
                $order = 'firstName';
            }
        } else {
            $order = 'firstName';
        }
        return $order;
    }

    public function getOrderBy()
    {  
        $order = $this->getOrder();
        if (isset($_GET['order'])) {
            if ($order == 'phone') {
                //for contact_phones table
                $tablePlusOrder = "contact_phones.". $order;
            } else {
                //for contact_list table
                $tablePlusOrder = "contact_list.". $order;
            }
        } else {
            //value by default
            $tablePlusOrder = "contact_list.firstName";
        }
        return $tablePlusOrder;
    }

}
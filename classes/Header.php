<?php

class Header
{
    public $title = [
        'index.php'    => 'Main Page',
        'login.php'    => 'Login Page',
        'register.php' => 'Registration Page'
    ];
    public $btns = [
        'index.php' => [
            'action'  => 'index.php',
            'href'    => 'insert.php',
            'btnName' => 'ADD'
        ],
        'insert.php' => [
            'action'  => 'insert.php',
            'href'    => 'index.php',
            'btnName' => 'Data'
        ]
    ];
   
    public function headBtn($page)
    {
        $btn = '';
        $HeaderBtn = new StructureForm;
        foreach ($this->btns as $key => $value) {
            if ($key == mb_strtolower($page)){
                $btn = $HeaderBtn->createHeaderBtn($value);
            }
        }
        return $btn;
    }

    public function headTitle($page)
    {
        $title = '';
        foreach ($this->title as $key => $value) {
            if ($key == mb_strtolower($page)){
                $title = $value;
            }
        }
        return $title;
    }
}
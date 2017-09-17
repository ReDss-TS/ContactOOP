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

    private static $instance;

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function headBtn($page)
    {
        $btn = '';
        foreach ($this->btns as $key => $value) {
    		if ($key == mb_strtolower($page)){
                $btn = StructureForm::getInstance()->createHeaderBtn($value);
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
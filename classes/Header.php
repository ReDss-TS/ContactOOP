<?php

class Header
{
    protected $title = [
        'index.php'    => 'Main Page',
        'login.php'    => 'Login Page',
        'register.php' => 'Registration Page',
        'insert.php'   => 'Add contacts Page',
        'update.php'   => 'Edit contacts Page'
    ];
    protected $btns = [
        'index.php' => [
            'action'  => 'index.php',
            'href'    => 'insert.php',
            'btnName' => 'ADD'
        ],
        'insert.php' => [
            'action'  => 'insert.php',
            'href'    => 'index.php',
            'btnName' => 'Data'
        ],
        'update.php' => [
            'action'  => 'update.php',
            'href'    => 'index.php',
            'btnName' => 'Data'
        ]
    ];
   
    public function headBtn($page)
    {
        $btn = '';
        foreach ($this->btns as $key => $value) {
            if ($key == mb_strtolower($page)){
                $btn = $this->createHeaderBtn($value);
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

    private function createHeaderBtn($btn)
    {
        return "<form method = \"post\" action = " . $btn['action'] . ">
                <a href = " . $btn['href'] . " class = \"button\">" . $btn['btnName'] . "</a>
                <a href = \"logout.php\" class = \"button\">Logout</a>
                </form>";
    }
}
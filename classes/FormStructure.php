<?php

class FormStructure extends Forms
{
    
    public function createHeaderBtn($btn)
    {
        return "<form method = \"post\" action = " . $btn['action'] . ">
                <a href = " . $btn['href'] . " class = \"button\">" . $btn['btnName'] . "</a>
                <a href = \"logout.php\" class = \"button\">Logout</a>
                </form>";
    }
}

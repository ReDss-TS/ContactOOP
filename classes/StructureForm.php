<?php

class StructureForm
{

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
    
    public function createStructureForm($head, $inputForm, $btn1 ,$btn2)
    {
        $structureForPage = "
            <div class = 'editBlock' id = 'editBlock'>
                <form method = 'post' action = '$head.php'>
                <div class = 'editBlockHead' id = 'editBlockHead'>
                    <h2>
                        $head
                    </h2>
                </div>
                $inputForm
                <br/>
                <input class = 'button' type = 'submit' name = '" . $btn1 . "Btn' value = '$btn1'/>
                <a href = '$btn2.php' class='button'>$btn2</a>
                </form>
            </div>";
        return $structureForPage;
    }

    public function createTable($tableHeader, $tableData)
    {
        $Contacts = new Table();
        $data = $Contacts -> tableData($tableData);
        $structureTable = "
            <div class = 'tableBlock' id = 'tableBlock'>
                <table cellpadding = '10' id = 'table'>
                    <tr>
                    $tableHeader
                    </tr>
                    $data
                </table>
            </div>
            <br/>";

        return $structureTable;
    }
    
    public function createBtn($typeBtn, $idLine)
    {
        return "<form method = \"post\" action = " . $typeBtn . ".php>
            <input type= \"hidden\" name = \"idLine\" value = " . $idLine . " />
            <input class = " . $typeBtn . " Btn type=\"submit\" name = " . $typeBtn . " Btn value = " . $typeBtn . " />
            </form>";
    }
}

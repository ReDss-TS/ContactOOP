<?php

abstract class Table
{
    protected $sortingTag = '&#8593;';

    abstract protected function renderData($data);

    public function tableHeaders()
    {   
        $tableHeader = '';
        $orderObj = new Order;
        $sortObj = new Sort;
        $order = $orderObj->getOrder();
        $sort = $sortObj->changeSortBy();

        foreach ($this->columnNames as $key => $value) {
            $this->sortingTag = ($key == $order && $sort == 'ASC') ? '&#8593;' : (($key == $order && $sort == 'DESC') ? '&#8595;' : '');
            $tableHeader .= "<th><a class=\"columnNames\" href=\"?order=$key&sort=$sort\">$value $this->sortingTag</a></th>";
        }
        if (isset($this->additionalСolumns)){
            foreach ($this->additionalСolumns as $key => $value) {
                $tableHeader .= "<th>$key</th>";
            }
        }

        return $tableHeader;
    }

    public function renderTable($data)
    {
        $headres = $this->tableHeaders();
        $tableData = $this->renderData($data);
        $table = "
            <div class = 'tableBlock' id = 'tableBlock'>
                <table cellpadding = '10' id = 'table'>
                    <tr>
                        $headres
                    </tr>
                    $tableData
                </table>
            </div>
            <br/>";

        return $table;
    }

    public function createBtn($typeBtn, $idLine)
    {
        $btn = "<form method = \"post\" action = " . $this->additionalСolumns[$typeBtn] . ".php>
            <input type= \"hidden\" name = \"idLine\" value = " . $idLine . " />
            <input class = " . $typeBtn . " Btn type=\"submit\" name = " . $typeBtn . " Btn value = " . $typeBtn . " />
            </form>";
        return $btn;
    }

}
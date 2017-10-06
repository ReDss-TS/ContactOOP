<?php

class Pagination
{   
    protected $targetpage = "index.php";
    //items to show per page
    protected $resultsPerPage = 3;
    //adjacent pages
    protected $adjacents = 2;
    //number Of Pages
    protected $numberOfPages;
    //first item to display on page
    protected $pageFirstResult;
    //active page
    protected $page;
    //previous page
    protected $prevPage;
    //next page
    protected $nextPage;
    //last page
    protected $lastPage;
    //last page minus 1
    protected $lpm1;
    //order by
    protected $order;
    //sort by
    protected $sort;


    //structure of paging
    protected $pagination;

    private function setnumberOfPages()
    {
        $contactObj = new Contacts;
        //number of records in ContactList table
        $numberOfRecords = $contactObj->selectCountFromContactList();
            //total pages
            $this->numberOfPages = ceil($numberOfRecords[0]['amt'] / $this->resultsPerPage);
        }
    }

    private function setActivePage()
    {
        if (!isset($_GET['page'])) {
            $this->page = 1;
        } else {
            $this->page = ceil($_GET['page']);
            //if the page is missing then move to 1 page
            if ($this->page > $this->numberOfPages || $this->page < 1) {
                header("Location: $targetpage?page=1");
            }
        }
    }

    private function setProperties()
    {
        $this->pageFirstResult = ($this->page - 1) * $this->resultsPerPage;
        $this->prevPage = $this->page - 1;
        $this->nextPage = $this->page + 1;
        $this->lastPage = $this->numberOfPages;
        $this->lpm1 = $this->lastPage - 1;
    }

    private function setOrderBy()
    {
        $orderObj = new Order;
        $this->order = $orderObj->getOrder();
    }

    private function setSortBy()
    {
        $sortObj = new Sort;
        $this->sort = $sortObj->getSortBy();
    }

    private function getLink($page, $name)
    {
        return "<a href=\"$this->targetpage?page=$page&order=$this->order&sort=$this->sort\">$name</a>";
    }

    private function getThreeDots()
    {
        return "<span class = \"threeDots\"> ... </span>";
    }

    private function getPages($i)
    {
        if ($i == $this->page) {
            return "<span class=\"current\">$i</span>";
        } else {
            return $this->getLink($i, $i);
        }
    }

    public function createPagination()
    {
        $this->setnumberOfPages();
        $this->setActivePage();
        $this->setProperties();
        $this->setOrderBy();
        $this->setSortBy();
        $this->setPagesProperties();

        $pagination = '';

        if ($this->lastPage > 1) {
            $pagination .= "<div class=\"pagination\">";

            //previous button
            $pagination .= $this->previousButton();

            //pages
            $pagination .= $this->pages();
            
            //next button
            $pagination .= $this->nextButton();

            $pagination.= "</div>\n";
        }
        $this->pagination = $pagination;
    }

    private function previousButton()
    {
        $pagination = '';
        if ($this->page > 1) {
            $pagination .= $this->getLink($this->prevPage, 'Previous');
        } else {
            $pagination .= "<span class=\"disabled\">Previous</span>";
        }
        return $pagination;
    }

    private function nextButton()
    {
        $pagination = '';
        if ($this->page < $this->numberOfPages) {
            $pagination.= $this->getLink($this->nextPage, 'Next');
        } else {
            $pagination.= "<span class=\"disabled\">Next</span>";
        }
        return $pagination;
    }

    private function pages()
    {
        $pagination = '';
        if ($this->lastPage < 7 + ($this->adjacents * 2)) {
            for ($i = 1; $i <= $this->lastPage; $i++) {
                $pagination .= $this->getPages($i);
            }
        } elseif ($this->lastPage > 5 + ($this->adjacents * 2)) {     
            if ($this->page < 1 + ($this->adjacents * 2)) {
                //near the beginning;only hide later pages
                $this->beginningPages();
            } elseif ($this->lastPage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)) {
                //in middle;hide some front and some back
                $this->middlePages();
            } else {
                //near the end;only hide early pages
                $this->endingPages();
            }
        }
        return $pagination;
    }


    private function beginningPages()
    {
        $pagination = '';
        for ($i = 1; $i < 4 + ($this->adjacents * 2); $i++) {
            $pagination .= $this->getPages($i);
        }

        $pagination .= $this->getThreeDots();
        $pagination .= $this->getLink($this->lpm1, $this->lpm1);
        $pagination .= $this->getLink($this->lastPage, $this->lastPage);
        return $pagination;
    }

    private function endingPages()
    {
        $pagination = '';
        $pagination .= $this->getLink('1', '1');
        $pagination .= $this->getLink('2', '2');
        $pagination .= $this->getThreeDots();

        for ($i = $this->lastPage - (2 + ($this->adjacents * 2)); $i <= $this->lastPage; $i++) {
            $pagination .= $this->getPages($i);
        }
        return $pagination;
    }

    private function middlePages()
    {
        $pagination = '';
        $pagination .= $this->getLink('1', '1');
        $pagination .= $this->getLink('2', '2');
        $pagination .= $this->getThreeDots();

        for ($i = $this->page - $this->adjacents; $i <= $this->page + $this->adjacents; $i++) {
            $pagination .= $this->getPages($i);
        }

        $pagination .= $this->getThreeDots();
        $pagination .= $this->getLink($this->lpm1, $this->lpm1);
        $pagination .= $this->getLink($this->lastPage, $this->lastPage);
        return $pagination;
    }

    public function getPagination()
    {
        return $this->pagination;
    }

    private function setPagesProperties()
    {
        Pages::getInstance()->setPagesProperties($this->pageFirstResult ,$this->resultsPerPage);
    }
}

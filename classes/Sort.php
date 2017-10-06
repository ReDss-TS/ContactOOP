<?php

class Sort
{
    public function getSortBy()
    {
        if (isset($_GET['sort'])) {
            if ($_GET['sort'] == 'ASC' || $_GET['sort'] == 'DESC') {
                $sort = $_GET['sort'];
            } else {
                $sort = 'ASC';
            }
        } else {
            $sort = 'ASC';
        }
        return $sort;
    }

    public function changeSortBy()
    {
        $sort = $this->getSortBy();
        if (isset($sort) && $sort == "ASC") {
            $sort = "DESC";
        } else {
            $sort = "ASC";
        }
        return $sort;
    }
}
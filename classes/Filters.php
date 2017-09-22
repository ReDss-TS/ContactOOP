<?php

class Filters
{   
    public function sanitizeSpecialChars($data)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                foreach ($value as $k => $val) {
                    $resultVal[$k] = filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);
                    $filteredResult[$key] = $resultVal;
                }
            }
        }
        return $filteredResult;
    }
}
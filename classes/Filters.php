<?php

class Filters
{   
    public function sanitizeSpecialCharsInMultiArrays($data)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                foreach ($value as $k => $val) {
                    $resultVal[$k] = filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);
                    $filteredResult[$key] = $resultVal;
                }
            }
        }
        if (!empty($filteredResult)) {
            return $filteredResult;
        }
    }

    public function sanitizeSpecialChars($data)
    {
        foreach ($data as $key => $value) {
            $filteredResult[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if (!empty($filteredResult)) {
            return $filteredResult;
        }
    }
}

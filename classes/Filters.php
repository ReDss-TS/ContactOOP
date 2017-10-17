<?php

class Filters
{   
    //input data: array
    //return: array 
    public function sanitizeSpecialChars($data)
    {
        $filteredResult = [];
        $keys = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $result = $this->sanitizeSpecialChars($value); 
                    $filteredResult[$key] = $result;
                } else {
                    $filteredResult[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            return $filteredResult;
        }
    }
}

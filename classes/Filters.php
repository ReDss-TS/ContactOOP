<?php

class Filters//TODO recursion!
{   
    // public function sanitizeSpecialCharsInMultiArrays($data)
    // {

    //     if (!empty($data)) {
    //         foreach ($data as $key => $value) {
    //             foreach ($value as $k => $val) {
    //                 $resultVal[$k] = filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);
    //                 $filteredResult[$key] = $resultVal;
    //             }
    //         }
    //     }
    //     if (!empty($filteredResult)) {
    //         return $filteredResult;
    //     }
    // }

    // public function sanitizeSpecialChars($data)
    // {
    //     foreach ($data as $key => $value) {
    //         $filteredResult[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    //     }
    //     if (!empty($filteredResult)) {
    //         return $filteredResult;
    //     }
    // }

    public function sanitizeSpecialChars($data)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {$this->sanitizeSpecialChars($value);}
                echo '<pre>';
                var_dump($value);
                echo '</pre>';
                $filteredResult[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            var_dump($filteredResult);
            return $filteredResult;
        }
    }
}

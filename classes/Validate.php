<?php

class Validate
{
    protected $validationRules = [
        'user_name' => [
            'notEmpty',
            'isValidText'
        ],
        'user_surname' => [
            'notEmpty',
            'isValidText'
        ],
        'user_mail' => [
            'notEmpty',
            'isValidEmail'
        ],
        'user_hPhone' => [
            'notEmpty',
            'isValidPhoneNumber'
        ],
        'user_wPhone' => [
            'notEmpty',
            'isValidPhoneNumber'
        ],
        'user_cPhone' => [
            'notEmpty',
            'isValidPhoneNumber'
        ],
        'user_address1' => [
            'notEmpty',
            'isValidAddress'
        ],
        'user_address2' => [
            'notEmpty',
            'isValidAddress'
        ],
        'user_city' => [
            'notEmpty',
            'isValidText'
        ],
        'user_state' => [
            'notEmpty',
            'isValidText'
        ],
        'user_zip' => [
            'notEmpty',
            'isValidZIP'
        ],
        'user_country' => [
            'notEmpty',
            'isValidText'
        ],
        'user_birthday' => [
            'notEmpty',
            'isValidBirthday'
        ],
        'user_login' => [
            'notEmpty',
            'isValidLogin',
            //'isUniqueLogin'
        ],
        'user_pass' => [
            'notEmpty',
            'isValidPass'
        ]
    ];

    public function validateData($data)
    {
        $errorList = [];
        foreach ($this->validationRules as $keyRules => $valueRules) {
            foreach ($valueRules as $k => $rule) {
                if (isset($data[$keyRules])) {
                    $response = $this->$rule($data[$keyRules]);
                    $errorList[$keyRules] = $response;
                    if ($response != '') {
                        break;
                    }
                }
            }
        }
        return $errorList;
    }


    private function isValidText($text)
    {
        if (empty($text)) {
            return '';
        }
        if (!preg_match("/[A-Za-z0-9\x20]+/", $text)) {
            return 'Invalid characters!';
        }
        return '';
    }

    private function isValidEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }
        return '';
    }


    private function isValidPhoneNumber($phone)
    {
        if (!preg_match("/[0-9]{3}-[0-9]{4}-[0-9]{4}/", $phone)) {
            return 'Invalid phone number!';
        }
        return '';
    }

    private function isValidBirthday($text)
    {
        if (!preg_match("/(0[1-9]|[12][0-9]|3[01])[\/.](0[1-9]|1[012])[\/.](19|20)\d\d/", $text)) {
            return 'Invalid birthday date!';
        }
        return '';
    }

    private function isValidAddress($text)
    {
        if (!preg_match("/[A-Za-z0-9\-\\/,.\ ]+/", $text)) {
            return 'Invalid characters!';
        }
        return '';
    }

    private function isValidZIP($text)
    {
        if (!preg_match("/[0-9]{5,5}([- ]?[0-9]{4,4})?/", $text)) {
            return 'Invalid characters!';
        }
        return '';
    }

    private function isValidLogin($text)
    {
        if (!preg_match("/[A-Za-z0-9-_.\'\"]+$/", $text)) {
            return 'Invalid characters!';
        }
        return '';
    }

    private function isValidPass($text)
    {
        if (strlen($text) > 3) {
            return '';
        }
        return 'Not enough characters! Password must be at least 4 characters!';
    }

    private function notEmpty($value)
    {
        if (!empty($value)) {
            return '';
        }
        return 'The field can not be empty';
    }
    }
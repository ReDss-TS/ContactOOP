<?php

class AddContactForm extends Forms
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Add Contact',
            'actionFile' => 'insert',
            'submitBtn'  => 'Add',
            'backBtn'    => 'Index'
    ];

    //structure of the input field
    protected $structure  = [
            [
                'name'  => 'user_name',
                'label' => 'First Name',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_surname',
                'label' => 'Last Name',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_mail',
                'label' => 'Email',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_hPhone',
                'label' => 'Home Phone',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_wPhone',
                'label' => 'Work Phone',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_cPhone',
                'label' => 'Cell Phone',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_address1',
                'label' => 'Address1',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_address2',
                'label' => 'Address2',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_city',
                'label' => 'City',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_state',
                'label' => 'State',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_zip',
                'label' => 'ZIP',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_country',
                'label' => 'Country',
                'type'  => 'text'
            ],
            [
                'name'  => 'user_birthday',
                'label' => 'Birthday',
                'type'  => 'text'
            ]
    ];

    protected $phones  = [
            '1' => 'user_hPhone',
            '2' => 'user_wPhone',
            '3' => 'user_cPhone'
    ];

    /**
      * render radioButton
      *
      * @param string $name With a name input field
      *        int $checkedPhone With number of checked radioButton
      *
      * @return string $formRadio With HTML input tags
      */
    protected function renderRadioBtn($name, $checkedPhone)
    {
        $formRadio = '';
        foreach ($this->phones as $key => $value) {
            if ($value == $name) {
                $isChecked = ($checkedPhone !== '' && $checkedPhone == $key) ? 'checked' : '';
                $formRadio = "<input id = \"idPhone$key\" type = \"radio\" name = \"bestPhone\" value = $key $isChecked>";
            }
        }
        return $formRadio;
    }

}

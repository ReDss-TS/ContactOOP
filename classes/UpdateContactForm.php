<?php

class UpdateContactForm extends AddContactForm
{
    //elements for html form
    protected $elements  = [
            'header'     => 'Edit',
            'actionFile' => 'update',
            'submitBtn'  => 'Done',
            'backBtn'    => 'Index'
    ];
}

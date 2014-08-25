<?php
class PageValidator extends Validator {
    protected  $rules = [
        'title' => 'required|alphanum|min:3',
        'body' => 'required',
        'template' => 'required|alphanum',
    ];

    public function __construct($input)
    {
        parent::__construct($this->rules, $input);
    }
} 
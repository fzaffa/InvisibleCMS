<?php

class Validator {

    public $errors = array();

    protected $input;

    protected $rules;

    public function __construct($rules, $input)
    {
        $this->input = $input;
        $this->rules = $this->explodeRules($rules);
    }

    private function explodeRules($rules)
    {
        foreach ($rules as $attribute => &$rule) {
             $rule = explode('|', $rule);
        }
        return $rules;
    }

    private function parseRule($rule)
    {
        $parameters = array();
        if(strpos($rule, ':')) {
            list($rule, $parameters) = explode(':', $rule);
            $parameters = $this->parseParameters($parameters);
        }
        return array($rule, $parameters);
    }

    private function parseParameters($parameters)
    {
        return str_getcsv($parameters);
    }
    public function passes()
    {
        foreach ($this->rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                $this->validate($attribute, $rule);
            }
        }
        if(empty($this->errors)) return true;

        return false;
    }
    /**
     * @param $attribute
     * @param $method
     */
    public function validate($attribute, $rule)
    {
        list($rule, $parameters) = $this->parseRule($rule);
        $method = 'validate' . ucwords($rule);
        $this->{$method}($this->getInput($attribute), $attribute, $parameters);
    }
    private function getInput($attribute)
    {
        $input = $this->input[$attribute];
        $input = trim($input);
        return $input;

    }

    public function validateRequired($validable, $attribute)
    {
        if(isset($validable) && $validable != '')
        {
            return true;
        }
        $this->errors[] = $attribute." è richiesto";
        return false;
    }
   public function validateAlphanum($validable, $attribute)
    {
        if(ctype_alnum($validable))
        {
            return true;
        }
        $this->errors[] = $attribute." deve essere alfanumerico";
        return false;
    }
    public function validateMin($validable, $attribute, $parameter)
    {
        if (strlen($validable) >= (int)$parameter[0])
        {
            return true;
        }
        $this->errors[] = $attribute. "deve essere minimo ".(int)$parameter[0]. " caratteri.";
        return false;
    }

    public function validateMax($validable, $attribute, $parameter)
    {
        if (strlen($validable) <= (int)$parameter[0])
        {
            return true;
        }
        $this->errors[] = $attribute. "deve essere massimo ".(int)$parameter[0]. " caratteri.";
        return false;
    }
    public function validateEmail($validable, $attribute)
    {
        if(preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/', $validable))
        {
            return true;
        }
        $this->errors[] = $attribute." non è un'email valida";
        return false;
    }
    public function validateNumeric($validable, $attribute)
    {
        if(is_numeric($validable))
        {
            return true;
        }
        $this->errors[] = $attribute." non è numerico";
        return false;
    }

} 
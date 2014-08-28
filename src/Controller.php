<?php

class Controller {
    use Filters;
    protected $view;

    public function construct($view)
    {
        $this->view = $view;
    }

    public function filter($filter)
    {
        try {
            $this->runFilter($filter);
        } catch (Exception $e){
            echo $e->getMessage();
            exit(1);
        }
    }
    public function runFilter($filter)
    {
        $method = 'filter'.$filter;
        if(method_exists($this, $method))
        {
            $this->{$method}();
        } else {
            throw new Exception('Filter '.$filter.' does not exist.');
        }
    }
} 
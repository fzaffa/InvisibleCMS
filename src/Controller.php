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
        $method = 'filter'.$filter;
        $this->{$method}();

    }
} 
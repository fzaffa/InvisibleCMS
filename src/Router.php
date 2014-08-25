<?php

class Router {
    private $routes = array();

    public function route($route, $callback)
    {
        $this->routes[$route] = $callback;
    }

    public function execute()
    {
        foreach($this->routes as $key => $value)
        {
            if(preg_match('~'.$key.'~', $_SERVER['REQUEST_URI'], $arr))
            {

                if(count($arr)>1) $param = $arr[1];
                $activeAction = $value;
            }
        }
        list($controller, $action) = explode(':', $activeAction);
        $controller = new $controller;
        (isset($param)) ? $controller->{$action}($param) : $controller->{$action}();
    }
}
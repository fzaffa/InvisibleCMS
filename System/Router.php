<?php namespace Fzaffa\System;

class Router {

    private $routes = [];
    private $resolver;

    private $controllersNamespace;

    public function __construct($controllersNamespace, Resolver $resolver)
    {

        $this->controllersNamespace = $controllersNamespace;
        $this->resolver = $resolver;
    }

    public function route($route, $callback)
    {
        $this->routes[$route] = $callback;
    }

    public function execute() : Response
    {
        list($param, $controller, $action) = $this->matches();

        $controller = $this->controllersNamespace . $controller;

        $controller = $this->resolver->resolve($controller);

        $response = ($param) ? $controller->{$action}($param) : $controller->{$action}();

        if(is_string($response))
        {
            return (new Response())->append($response);
        }
        if(is_null($response))
        {
            return (new Response())->setCode(200);
        }
        return $response;
    }

    /**
     * @return array
     */
    private function matches()
    {
        foreach ($this->routes as $key => $value)
        {
            if (preg_match('~' . $key . '~', $_SERVER['REQUEST_URI'], $arr))
            {
                $param = null;
                if (count($arr) > 1) $param = $arr[1];
                $activeAction = $value;
            }
        }
        list($controller, $action) = explode(':', $activeAction);

        return [$param, $controller, $action];
    }
}
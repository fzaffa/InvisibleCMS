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

        $controllerReflection  = new ReflectionClass($controller);
        $controllerConstructor = $controllerReflection->getConstructor();
        $dependencies = [];

        foreach ($controllerConstructor->getParameters() as $controllerConstructorParam) {
            $className = $controllerConstructorParam->getClass()->name;
            $dependencies[] = new $className;
        }


        $controller = $controllerReflection->newInstanceArgs($dependencies);
        (isset($param)) ? $controller->{$action}($param) : $controller->{$action}();
    }
}
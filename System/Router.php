<?php namespace Fzaffa\System;

class Router {

    private $routes = [];

    private $controllersNamespace;

    public function __construct()
    {

        $this->controllersNamespace = Config::getInstance()->get('app.controllernamespace');
    }

    public function route($route, $callback)
    {
        $this->routes[$route] = $callback;
    }

    public function execute() : Response
    {
        list($param, $controller, $action) = $this->matches();

        $controller = $this->controllersNamespace . $controller;
        $controllerReflection = new \ReflectionClass($controller);
        $controllerConstructor = $controllerReflection->getConstructor();
        $dependencies = [];

        $dependencies = $this->instantiateDependencies($controllerConstructor, $dependencies);


        $controller = $controllerReflection->newInstanceArgs($dependencies);


        return (new Response())->append(
            ($param) ? $controller->{$action}($param) : $controller->{$action}()
        );
    }

    /**
     * @param $controllerConstructor
     * @param $dependencies
     * @return array
     */
    private function instantiateDependencies($controllerConstructor, $dependencies)
    {
        foreach ($controllerConstructor->getParameters() as $controllerConstructorParam)
        {
            $className = $controllerConstructorParam->getClass()->name;
            $dependencies[] = new $className;
        }

        return $dependencies;
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
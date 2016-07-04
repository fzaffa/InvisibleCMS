<?php

namespace Fzaffa\System;


class Resolver
{
    private $binded = [];
    private $resolved = [];

    public function resolve($class)
    {
        if (array_key_exists($class, $this->binded))
        {
            return $this->binded[$class];
        }
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();
        $dependencies = [];
        if(!is_null($reflection->getConstructor())) {
            foreach ($constructor->getParameters() as $dependency) {
                try {
                    $dependencies[] = $this->resolve($dependency->getClass()->name);
                } catch (\Exception $e) {
                    throw new \Exception("Non posso istanziare " . $constructor->getParameters()[0]." Per: ".$class);
                }
            }
        }
        if(array_key_exists($class, $this->resolved))
        {
            return $this->resolved[$class];
        }

        $resolved = $reflection->newInstanceArgs($dependencies);
        $this->resolved[$class] = $resolved;
        return $resolved;
    }

    public function bind(string $className, $instance) {
        if($instance instanceof $className )
        {
            $this->binded[$className] = $instance;
        }
    }
}
<?php

namespace Fzaffa\System;


class Resolver
{
    private $resolved = [];

    public function resolve($class)
    {
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();
        $dependencies = [];
        if(!is_null($reflection->getConstructor())) {
            foreach ($constructor->getParameters() as $dependency) {
                $dependencies[] = $this->resolve($dependency->getClass()->name);
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
}
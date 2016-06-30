<?php

namespace Fzaffa\System;

class Appplication {

    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run(){
    }
}
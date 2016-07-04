<?php
/**
 * Created by PhpStorm.
 * User: francesco
 * Date: 04/07/16
 * Time: 22:10
 */

namespace Fzaffa\System;


class AssemblerRunner
{
    private $assemblersToRun;
    private $resolver;

    public function __construct(array $assemblersToRun, Resolver &$resolver)
    {
        $this->assemblersToRun = $assemblersToRun;
        $this->resolver = $resolver;
    }

    public function runAssemblers()
    {
        foreach($this->assemblersToRun as $assembler)
        {
            //var_dump('ciao da ' .$assembler);
            (new $assembler($this->resolver))->run();
        }
    }
}
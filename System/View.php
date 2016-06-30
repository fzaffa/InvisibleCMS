<?php namespace Fzaffa\System;

class View {
    public function render($file, $data = null) : string
    {
        if($data) extract($data);
        ob_start();
        include 'App/Views/'.$file.'.php';
        $cont = ob_get_contents();
        ob_clean();
        //var_dump($cont);
        return $cont;
    }
}
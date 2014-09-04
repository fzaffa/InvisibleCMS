<?php namespace Fzaffa\System;

class View {
    public function render($file, $data = null)
    {
        if($data) extract($data);
        include 'App/Views/'.$file.'.php';
    }
}
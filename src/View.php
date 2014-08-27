<?php

class View {
    public function render($file, $data = null)
    {
        if($data) extract($data);
        include 'views/'.$file.'.php';
    }
} 
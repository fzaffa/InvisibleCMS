<?php
function __autoload($className)
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$className.'.php';
}
if(Auth::check())
{
    $pages = Page::all();
    include "templates/home.php";
} else {
    include 'admina/templates/login.php';
}
?>
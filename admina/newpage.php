<?php
require_once "../Database.php";
require_once '../Page.php';
require_once "../Auth.php";
if(Auth::check())
{
    if(!isset($_POST['submit'])){
        include "templates/editpage.php";
    }
    else
    {
        $page = new Page;

        $page->fill($_POST)->save();
        header('Location: index.php');
    }
} else {
    include 'templates/login.php';
}

?>
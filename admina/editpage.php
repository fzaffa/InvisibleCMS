<?php
require_once "../Page.php";
require_once "../Database.php";
require_once "../Auth.php";
if(Auth::check())
{
    if(!isset($_POST['submit'])){

        if(!isset($_REQUEST['page'])){
            header("location: index.php");
        }
        $page = new Page;
        $page->getPageBySlug($_REQUEST['page']);
        $page->getSections();
        include "templates/editpage.php";
    }
    else
    {
        $page = new Page;
        $page->fill($_POST);
        $page->fillSections($_POST['sections']);
        $page->save();
        include "templates/editpage.php";
    }
} else {
    include 'templates/login.php';
}

?>

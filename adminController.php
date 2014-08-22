<?php
switch($action)
{
    case 'index':
        if(Auth::check())
        {
            $pages = Page::all();
            include "admina/templates/home.php";
        } else {
            include 'admina/templates/login.php';
        }
        break;
    case 'login':
        var_dump($_POST);
        var_dump(Auth::login($_POST['username'], $_POST['password']));
        if(Auth::login($_POST['username'], $_POST['password']))
        {
            header('Location: /admin/');
        }
        include 'admina/templates/login.php';
        break;
    case 'logout':
    {
        Auth::logout();
        header('Location: /');
    }
}
<?php
switch($action)
{
    case 'index':
        if(Auth::check())
        {
            $pages = Page::all();
            include "views/admin/home.php";
        } else {
            include 'views/admin/login.php';
        }
        break;
    case 'login':
        if(Auth::login($_POST['username'], $_POST['password']))
        {
            header('Location: /admin/');
        }
        include 'views/admin/login.php';
        break;
    case 'logout':
        Auth::logout();
        header('Location: /');
        break;

    case 'new':
        if(Auth::check())
        {
            include "views/admin/editpage.php";
        } else {
            include 'views/admin/login.php';
        }
        break;

    case 'edit':
        if(Auth::check())
        {
            if(!isset($arr['page'])){
                echo "nessun a pagina";
                return;
            }
            $page = new Page;
            $page->getPageBySlug($arr['page']);
            $page->getSections();
            include "views/admin/editpage.php";
        }
        else
        {
            include 'views/admin/login.php';
        }
        break;
    case 'store':
        $page = new Page;
        $validator = new PageValidator($_POST);
        if($validator->passes())
        {
            $page->fill($_POST);
            $page->fillSections($_POST['sections']);
            $page->save();
            header('Location: /admin/');
        } else {
            Message::send('errors', $validator->errors);
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        break;

}
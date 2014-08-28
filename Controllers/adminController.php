<?php
class AdminController extends Controller{
    public function __construct($view)
    {
        parent::construct($view);
    }
    public function index()
    {
        $this->filter('Auth');

        $pages = Page::all();
        include "views/admin/home.php";
    }

    public function login()
    {
        if(Auth::login($_POST['username'], $_POST['password']))
        {
            header('Location: /admin/');
        }
        include 'views/admin/login.php';
    }

    public function logout()
    {
        Auth::logout();
        header('Location: /');
    }

    public function create()
    {
        $this->filter('Auth');
        $this->view->render('admin/editpage');

    }

    public function edit($slug)
    {
        $this->filter('Auth');

        $page = new Page;
        $page->getPageBySlug($slug);
        $page->getSections();

        include "views/admin/editpage.php";

    }

    public function store()
    {
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
    }
}
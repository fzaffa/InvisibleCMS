<?php namespace Invisible\Controllers;

use Fzaffa\System\Auth;
use Fzaffa\System\View;
use Invisible\Page\Page;
use Fzaffa\System\Controller;

class AdminController extends Controller {

    /**
     * @var \View
     */
    private $view;
    /**
     * @var \Page
     */
    private $page;

    public function __construct(View $view, Page $page)
    {

        $this->view = $view;
        $this->page = $page;
    }

    public function index()
    {
        $this->filter('Auth');

        $pages = $this->page->all();

        $this->view->render('admin/home', ['pages' => $pages]);
    }

    public function login()
    {
        if (Auth::login($_POST['username'], $_POST['password']))
        {
            header('Location: /admin/');
        }

        $this->view->render('admin/login');
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

        $this->page->getPageBySlug($slug);
        $this->page->getSections();

        $this->view->render('admin/editpage', ['page' => $this->page]);

    }

    public function store()
    {
        $validator = new PageValidator($_POST);
        if ($validator->passes())
        {
            $this->page->fill($_POST);
            $this->page->fillSections($_POST['sections']);
            $this->page->save();
            header('Location: /admin/');
        } else
        {
            Message::send('errors', $validator->errors);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
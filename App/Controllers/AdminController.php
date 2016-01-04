<?php namespace Invisible\Controllers;

use Fzaffa\System\Auth;
use Fzaffa\System\View;
use Fzaffa\System\Controller;

use Invisible\Page\Page;
use Invisible\Filters;
use Invisible\Page\PageRepository;

class AdminController extends Controller {

    use Filters;
    /**
     * @var \View
     */
    private $view;
    /**
     * @var \Page
     */
    private $page;

    public function __construct(View $view, PageRepository $pageRepo)
    {

        $this->view = $view;
        $this->pageRepo = $pageRepo;
    }

    public function index()
    {
        $this->filter('Auth');

        $pages = $this->pageRepo->all();

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

        $page = $this->pageRepo->getPageBySlugWithSections($slug);

        $this->view->render('admin/editpage', ['page' => $page]);

    }

    public function store()
    {
        $validator = new PageValidator($_POST);
        if ($validator->passes())
        {
            $this->pageRepo->create($_POST);
            header('Location: /admin/');
        }
        else
        {
            Message::send('errors', $validator->errors);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }


    }
}
<?php namespace Invisible\Controllers;

use Fzaffa\System\Controller;
use Fzaffa\System\View;
use Invisible\Menu\Menu;
use Invisible\Page\PageRepository;

class pageController extends Controller {

    private $view;
    private $menu;
    private $pageRepo;

    public function __construct(View $view, Menu $menu, PageRepository $pageRepo)
    {
        $this->view = $view;
        $this->menu = $menu;
        $this->pageRepo = $pageRepo;
    }

    public function show($slug)
    {

        if ($this->pageRepo->hasPage($slug))
        {
            $page = $this->pageRepo->getPageBySlug($slug);

            $this->view->render('pages/' . $page->template, ['page' => $page, 'menu' => $this->menu]);

            return;
        }

        $this->view->render('errors/404');

    }

    public function home()
    {
        $this->show('home');
    }
}
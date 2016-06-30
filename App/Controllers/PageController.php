<?php namespace Invisible\Controllers;

use Fzaffa\System\Controller;
use Fzaffa\System\Response;
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

    public function show($slug) : string
    {

        if ($this->pageRepo->hasPage($slug))
        {
            $page = $this->pageRepo->getPageBySlugWithSections($slug);


            $return = $this->view->render('pages/' . $page->template, ['page' => $page, 'menu' => $this->menu]);
            return $return;

        }

        return (new Response)
            ->append($this->view->render('errors/404'))
            ->setCode(404);

    }

    public function home()
    {
        return $this->show('home');
    }
}
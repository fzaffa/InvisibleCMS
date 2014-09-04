<?php

class pageController extends Controller {

    private $view;
    private $menu;
    private $page;

    public function __construct(View $view, Menu $menu, Page $page)
    {
        $this->view = $view;
        $this->menu = $menu;
        $this->page = $page;
    }

    public function show($slug)
    {

        if ($this->page->hasPage($slug))
        {
            $this->page->getPageBySlug($slug);
            $this->page->getSections();

            $this->view->render('pages/' . $this->page->template, ['page' => $this->page, 'menu' => $this->menu]);

            return;
        }

        $this->view->render('errors/404');

    }

    public function home()
    {
        $this->show('home');
    }
}
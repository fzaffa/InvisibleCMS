<?php
class pageController extends Controller{

    private $view;
    public function __construct(View $view)
    {
        $this->view = $view;
    }
    public function show($slug)
    {
        $menu = new Menu;
        $page = new Page;
        if ($page->hasPage($slug)) {
            $page->getPageBySlug($slug);
            $page->getSections();
            $this->view->render('pages/'.$page->template, array('page'=>$page, 'menu'=>$menu));
            return;
        }
        include "views/errors/404.php";


    }
    public function home()
    {
        $this->show('home');
    }
}
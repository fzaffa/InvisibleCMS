<?php
class pageController{
    public function show($slug)
    {
        $menu = new Menu;
        $page = new Page;
        if ($page->hasPage($slug)) {
            $page->getPageBySlug($slug);
            $page->getSections();
            include "views/pages/" . $page->template . ".php";
            return;
        }
        include "views/errors/404.php";
    }
    public function home()
    {
        $this->show('home');
    }
}
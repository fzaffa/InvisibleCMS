<?php
$menu = new Menu;
$page = new Page;
if ($page->hasPage($slug)) {
    $page->getPageBySlug($slug);
    $page->getSections();
    include "views/pages/" . $page->template . ".php";
    return;
}
include "views/errors/404.php";
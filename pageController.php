<?php
$title = str_replace('+', ' ', $title);
$menu = new Menu;
$page = new Page;
if ($page->hasPage($title)) {
    $page->getPageBySlug($title);
    $page->getSections();
    include "templates/" . $page->template . ".php";
    return;
}
include "templates/errors/404.php";
<?php
session_start();
function __autoload($className)
{
    $folders = [
        'src',
        'Section',
        'Page'
    ];
    foreach ($folders as $folder) {
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$className.'.php')){
            require_once $_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$className.'.php';
        }
    }
}

$requestURL = $_SERVER['REQUEST_URI'];
if ($requestURL == '/') {
    $slug = 'home';
    include "pageController.php";
}
//Admin routes
elseif ($requestURL == '/admin/' or $requestURL == '/admin') {
    $action = 'index';
    include "adminController.php";
}
elseif ($requestURL == '/admin/new/' or $requestURL == '/admin/new') {
    $action = 'new';
    include "adminController.php";
}
elseif ($requestURL == '/admin/store/' or $requestURL == '/admin/store') {
    $action = 'store';
    include "adminController.php";
}
elseif ($requestURL == '/admin/login/' or $requestURL == '/admin/login') {
    $action = 'login';
    include "adminController.php";
}
elseif ($requestURL == '/admin/logout/' or $requestURL == '/admin/logout') {
    $action = 'logout';
    include "adminController.php";
}
elseif (preg_match('~/admin/edit/(?<page>[A-z0-9\-\+]+)~', $requestURL, $arr)) {
    $action = 'edit';
    $arr['page'];
    include "adminController.php";
}
//Admin routes
elseif (preg_match("~\/(?<page>[A-Za-z0-9\-\+]+)~",$requestURL, $arr)) {
    $slug = $arr['page'];
    include 'pageController.php';
}

// should match "/some-unique-url/and-another-unique-url"
//elseif (preg_match("(^\/[A-Za-z0-9\-]+\/[A-Za-z0-9\-]+)",$requestURL)) {
// echo "ciao";
//}

else {
    include 'views/errors/404.php';
}
?>

<?php
function __autoload($className)
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$className.'.php';
}

$requestURL = $_SERVER['REQUEST_URI'];
if ($requestURL == '/') {
    $title = 'home';
    include "pageController.php";
}
//Admin routes
elseif ($requestURL == '/admin/' or $requestURL == '/admin') {
    $action = 'index';
    include "adminController.php";
}
elseif ($requestURL == '/admin/new/' or $requestURL == '/admin/new') {
    echo "admina page";
}
elseif ($requestURL == '/admin/login/' or $requestURL == '/admin/login') {
    $action = 'login';
    include "adminController.php";
}
elseif (preg_match('~/admin/edit/(?<page>[A-z0-9\-\+]+)~', $requestURL, $arr)) {
    echo "Editing ".$arr['page'];
    var_dump($arr);
}
//Admin routes
elseif (preg_match("~\/(?<page>[A-Za-z0-9\-\+]+)~",$requestURL, $arr)) {
    $title = $arr['page'];
    include 'pageController.php';
}

// should match "/some-unique-url/and-another-unique-url"
/*elseif (preg_match("(^\/[A-Za-z0-9\-]+\/[A-Za-z0-9\-]+)",$requestURL)) {
 echo "ciao";
}*/

else {
    include 'templates/errors/404.php';
}
?>

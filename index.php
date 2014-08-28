<?php
session_start();
function __autoload($className)
{
    $folders = [
        'src',
        'Section',
        'Page',
        'Controllers',
        ''
    ];
    foreach ($folders as $folder) {
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$className.'.php')){
            require_once $_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$className.'.php';
        }
    }
}
$router = new Router;
$router->route('/', 'pageController:home');
$router->route('/([\w\-]+)', 'pageController:show');
$router->route('/admin', 'adminController:index');
$router->route('/login', 'adminController:login');
$router->route('/logout', 'adminController:logout');
$router->route('/create', 'adminController:create');
$router->route('/store', 'adminController:store');
$router->route('/edit/([\w\-]+)', 'adminController:edit');
$router->execute();
?>
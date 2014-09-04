<?php
session_start();
require_once __DIR__.'/System/Autoload.php';

$controllersNamespace = "Invisible\\Controllers\\";

$loader = new \Fzaffa\System\Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('Invisible', 'App');
$loader->addNamespace('Fzaffa\System', 'System');
$router = new \Fzaffa\System\Router($controllersNamespace);

$router->route('/', 'pageController:home');
$router->route('/([\w\-]+)', 'pageController:show');
$router->route('/admin', 'adminController:index');
$router->route('/login', 'adminController:login');
$router->route('/logout', 'adminController:logout');
$router->route('/create', 'adminController:create');
$router->route('/store', 'adminController:store');
$router->route('/edit/([\w\-]+)', 'adminController:edit');

$router->execute();
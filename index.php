<?php

use Fzaffa\System\Config;
use Fzaffa\System\Psr4AutoloaderClass;
use Fzaffa\System\Router;
use Fzaffa\System\Resolver;
use Fzaffa\System\AssemblerRunner;

session_start();
require_once __DIR__.'/System/Autoload.php';
$loader = new Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('Invisible', 'App');
$loader->addNamespace('Fzaffa\System', 'System');

$conf = Config::getInstance(__DIR__.'/App/Config');
$resolver = new Resolver();
$runner  = new AssemblerRunner($conf->get('assemblers'), $resolver);
$runner->runAssemblers();
$router = new Router(
    $conf->get('app.controllernamespace'),
    $resolver);

$router->route('/', 'PageController:home');
$router->route('/([\w\-]+)', 'PageController:show');
$router->route('/admin', 'adminController:index');
$router->route('/login', 'adminController:login');
$router->route('/logout', 'adminController:logout');
$router->route('/create', 'adminController:create');
$router->route('/store', 'adminController:store');
$router->route('/edit/([\w\-]+)', 'adminController:edit');

$router->execute()->send();

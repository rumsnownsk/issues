<?php

// Настройки DI
use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use League\Plates\Engine;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function () {
        return new Engine(VIEWS);
    },

]);
try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
    echo 'ContainerBuilder error: ' . $e->getMessage();
}


// Настройки Роутера
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {

    $r->addRoute('GET', '/[tasks]', ['app\controllers\MainController', 'indexAction']);

    $r->addRoute('GET', '/login', ['app\controllers\AuthController', 'loginAction']);
    $r->addRoute('POST', '/auth', ['app\controllers\AuthController', 'authAjaxAction']);
    $r->addRoute('GET', '/logout', ['app\controllers\AuthController', 'logoutAction']);

    $r->addRoute('GET', '/onetask', ['app\controllers\AjaxController', 'oneTaskAction']);
    $r->addRoute('POST', '/formIssue', ['app\controllers\AjaxController', 'formIssueAction']);
    $r->addRoute('POST', '/deleteIssue', ['app\controllers\AjaxController', 'deleteIssueAction']);

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
//dump(FastRoute\Dispatcher::NOT_FOUND);
//dump(FastRoute\Dispatcher::METHOD_NOT_ALLOWED);
//dd($routeInfo);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        require APP.'/views/errors/404.php';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
//        echo "METHOD_NOT_ALLOWED - странно, вы не должны были сюда попасть";
        require APP.'/views/errors/404.php';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // ... call $handler with $vars
        //dd($handler, $vars);

//        $container = new Container();

        $container->call($handler, $vars);

        break;
}
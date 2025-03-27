<?php 
require '../vendor/autoload.php';
use FastRoute\RouteCollector;
$dispatcher = FastRoute\simpleDispatcher(routeDefinitionCallback: function(RouteCollector $r) {
    $r->addRoute(httpMethod: 'GET', route: '/test', handler: 'handler');
    $r->addRoute(httpMethod: 'POST', route: '/test', handler: 'handler');
    $r->addRoute(httpMethod: ['GET', 'POST'], route: '/test', handler: 'handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        break;
}

<?php

require_once __DIR__.'/../vendor/autoload.php';

use Simplex\Framework;
use Simplex\StringResponseListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\ErrorListener;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\StreamedResponseListener;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__.'/../src/app.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher, $requestStack));
$dispatcher->addSubscriber(new ResponseListener('UTF-8'));
$dispatcher->addSubscriber(new StreamedResponseListener());
$dispatcher->addSubscriber(new StringResponseListener());
$listener = new ErrorListener(
    'Calendar\Controller\ErrorController::exception'
);
$dispatcher->addSubscriber($listener);

$framework = new Framework($dispatcher, $controllerResolver, $requestStack, $argumentResolver);

$framework = new HttpCache(
    $framework,
    new Store(__DIR__.'/../cache'),
    new Esi(),
    ['debug' => true]
);
$response = $framework->handle($request);

$response->send();


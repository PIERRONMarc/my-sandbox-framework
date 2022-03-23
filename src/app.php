<?php

use App\Controller\GreetingsController;
use App\Controller\LeapYearController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('leap_year', new Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => [new LeapYearController(), 'index'],

]));

$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => [new GreetingsController(), 'hello']
]));

$routes->add('bye', new Route('/bye', [
    '_controller' => [new GreetingsController(), 'bye']
]));

return $routes;

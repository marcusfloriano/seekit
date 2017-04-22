<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'SeekIt',
    ['path' => '/seek-it'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);

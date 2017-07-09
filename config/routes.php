<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Tags',
    ['path' => '/tags'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);


Router::prefix("admin",['path'=>'/admin'],function($routes) {

	$routes->plugin("Tags",['path'=>'/tags'],function($routes) {

		$routes->connect("/",[
			'controller'=>'Tags',
			'action'=>'index'
		]);

		$routes->fallbacks(DashedRoute::class);


	});
});

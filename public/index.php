<?php

/**
 * Front controller

 */

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

/**
 * Routing
 */
require '../Core/Router.php';

$router = new Router();

//echo get_class($router);  
/* The get_class() function gets the name of the class of an object. It returns FALSE if object is not an object. If object is excluded when inside a class,
 the name of that class is returned */

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);  //home page
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
/* $router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']); */
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
    
/* // Display the routing table */
/* echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>'; */


// Match the requested route
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}



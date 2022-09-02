<?php



/**
 * Front controller
 */

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

// Require the controller class
/* require '../App/Controllers/Posts.php'; */

require_once dirname(__DIR__) . '/vendor/Autoload.php'; //this load all third party packages 


/* Composer  */

/* require '../vendor/autoload.php'; */

/**
 * Autoloader
 */
/* spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});   remove spl_autoload_register after autoloader via composer*/


/**
 * Routing
 */
/* require '../Core/Router.php'; */

$router = new Core\Router();

//echo get_class($router);  
/* The get_class() function gets the name of the class of an object. It returns FALSE if object is not an object. If object is excluded when inside a class,
 the name of that class is returned */

 
/* $router->add('', ['controller' => 'Home', 'action' => 'index']);  
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']); */ 


// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}'); //this route here for Signup Controller and method(action) Signup controller
/* $router->add('admin/{action}/{controller}');  */
$router->add('login', ['controller'=>'Login', 'action'=>'new']);  //add route for login, it will be like public/index.php?login
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);//namespace like option  
    
/* // Display the routing table */
/* echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>'; */


// Match the requested route
/* $url = $_SERVER['QUERY_STRING'];
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
} */

$router->dispatch($_SERVER['QUERY_STRING']);



/* echo password_hash("ron",PASSWORD_DEFAULT); */
?>
<!-- <a href="/admin/index.php">Admin</a> -->
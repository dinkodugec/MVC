<?php

/**
 * Router
 * 
 * router is component which takes request url and decide what to do
 * 
 * central part of framework
 */
class Router
{

    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];  //routing table, which is ass array

    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params = [])  //  $route - name of route, $params - list of parametars;controllers, action etc
    {
       // Convert the route to a regular expression: escape forward slashes
       $route = preg_replace('/\//', '\\/', $route);

       // Convert variables e.g. {controller}
       $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

       // Add start and end delimiters, and case insensitive flag
       $route = '/^' . $route . '$/i';

       $this->routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutes() //geting routing table
    {
        return $this->routes;
    }

     /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The route URL
     *
     * @return boolean  true if a match found, false otherwise
     */
    public function match($url)
    {
         /*    foreach ($this->routes as $route => $params) {
            if ($url == $route) {    //very simple string comparision, if the route matching route in routing table
                $this->params = $params;
                return true;
            }
        }  */

      // Match to the fixed URL format /controller/action
    /*    $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/"; */

    foreach ($this->routes as $route => $params) {
        if (preg_match($route, $url, $matches)) {
            // Get named capture group values
            //$params = [];

            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }

            $this->params = $params;
            return true;
        }
    }

       return false;
    }

    /**
     * Get the currently matched parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}


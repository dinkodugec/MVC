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
    protected $routes = [];  //routing table, whic is ass array

    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params)  //$params - list of parametars;controllers, action etc
    {
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
}


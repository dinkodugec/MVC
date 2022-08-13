<?php


namespace Core;

/**
 * Base controller

 */
abstract class Controller         //abstarct means that we do not want to create a object of a class
{

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = []; // property to store route parameters

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params) //pass route parameters when create object
    {
        $this->route_params = $route_params;
    }
}

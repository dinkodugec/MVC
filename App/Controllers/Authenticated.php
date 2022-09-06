<?php

namespace App\Controllers;

/**
 * Authenticated base controller

 */
abstract class Authenticated extends \Core\Controller
{
       /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */

     // before action filter, we require login before access to all method in controller
     protected function before()  //this method will be run before every action method
     {
         $this->requireLogin();
     }
}
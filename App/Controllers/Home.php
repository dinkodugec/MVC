<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 */
class Home extends \Core\Controller
{

     /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        echo "(before) ";
        //return false; it will not be executed if it will be false, it be usufull if user is logged in or similiar
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
          //echo 'Hello from the index action in the Home controller!';
          View::render('Home/index.php', [
            'name'    => 'Dave',
            'colours' => ['red', 'green', 'blue']
        ]);
    }
}

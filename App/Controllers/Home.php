<?php

namespace App\Controllers;

use App\Auth;
use \Core\View;
use \Core\DB;
use \Model\Post;

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
        /* echo "(before) "; */
        //return false; it will not be executed if it will be false, it be usufull if user is logged in or similiar
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
       /*  echo " (after)"; */
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {

        View::renderTemplate('Home/index.html', [
           'user' => Auth::getUser(),  /* now rendering twig global variable */
           'posts'=> \App\Models\Post::getAll()
       

        ]); 
    }
    
}
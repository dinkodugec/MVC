<?php

namespace App\Controllers;

use App\Auth;
use App\Models\Paginates;
use \Core\View;
use \Core\DB;
use \Model\Post;
use \Model\User;
use \Model\Paginate;

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
     

       $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
       $perPage = 3;

        
       $paginate = Paginates::getPaginatedData($page, $perPage);

      /*   var_dump($paginate);
        die(); */
 
/*         echo "<pre>";
       var_dump($paginate);
       echo "</pre>";
       die();   */

     /*    \App\Mail::send('dinko.dugec@gmail.com', 'Test', 'This is a test', '<h1>This is a test</h1>');  */
       


        View::renderTemplate('Home/index.html', [
           'user' => Auth::getUser(),  /* now rendering twig global variable */
           'posts'=> \App\Models\Post::getAll(),
         /*   'users' => \App\Models\User::getAll(), */
           'postsCount' => count(\App\Models\Post::getAll()),
           /* 'totalUsers' => count(\App\Models\User::getAll()) */
           'paginate' => $paginate


        ]); 
    }
    
}
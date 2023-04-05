<?php

namespace App\Controllers;

use App\Auth;
use \Core\View;
use App\Models\User;
use Core\DB;
use PDO;

/**
 * Posts controller
 */
class Users extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $users = User::getAll();

       

        if($users){

          View::renderTemplate('User/index.html',[
            'users' => $users
           ]);  
          }
    }



  

  }
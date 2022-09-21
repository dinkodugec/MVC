<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;

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

           View::renderTemplate('User/index.html',[
            'users' => $users
           ]); 
    }

  }
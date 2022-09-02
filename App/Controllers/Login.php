<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Login controller

 */
class Login extends \Core\Controller
{
    /**
     * Show the login page
     *
     * @return void
     */
    public function newAction()
    {
        View::renderTemplate('Login/new.html');
    }

    
    /**
     * Log in a user
     *
     * @return void
     */
    public function createAction()
    {
        // when added use ...use \App\Models\User; you do not have prefix full namespace
        $user = User::findByEmail($_POST['email']);

        var_dump($user);
    }
}
<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;


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
        $user = User::authenticate($_POST['email'], $_POST['password']);

        if ($user) {

          Auth::login($user);

           /*  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/public/index.php', true, 303);
            exit; */
            $this->redirect(Auth::getReturnToPage());

        } else {

            View::renderTemplate('Login/new.html', [
                'email' => $_POST['email'], // when form is redisplayed when authenticate is failed, we can pass email address when render template
            ]);
        }
    }

     /**
     * Log out a user
     *
     * @return void
     */
    public function destroyAction()
    {
        
        Auth::logout();

        $this->redirect('/public/index.php');      
    }
}
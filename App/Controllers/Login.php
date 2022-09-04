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
        $user = User::authenticate($_POST['email'], $_POST['password']);

        if ($user) {

            $_SESSION['user_id'] = $user->id;

           /*  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/public/index.php', true, 303);
            exit; */
            $this->redirect('/public/index.php');

        } else {

            View::renderTemplate('Login/new.html', [
                'email' => $_POST['email'], // when form is redisplayed when authenticate is failed, we can pass email address when render template
            ]);
        }
    }
}
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

     /**
     * Log out a user
     *
     * @return void
     */
    public function destroyAction()
    {
        // Unset all of the session variables
        $_SESSION = [];

        // Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Finally destroy the session
        session_destroy();

        $this->redirect('/public/index.php');      
    }
}
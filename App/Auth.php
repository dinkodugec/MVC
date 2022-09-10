<?php

namespace App;

use \App\Models\User;

/**
 * Authentication
 */
class Auth
{
    /**
     * Login the user
     *
     * @param User $user The user model
     *
     * @return void
     */
    public static function login($user, $remember_me)
    {
        session_regenerate_id(true); //Update the current session id with a newly generated one

        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;

        if($remember_me){
            $user->rememberLogin();
        }
    }

    /**
     * Logout the user
     *
     * @return void
     */
    public static function logout()
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
    }

    /**
     * Return indicator of whether a user is logged in or not
     *
     * @return boolean
     */
    public static function isLoggedIn()  //check is user_id is set in $_SESSION
    {
        return isset($_SESSION['user_id']);
    }    

    public static function nameUser()
    {
        return isset($_SESSION['user_name']);
    }

     /**
     * Remember the originally-requested page in the session
     *
     * @return void
     */
    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the originally-requested page to return to after requiring login, or default to the homepage
     *
     * @return void
     */
    public static function getReturnToPage()   //if this value does not exits in $_SESSION we return to homepage
    {
        return $_SESSION['return_to'] ?? '/public/index.php';
    }

        /**
     * Get the current logged-in user, from the session or the remember-me cookie
     *
     * @return mixed The user model or null if not logged in
     */
    public static function getUser()
    {
        if (isset($_SESSION['user_id'])) {
            return User::findByID($_SESSION['user_id']);
        }
    }
}
<?php

namespace App;

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
    public static function login($user)
    {
        session_regenerate_id(true); //Update the current session id with a newly generated one

        $_SESSION['user_id'] = $user->id;
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
}
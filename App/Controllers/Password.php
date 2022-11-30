<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Password controller
 */
class Password extends \Core\Controller
{
    /**
     * Show the forgotten password page
     *
     * @return void
     */
    public function forgotAction()
    {
        View::renderTemplate('Password/forgot.html');
    }

        /**
     * Send the password reset link to the supplied email
     *
     * @return void
     */
    public function requestResetAction()
    {
        User::sendPasswordReset($_POST['email']);

        View::renderTemplate('Password/reset_requested.html');
    }

       /**
     * Show the reset password form
     *
     * @return void
     */
    public function resetAction()
    {
        $token = $this->route_params['token'];  //token value from url

       /*  echo $token; */

       $user = $this->getUserOrExit($token);

        View::renderTemplate('Password/reset.html',[
             'token' => $token
        ]);

    }

     /**
     * Reset the user's password
     *
     * @return void
     */
    public function resetPasswordAction()
    {
        $token = $_POST['token'];  //pass the token through action, this is new action comming from submitting the form and we do not have token( from url)

        $user = $this->getUserOrExit($token);

        if ($user->resetPassword($_POST['password'])) {

            echo "password valid";

        } else {

            View::renderTemplate('Password/reset.html', [
                'token' => $token,
                'user' => $user
            ]);

        }
      
    }

    /**
     * Find the user model associated with the password reset token, or end the request with a message
     *
     * @param string $token Password reset token sent to user
     *
     * @return mixed User object if found and the token hasn't expired, null otherwise
     */
    protected function getUserOrExit($token)
    {
        $user = User::findByPasswordReset($token);

        if ($user) {

            return $user;

        } else {

            View::renderTemplate('Password/token_expired.html');
            exit;

        }
    }
}
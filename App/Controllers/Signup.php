<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Signup controller

 */
class Signup extends \Core\Controller
{
  /**
   * Show the signup page
   *
   * @return void
   */
  public function newAction()
  {
      View::render('Signup/new.html');
  }

   /**
     * Sign up a new user
     *
     * @return void
     */
    public function createAction()
    {
      /*  var_dump($_POST); to see what is comming from post request in frim new.html */

       $user = new User($_POST); //passing arguments like this will, when you creating new object will invoke __construct

       if($user->save()) {

        View::renderTemplate('Signup/success.html');

       } else{

       /*  View::renderTemplate('Signup/new.html', [
          'user' => $user]);  //passing user model */

          var_dump($user->errors);

       }

        
    }
}
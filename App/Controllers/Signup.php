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
      View::renderTemplate('Signup/new.html');
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

       /*  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/public/index.php?signup/success', true, 303);
            exit;    */               /*   mvc.hr::8080  in my project*/

            $this->redirect('/public/index.php?signup/success');

       } else{

        View::renderTemplate('Signup/new.html', [
          'user' => $user//passing user model
        ]);  

       }

        
    }

    
      public function successAction()
    {
        View::renderTemplate('Signup/success.html');
    }
}
<?php

namespace App\Controllers;

use \App\Models\User;

/**
 * Account controller
 */
class Account extends \Core\Controller
{

  /**
   * Validate if email is available (AJAX) for a new signup.
   *
   * @return void
   */
  public function validateEmailAction()
  {
    $is_valid = ! User::emailExists($_GET['email'], $_GET['ignore_id'] ?? null);  //validation plug in send email address via GET method and we access like this

    header('Content-Type: application/json');  //adding relevant content type fot json
    echo json_encode($is_valid); //encoding json boolean result using json_encode method

    // if put in browser address bar something like this http://mvc.hr:8080/account/validate-email?email=dinko.dugec@gmail.com, it
    // will   return false, it means that this email is taken, not available
  }
}
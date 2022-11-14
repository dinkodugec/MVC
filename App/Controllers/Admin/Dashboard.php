<?php

namespace App\Controllers\Admin;


use \Core\View;
use App\Models\User;


class Dashboard extends \Core\Controller

{


  public function indexAction()

  {

    $users = User:: getAll();

    View::renderTemplate('Admin/dashboard.html', [
      'user' => $users
    ]); 
}


    
  








  
}


?>
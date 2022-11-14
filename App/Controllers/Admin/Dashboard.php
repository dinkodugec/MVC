<?php

namespace App\Controllers\Admin;


use \Core\View;
use App\Models\User;


class Dashboard extends \Core\Controller

{

  public $count;


  public function indexAction()

  {
      // just to see how much people start session in our web site
     $_SESSION['pageCounter'] = $_SESSION['pageCounter'] +1;

/*     if(isset($_SESSION['count'])){

      return $this->count = $_SESSION['count']+1;
      
    }else{

      return $_SESSION['count'] = 1;
    } */

    View::renderTemplate('Admin/dashboard.html', [
      'postsCount' => count(\App\Models\Post::getAll()),
      'totalUsers' => count(\App\Models\User::getAll())

    ]); 
}


    
  








  
}


?>
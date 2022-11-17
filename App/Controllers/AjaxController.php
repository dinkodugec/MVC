<?php

namespace App\Controllers;

use Core\Controller;

/* use \Core\View; */


class AjaxController extends Controller

{

    public function allDAtaAction()
    {

        $data = (object)[    
          'postsCount' => count(\App\Models\Post::getAll()),
          'totalUsers' => count(\App\Models\User::getAll()),
           'totalComments' => count(\App\Models\Comment::getAll())
      ];


      header('Content-type: application/json');
      echo json_encode($data);

      

      
        

        

    }


}



?>
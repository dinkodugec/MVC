<?php

namespace App\Controllers;
use \Core\View;
use App\Models\Comment;



class Comments extends \Core\Controller

{

     /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $comments = Comment::getAll(); 
        
        View::renderTemplate('Comment/index.html', [
            'comments' => $comments 
          ]);  

        
    }





}
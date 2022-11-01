<?php

namespace App\Controllers\Admin;
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
        
        View::renderTemplate('Admin/comments.html', [
            'comments' => $comments

          ]); 
    }





}
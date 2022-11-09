<?php

namespace App\Controllers\Admin;


use App\Controllers\Admin\Posts;
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

     /**
     * Delete Comments
     * User can delete only comment which he posted himself
     *
     * @return void
     */
    
    public function deleteCommentAction()
    {
    
        $id = $_GET['id']; 

       $comments = Comment:: deleteComment($id);

       $postsController = new Posts('tz');

       $postsController->indexAction();

  

    }





}
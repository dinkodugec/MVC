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

     /**
     * Delete Comments
     * User can delete only comment which he posted himself
     *
     * @return void
     */
    
    public function deleteCommentsAction()
    {
    
        $id = $_GET['id']; 

       $comments = Comment:: deleteComment($id);

           if($comments){  
             if($_SESSION['user_id'] == $post['user_id']){
              $postIsDeleted = Comment::deleteComment($id); 
              }
            }
              
         $this->indexAction(); 

    }





}
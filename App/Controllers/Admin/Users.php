<?php

namespace App\Controllers\Admin;
use \Core\View;
use App\Models\User;



/**
 * User admin controller
 *
 * 
 */
class Users extends \Core\Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
      $users = User:: getAll();
     
      View::renderTemplate('Admin/users.html', [
            'users' => $users
          ]);  
    }

     /**
     * Insert post
     *
     * @return void
     */
    public function addPostAction()
    {
      /*   $posts = Post::getAll(); */
        
         View::renderTemplate('Admin/addPost.html', [
            ''
          ]); 
    }

    /**
     * Delete Post
     * User can delete only post which he posted himself
     *
     * @return void
     */
    
    public function deletePostAction()
    {
    
       /*  $id = $_GET['id']; 

       $post = Post:: getOnePost($id);

           if($post){  
             if($_SESSION['user_id'] == $post['user_id']){
              $postIsDeleted = Post::deletePost($id); 
              }
            }
              
         $this->indexAction();  */

    }
}
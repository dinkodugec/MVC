<?php

namespace App\Controllers\Admin;
use \Core\View;
use App\Models\Post;


/**
 * User admin controller
 *
 * 
 */
class Posts extends \Core\Controller
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
        $posts = Post::getAllwithUserName();
        
      
      
         View::renderTemplate('Admin/index.html', [
            'posts' => $posts
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
    
        $id = $_GET['id']; 

       $post = Post:: getOnePost($id);

           if($post){  
             if($_SESSION['user_id'] == $post['user_id']){
              $postIsDeleted = Post::deletePost($id); 
              }
            }
              
         $this->indexAction(); 

    }
}
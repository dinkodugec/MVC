<?php

namespace App\Controllers;
use \Core\View;
use App\Models\Comment;
use App\Models\Post;



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
            'comments' => $comments,
            'id' => $_GET['id']
      

          ]);  

        
    }

       /**
     * Create new comment
     *
     * @return void
     */
    public function createAction()
    {
       /* var_dump($_POST); */ //to see what is comming from post request in frim new.html 
   
       $comment = new Comment($_POST); //passing arguments like this will, when you creating new object will invoke __construct

       if($comment->save()) {

       /*  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/public/index.php?signup/success', true, 303);
            exit;    */               /*   mvc.hr::8080  in my project*/

            $this->redirect('/signup/success');

       } else{

        View::renderTemplate('Signup/new.html', [
          'comment' => $comment//passing user model
        ]);  

       }

        
    }





}
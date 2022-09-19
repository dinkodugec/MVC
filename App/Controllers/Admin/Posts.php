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
        $posts = Post::getAll();
        
         View::renderTemplate('Admin/index.html', [
            'posts' => $posts
          ]); 
    }
}
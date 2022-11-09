<?php

namespace Core;

/**
 * View
 */
class View
{

       /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = []) //added args to render method
    {
        extract($args, EXTR_SKIP); //convert associated array in individual variables

        $file = "../App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found";
        }
    }

     /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);  //add session like global variable
            $twig->addGlobal('is_logged_in', \App\Auth::isLoggedIn()); //function available in twig template
            $twig->addGlobal('current_user', \App\Auth::getUser()); //user object available in all views 
            $twig->addGlobal('flash_messages', \App\Flash::getMessages()); //message available
            $twig->addGlobal('posts', \App\Models\Post::getAll()); // posts like object available in all views
             $twig->addGlobal('users', \App\Models\USer::getAll()); 
             $twig->addGlobal('users', \App\Models\USer::getAll()); 
             
            $twig->addExtension(new \Twig\Extension\DebugExtension());
        }

        echo $twig->render($template, $args);
    } 
}
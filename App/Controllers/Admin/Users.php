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
     * Delete user ----
     *
     * @return void
     */
    
    public function deleteUserAction()
    {
    
         $id = $_GET['id']; 

         $user = User:: getOneUser($id);
       
  
             if($user){  
               if($_SESSION['user_id'] == $user['id']){
                $usertIsDeleted = User::deleteUser($id); 
                }
              }
                
           $this->indexAction(); 

    }
}
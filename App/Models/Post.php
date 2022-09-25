<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * Post model

 */
class Post extends \Core\Model
{

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
    

           try {
           $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content FROM posts
                               ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //return values as associative array

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

        /***
         * Add new Post
         */
    
      public static function addPost()
     
   
      {
        if(isset($_POST['submit'])){

          /*   print_r($_FILES['file']);  */

            $file = $_FILES['file'];

           $fileName = $_FILES['file']['name'];
           $fileTemp = $_FILES['file']['tmp_name'];
           $fileError = $_FILES['file']['error'];
           $fileType = $_FILES['file']['type'];
           $fileSize = $_FILES['file']['size'];

            if(!$fileError){
                // checking image size
                $requiredSize = 5 * 1024 * 1024; //5MB
               if($fileSize <= $requiredSize){ 
                     //checking image extension
                   $allowedExt = ["jpg", "png", "PNG", "JPG"];
                   if(in_array(explode('/',$fileType)[1],$allowedExt)){
                    $destinationFolder = "../upload/upload";
                    echo move_uploaded_file($fileTemp, $destinationFolder.$fileName);
                   }else{
                    echo "The image must be png or jpeg"; //make some 404 page
                   }
               }else{
                echo "The image file is corrupted"; //make some 404 page

               }
              }else{
                echo "The image file is corrupted"; //make some 404 page
          

                }
            }

        }
    }
    
        
      
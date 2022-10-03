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

            $stmt = $db->query('SELECT id, title, content, image, imgPath FROM posts
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
                    //uploading file and chech if file is successfullly uploaded
                    if(move_uploaded_file($fileTemp, $destinationFolder.$fileName)){
                          /*    $date = date("Y-m-d h:m:s"); it can be in table of date in field */
                          $imgPath = "upload/".$fileName;
                          $content = $_POST['content'];
                          $title = $_POST['title'];


                          $sql = "INSERT INTO posts (title, content, image, imgPath)
                          VALUES (?,?,?,?)";

                        $db = static::getDB();
                        $stmt = $db->prepare($sql);

                        $result =  $stmt->execute([$title,$content,$fileName,$imgPath]); 
                        if($result){
                            echo "it is ok";
                        }else{
                            echo "it was not success in uploading file in DB";
                        }


                    }else{
                        echo "something go wrong with uploading file";
                    }
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
    
        
      
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

            $stmt = $db->query('SELECT id, title, content, image, imgPath, user_id FROM posts ORDER BY id DESC
                               ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //return values as associative array

           
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

       /**
     * Get one post in an associative array / we can change method fetch, in fetchObj so get object back
     *
     * @return array
     */

     public static function getOnePost($id)
    
        {
    

           try {
           $db = static::getDB();

            $stmt = $db->prepare('SELECT id, title, content, image, imgPath, user_id FROM posts
                               WHERE id = ?');
           $stmt->execute([$id]);
        
           $results = $stmt->fetch(PDO::FETCH_ASSOC);  //return values as associative array
          
           
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * Get all the posts with username, we get from inner join two tables an associative array
     *
     * @return array
     */

    public static function getAllwithUserName()
   
     {
    
         try {
           $db = static::getDB();

            $stmt = $db->query('SELECT p.id, p.user_id, p.title, p.image, u.name, u.email FROM `posts` p inner join users u on p.user_id=u.id
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
                  /*   $destinationFolder = "../upload/upload"; */
                       $destinationFolder = "../public/admin/posts/";  
                  /*    $destinationFolder = "../App/public/admin/posts";  */

                    //uploading file and chech if file is successfullly uploaded
                    if(move_uploaded_file($fileTemp, $destinationFolder.$fileName)){
                          /*    $date = date("Y-m-d h:m:s"); it can be in table of date in field */
                          $imgPath = "upload/".$fileName;
                          $content = $_POST['content'];
                          $title = $_POST['title'];


                          $sql = "INSERT INTO posts (title, content, image, imgPath, user_id)
                          VALUES (?,?,?,?,?)";

                        $db = static::getDB();
                        $stmt = $db->prepare($sql);

                        $result =  $stmt->execute([$title,$content,$fileName,$imgPath, $_SESSION['user_id']]); 
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

      public static function deletePost($id)
      {
  
        try {
            $db = static::getDB();
 
            $stmt = $db->prepare("DELETE from posts where id = ?");

            $result =  $stmt->execute([$id]);
 
           
             return $result;

        /*      $stmt = $pdo->prepare("DELETE FROM myTable WHERE id = ?");
            $stmt->execute([$_SESSION['id']]);
            $stmt = null; */
            
            
             
         } catch (PDOException $e) {
             echo $e->getMessage();
         }
         

      }

          /**
     * Get all the posts as an associative array
     *
     * @return array
     */
   /*  public static function getAll()
    {
    

           try {
           $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content, image, imgPath, user_id FROM posts ORDER BY id DESC
                               ');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //return values as associative array

           
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
 */
    
    }
    
        
      
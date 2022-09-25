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
                    $destinationFolder = "../upload";
                      //uploading file and checking if file is successfully uploaded or not
                    if(move_uploaded_file($fileTemp, $destinationFolder.$fileName)){
                      /*    $date = date("Y-m-d h:m:s"); it can be in table of date in field */
                            /* $imgPath = $destinationFolder.$fileName; */
                            $imgPath = "upload".$fileName;

                      // title, content and image in posts table
                      $sql = "INSERT INTO posts (title, content, image, imgPath)
                              VALUES (?,?,?,?)";

                              $title = $_FILES['title'];
                              $content = $_POST['content'];

                            $db = static::getDB();
                            $stmt = $db->prepare($sql);

                           $result =  $stmt->execute([$title,$content,$fileName,$imgPath]); 
                            if($result){
                                header("Location : /signup/success ");
                            }else{
                                echo "it was not success in uploading file in DB";
                            }
                         
                    }else{
                        echo "it was not success in uploading file";
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

            $exp = explode(".", $fileName);
            $ext = end($exp);
            $path = "/upload/".$fileName;
            if(in_array($ext, $allowedExt)){
                if(move_uploaded_file($fileTemp, $path)){
                  /*   try{
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO `image`(image_name, location)  VALUES ('$file_name', '$path')";
                        $conn->exec($sql);
                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }
     
                    $conn = null;
                    header('location: index.php'); */

                    $sql = 'INSERT INTO posts (title, content, image)
                        VALUES  :title, :content, :image)';

                        $db = static::getDB();
                        $stmt = $db->prepare($sql);
                    
                    
                        $stmt->execute(array($ext, $allowedExt)); 
                    
                }
            }
        }
      }
    
    /**
     * Updatea the posts 
     *
     * @return array
     */
    public static function update()
    {
    
    }
}

/* $sql = 'INSERT INTO posts (title, content, image)
VALUES (?,?)';

$db = static::getDB();
$stmt = $db->prepare($sql);

$stmt->execute(array($fileActualExt, $allowed));  */
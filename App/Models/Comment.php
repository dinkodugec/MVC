<?php

namespace App\Models;

use PDO;
use PDOException;


/**
 * Comment model

 */
class Comment extends \Core\Model
{


     /**
   * Class constructor
   *
   * @param array $data  Initial property values
   *
   * @return void
   */
  public function __construct($data =[]) 
  {
    foreach ($data as $key => $value) {
      $this->$key = $value;   
    };
 
  }

    /**
     * Get all the comments as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
    

           try {
           $db = static::getDB();

            $stmt = $db->query('SELECT id, post_id, author, body FROM comments
                               ');
        /*   $stmt = $db->query('SELECT id, post_id, author, body FROM comments ORDER BY post_id ASC'); */
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //return values as associative array

           
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

     /**
   * Save the comment  with the current property values
   *
   * @return void
   */
  public function save()
  {

  /*   $this->validate(); */


         
        $post_id =$_POST['id'];
        $author = $_POST['author'];
        $body = $_POST['body'];
   
        $sql = "INSERT INTO comments (post_id, author, body)
        VALUES (?,?,?)";

      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $result =  $stmt->execute([$post_id, $author, $body]);
   
 
 
    }



    public static function getCommentsByPostId($post_id)
    {

          $db = static::getDB();

          $stmt = $db->prepare('SELECT id, post_id, author, body FROM comments WHERE 
          post_id = ?');

           $stmt ->execute([$post_id]);

           /* $results = $stmt->fetchAll(PDO::FETCH_OBJ); here is object*/
           $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           /* var_dump($results);
           die; */

          return $results;

    }

        /**
     * Delete Comment
     *
     * @return void
     */
    
    public static function deleteComment($id)
    {
    
      try {
        $db = static::getDB();

        $stmt = $db->prepare("DELETE from comments where id = ?");

        $result =  $stmt->execute([$id]);

       
         return $result;

        
         
     } catch (PDOException $e) {
         echo $e->getMessage();
     }
     

   }

}

    

  
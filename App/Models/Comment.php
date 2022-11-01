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


         
        $post_id =$_GET['id'];
        $author = $_POST['author'];
        $body = $_POST['body'];
   
        $sql = "INSERT INTO comments (post_id, author, body)
        VALUES (?,?,?)";

      $db = static::getDB();
      $stmt = $db->prepare($sql);

      $result =  $stmt->execute([$post_id, $author, $body]);
   
 
 
    }

  }
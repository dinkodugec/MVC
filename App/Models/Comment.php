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

    if(empty($this->errors)){
 

    $sql = 'INSERT INTO comments (id, post_id, author, body)
            VALUES (:id, :post_id, :author, :body)';

    $db = static::getDB();
    $stmt = $db->prepare($sql);

    /* binding value from data to those parameters */
    $stmt->bindValue(':name', $this->author, PDO::PARAM_STR);
    $stmt->bindValue(':email', $this->body, PDO::PARAM_STR);
   

       return  $stmt->execute(); //true for success false on failure
        } 

     return false;
 
 
    }

  }
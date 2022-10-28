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
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //return values as associative array

           
            return $results;
            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

  }
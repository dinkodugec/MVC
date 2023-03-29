<?php

namespace App\Models;

use PDO;
use PDOException;

class Paginates extends \Core\Model

{

    public static function getPaginatedData($page, $perPage)

    {

      $offset = ($page * $perPage) - $perPage;

      if($offset < 0){
        $offset = 0;
      }
      
      
      
      try {
        $db = static::getDB();

         $stmt = $db->query("SELECT id, title, content, image, imgPath, user_id FROM posts ORDER BY id DESC LIMIT $perPage offset $offset
                            ");
         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  

         $stmt2 = $db->query("SELECT id, title, content, image, imgPath, user_id FROM posts ORDER BY id DESC
                 ");
              $resultsCounts = $stmt2->fetchAll(PDO::FETCH_ASSOC);  
              

         $numPages = ceil(count($resultsCounts) / $perPage) ;

   /*       var_dump($numPages);
         die(); */

         $return = (object)['page' => $page, 'perPage' => $perPage, 'offset'=> $offset, 'numPages'=> $numPages, 'results'=>$results];

         return $return;
        
         return $numPages;

         
         
         
     } catch (PDOException $e) {
         echo $e->getMessage();
     }
 


    }






}
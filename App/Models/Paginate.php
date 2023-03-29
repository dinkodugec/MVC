<?php

namespace App\Models;

use PDO;
use PDOException;




    /*
      Pagination
    */

class Paginate extends \Core\Model
{
    public $current_page;
    public $items_per_page;
    public $items_total_count;
    public $items;


    public function __construct($current_page=1, $items_per_page=4)
    {
            $this->page = $current_page;
            $this->items_per_page = $items_per_page;
          
    }


       /*
     Return 4 post from database
      */
       
    public  function getPaginatedPost()
    {
      $db = 0;
      $host = 'localhost';
      $dbname = 'mvc';
      $username = 'root';
      $password = '';

      try {
          $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", 
                        $username, $password);

      } catch (\PDOException $e) {
          echo $e->getMessage();
      }


          /*   $db = static::getDB(); */
     /*      var_dump($this->items_per_page, $this->offset() );
          die();  */
            $stmt = $db->prepare('SELECT * FROM posts LIMIT ? OFFSET ?');
             $stmt->execute([$this->items_per_page, 4 ]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  
            var_dump($results);
            die();
            $this->items_total_count = count($results);
           $this->items = $results;
          
    }


    /*
      Next Page
    */
    
    public function next()
    {
      return $this->current_page +1;
    }

   
     /*
       Previous Page
     */

    public function previous()
    {
      return $this->current_page -1;
    }


     /*
       Total Page
     */

    public function page_total()
    {
      return ceil($this->items_total_count/$this->items_per_page);
    }

      /*
       Just to see if has previous Page
      */

    public function hasPrevious()
    {
      return $this->previous() >= 1 ? true : false;
    }



    public function hasNext()
    {
       return $this->next() <= $this->page_total() ? true : false;
    }


    public function offset()
    {
      return ($this->current_page - 1) * $this->items_per_page;
    }

     

}
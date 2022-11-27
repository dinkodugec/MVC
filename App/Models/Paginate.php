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


    public function __construct($current_page=1, $items_per_page=4, $items_total_count=0)
    {
            $this->page = $current_page;
            $this->items_per_page = $items_per_page;
            $this->items_total_count = $items_total_count;
    }


       /*
     Return 4 post from database
      */
       
   public static function getFourPosts()
    {
            $db = static::getDB();

            $stmt = $db->query('SELECT * FROM posts LIMIT {$items_per_page} OFFSET {$paginate->offset()}');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  

           
            return $results;
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
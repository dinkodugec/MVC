<?php

namespace Core;

use PDO;


// singleton pattern https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
class DB
{


    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $user = 'mvcuser';
    private $pass = 'ronbetelges';
    private $name = 'mvc';

    private function __construct()
    {
      $this->conn = new PDO("mysql:host={$this->host};
      dbname={$this->name}", $this->user,$this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
   
    }

    public static function getInstance()
    {
      $data  = new DB;

   /*    if(!self::$instance)
      {
        self::$instance = new DB();
      } */
     
      return $data->conn;
    }
    
    public static function getConnection()
    {
      return self::$conn;
    }

  
}




?>
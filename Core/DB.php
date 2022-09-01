<?php

namespace Core;

use PDO;


// singleton pattern https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
class DB
{


    private static $instance = null;
    private static $conn;

    private $host = 'localhost';
    private $user = 'mvcuser';
    private $pass = 'ronbetelges';
    private $name = 'mvc';

    private function __construct()
    {
      $this->conn = new PDO("mysql:host={$this->host};
      dbname={$this->name}", $this->user,$this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
   
    }

    public static function getInstance()
    {
      if(!self::$instance)
      {
        self::$instance = new DB();
      }
     
      return self::$instance;
    }
    
    public static function getConnection()
    {
      return self::$conn;
    }

  
}

$db = DB::getInstance();


?>
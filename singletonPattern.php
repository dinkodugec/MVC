<?php

class Connection 

{

protected static $instance;

/* public $name; */

private static $dsn = 'mysql:host=localhost;dbname=test';

private static $username = 'root';

private static $password = '';

private function __construct() {
try {
self::$instance = new PDO(self::$dsn, self::$username, self::$password);
} catch (PDOException $e) {
echo "MySql Connection Error: " . $e->getMessage();
}
}



public static function getInstance() 
{
    if (!self::$instance) {
    new Connection();
}

return self::$instance;
}

/*  public static function users()
{

  $connection = Connection::getInstance();
  $query = "SELECT * FROM user Where id=2";
  
  $statement = $connection->prepare($query);
  
  $statement->execute();
  
  $result = $statement->fetchObject();

  return $result;
  
} */

}

    /*
    $found = Connection::users();
     var_dump($found); 
     $new = new Connection();
    $new->name = $found->name; 
    var_dump($new->name); 
    asigning object properties to column from database */
 




?>

<!-- http://giuffre.github.io/PHP-Mysql-how-to-optimize-a-connection/ -->
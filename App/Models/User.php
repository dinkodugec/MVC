<?php

namespace App\Models;

use PDO;
use \App\Token;

/**
 * Example user model
 */
class User extends \Core\Model
{

   /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

  /**
   * Class constructor
   *
   * @param array $data  Initial property values
   *
   * @return void
   */
  public function __construct($data =[]) //giving arguments optional, giving it default value
  {
    foreach ($data as $key => $value) {
      $this->$key = $value;    //looping around array and setting key=>value pair as a property of new object
    };
                    /*  convert array to object properties */
   /*  'name'=>'Dinko',                    $user->name= 'Dinko'
    'email'=>'dinko@gmail',             $user->email = 'dinko@gmail.com'
    'password'=>'secret'                 $user->password = 'secret'
       $data                                    $user */
  }

  /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name, email FROM users');

        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
 
  /**
   * Save the user model with the current property values
   *
   * @return void
   */
  public function save()
  {

    $this->validate();

    if(empty($this->errors)){
 
    $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

    $token = new Token();
    $hashed_token = $token->getHash();

    $sql = 'INSERT INTO users (name, email, password_hash, activation_hash)
            VALUES (:name, :email, :password_hash, :activation_hash)';

    $db = static::getDB();
    $stmt = $db->prepare($sql);

    /* binding value from data to those parameters */
    $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
    $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
    $stmt->bindValue(':activation_hash', $hashed_token, PDO::PARAM_STR);

       return  $stmt->execute(); //true for success false on failure
        } 

     return false;
 
 
    }
    

  /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public function validate()
    {
       // Name
       if ($this->name == '') {
           $this->errors[] = 'Name is required';
       }

       // email address
       if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
           $this->errors[] = 'Invalid email';
       }

       if ($this->emailExists($this->email)) {
        $this->errors[] = 'email already taken';
    }

       // Password
       if ($this->password != $this->password_confirmation) {
           $this->errors[] = 'Password must match confirmation';
       }

       if (strlen($this->password) < 6) {
           $this->errors[] = 'Please enter at least 6 characters for the password';
       }

       if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
           $this->errors[] = 'Password needs at least one letter';
       }

       if (preg_match('/.*\d+.*/i', $this->password) == 0) {
           $this->errors[] = 'Password needs at least one number';
       }
    }

    /**
     * See if a user record already exists with the specified email
     *
     * @param string $email email address to search for
     *
     * @return boolean  True if a record already exists with the specified email, false otherwise
     */
    protected function emailExists($email)
    {
     return static::findByEmail($email) !== false;
    }

    /**
     * Find a user model by email address
     *
     * @param string $email email address to search for
     *
     * @return mixed User object if found, false otherwise
     */
    public static function findByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class()); //we change here so we now get object
                                      /*   namespace hardcoded 'App\Models\User' */
        $stmt->execute();

        return $stmt->fetch();//by default PDO fetch method return an array
    }


    /**
     * Authenticate a user by email and password.
     *
     * @param string $email email address
     * @param string $password password
     *
     * @return mixed  The user object or false if authentication fails
     */
    public static function authenticate($email, $password)
    {
        $user = static::findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password_hash)) {
                return $user;
            }
        }

        return false;
    }

     /**
     * Find a user model by ID
     *
     * @param string $id The user ID
     *
     * @return mixed User object if found, false otherwise
     */
    public static function findByID($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); //binding value like integer

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

     /**
     * Remember the login by inserting a new unique token into the remembered_logins table
     * for this user record
     *
     * @return boolean  True if the login was remembered successfully, false otherwise
     */
    public function rememberLogin()
    {
        $token = new Token();
        $hashed_token = $token->getHash(); // get random token and hash
        $this->remember_token = $token->getValue();

        $this->expiry_timestamp = time() + 60 * 60 * 24 * 30;  // 30 days from now
        

        $sql = 'INSERT INTO remembered_logins (token_hash, user_id, expires_at)
                VALUES (:token_hash, :user_id, :expires_at)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash', $hashed_token, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s',  $this->expiry_timestamp), PDO::PARAM_STR);

        return $stmt->execute();
    }

           /**
     * Get one user in ass array
     *
     * @return array
     */

    public static function getOneUser($id)
    
    {


       try {
       $db = static::getDB();

        $stmt = $db->prepare('SELECT id, name, email FROM users
                           WHERE id = ?');
       $stmt->execute([$id]);
    
       $results = $stmt->fetch(PDO::FETCH_ASSOC);  //return values as associative array
      
       
        return $results;
        
        
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }

   }
       /*
        *
         Delete User with id
        *
       */


   public static function deleteUser($id)
   {

     try {
         $db = static::getDB();

         $stmt = $db->prepare("DELETE from users where id = ?");

         $result =  $stmt->execute([$id]);

        
          return $result;
        
      } catch (\PDOException $e) {
          echo $e->getMessage();
      }
      

   }


      /**
     * Send password reset instructions to the user specified
     *
     * @param string $email The email address
     *
     * @return void
     */
    public static function sendPasswordReset($email)
    {
        $user = static::findByEmail($email);

        if ($user) {

            // 

        }
    }
}
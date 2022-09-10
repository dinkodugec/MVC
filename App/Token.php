<?php

namespace App;

/**
 * Unique random tokens
 */
class Token
{
    /**
     * The token value
     * @var array
     */
    protected $token; // value of token

    /**
     * Class constructor. Create a new random token or assign an existing one if passed in.
     *
     * @param string $value (optional) A token value
     *
     * @return void
     */
    public function __construct($token_value = null) //$token_value = null
    {
        if ($token_value) {
  
            $this->token = $token_value;  //get hash of existing token

        } else {

       /*  echo random_bytes(16);  will output string of bytes what is not good idea */

            $this->token = bin2hex(random_bytes(16));  //convert this bytes in ASCII string 16 bytes = 128 bits = 32 hex characters

        }
    }

    /**
     * Get the token value
     *
     * @return string The value
     */
    public function getValue()
    {
        return $this->token;
    }

    /**
     * Get the hashed token value
     *
     * @return string The hashed value
     */
    public function getHash()
    {
        return hash_hmac('sha256', $this->token, \App\Config::SECRET_KEY);  // sha256 = 64 chars
        https://randomkeygen.com/ it is recomended a 128 bit key, whic is 32 charachters
    }
}
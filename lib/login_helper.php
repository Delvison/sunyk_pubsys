<?php
/**
* This script is responsible for generating random salt's and hashing passwords.
*/

/**
* Creates a random salt of length 8
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function randomSalt()
{
  $len = 8;
  $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij'.
  'klmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
  $l = strlen($chars) - 1;
  $str = '';
  for ($i = 0; $i <$len; ++$i) {
    $str .= $chars[rand(0, $l)];
  }
  return $str;
}

/**
* creates a hash using a random salt.
* @param string $string The string to be hashed
* @param string $hash_method sha1
* @param string $salt Salt used for hashing
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function create_hash($string, $hash_method = 'sha1', $salt)
{
  // $salt = randomSalt();
  if (function_exists('hash') && in_array($hash_method, hash_algos())) {
    return hash($hash_method, $salt . $string);
  }
  return sha1($salt . $string);
}

/**
* @param string $pass The user submitted password
* @param string $hashed_pass The hashed password pulled from the database
* @param string $salt The salt pulled from the database
* @param string $hash_method The hashing method used to generate the hashed
* password
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function validateLogin($pass, $hashed_pass, $salt, $hash_method = 'sha1')
{
  if (function_exists('hash') && in_array($hash_method, hash_algos())) {
    return ($hashed_pass === hash($hash_method, $salt . $pass));
  }
  return ($hashed_pass === sha1($salt . $pass));
}
?>

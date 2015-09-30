<?php
/**
* This script defines all functions responsible for dealing with the user model.
*/
if (!defined('PROJ_PATH')) define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
include_once PROJ_PATH.'lib/login_helper.php';
include_once PROJ_PATH.'lib/db_helper.php';
include_once PROJ_PATH.'lib/error_reporting.php';
include_once PROJ_PATH.'lib/functions.php';
include_once PROJ_PATH.'config/db_config.php';
/**
* Creates a user in the database.
* @param string $username Desired username
* @param string $username Desired username
* @param string $password Desired password
* @param string $email User's email
* @param string $date Date of creation
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
// function create_user($username, $password, $email, $is_admin)
// {
//   // global variables from config/db_config.php
//   global $db_hostname; // mysql database hostname
//   global $db_user; // mysql user
//   global $db_password; // mysql password
//   global $publications_db; // database of publications
//   global $user_tb; // user table
//   // generate salt and hashed password
//   $salt = randomSalt();
//   $hash = create_hash($password, 'sha1', $salt);
//   // get current date
//   date_default_timezone_set('Asia/Seoul');
//   $date = date("Y-m-d H:i:s");
//   // check if users exist, if not -- make user admin
//   $count_query = "SELECT COUNT(*) FROM $user_tb;";
//   $count_result = receive_query($count_query, $db_hostname, $db_user, $db_password,
//                   $publications_db)->fetch_array();
//   if ($count_result[0] == 0)
//   {
//     $is_admin = true;
//     debug("No Users in database.");
//   }
//   // check if email is valid
//   if (!check_email($email)) {
//     // TODO: redirect with error back to registration
//     debug("invalid email");
//   }
//   // create query
//   $query = "INSERT INTO $user_tb (username, email, salt, password,".
//   " is_admin, date_created) VALUES".
//   " ('$username','$email','$salt','$hash','$is_admin','$date');";
//   // called from lib/db_helper.php
//   return send_query($query, $db_hostname, $db_user, $db_password,
//   $publications_db);
// }

/**
* Takes in a username and password and verifies that both match the record on
* the database. Returns a boolean value indicating whether or not the login
* was successful.
* @param string $username Username that was given to the login page
* @param string $password Password that was given to the login page
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function login_user($username, $password)
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $user_tb; // user table
  // query the database for the user's record
  $query = "SELECT * FROM $user_tb WHERE username='$username';";
  $result = receive_query($query, $db_hostname, $db_user, $db_password,
  $publications_db);
  // extract record from query
  $row = $result->fetch_array();
  // password and salt from the database
  $db_password = $row['password'];
  $db_salt = $row['salt'];
  // validate the password typed
  $logged_in = validateLogin($password, $db_password, $db_salt, 'sha1');
  return $logged_in;
}

/**
* Checks if a username exists on the session. If not, then it
* redirects to login page.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function check_login()
{
  session_id('mySessionID');
  session_start();
  if (!isset($_SESSION['username']))
  {
    // redirect to the login page
    header("Location: index.php?error=login_first");
    die();
  }
}

/**
* Terminates a session and all of its variables.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function logout()
{
  session_id('mySessionID');
  session_start();
  session_destroy();
  header("Location: ../views/index.php");
  die();
}
?>

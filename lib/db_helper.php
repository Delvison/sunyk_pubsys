<?php
/**
* The purpose of this script is to act as an interface to a mysql server
*/

if (!defined('PROJ_PATH')) define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/sunyk-pupsys/');
include_once PROJ_PATH.'lib/functions.php';
include_once PROJ_PATH.'lib/error_reporting.php';

/**
* Creates all neccessary databases if they do not exist
* @param string $db_hostname Mysql hostname to connect to
* @param string $db_user Mysql hostname username
* @param string $db_password Mysql hostname username's password
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function create_databases($db_hostname, $db_user, $db_password)
{
  // TODO: Write me!
  // read schema from schema/sql-schemas.sql
}

/**
* Sends query to the mysql database
* @param string $query Mysql desired query string
* @param string $db_hostname Mysql hostname to connect to
* @param string $db_user Mysql hostname username
* @param string $db_password Mysql hostname username's password
* @param string $db_use Desired mysql database for use
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function send_query($query, $db_hostname, $db_user, $db_password, $db_use)
{
  $db = new mysqli($db_hostname,$db_user,$db_password,$db_use);
  if ($db->connect_errno > 0){
    die('Unable to connect to database');
    return FALSE;
    // TODO: Redirect appropriately
  }
  if ( !$result = $db->query($query) ){
    debug($query);
    die('The was an error with the query '. $query);
    mysqli_close($db);
    return FALSE;
    // TODO: Redirect appropriately
  } else {
    debug("Query success");
    mysqli_close($db);
    return TRUE;
  }
}

/**
* Receives results for a query to the mysql database
* @param string $query Mysql desired query string
* @param string $db_hostname Mysql hostname to connect to
* @param string $db_user Mysql hostname username
* @param string $db_password Mysql hostname username's password
* @param string $db_use Desired mysql database for use
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function receive_query($query, $db_hostname, $db_user, $db_password, $db_use)
{
  $db = new mysqli($db_hostname,$db_user,$db_password,$db_use);
  if ($db->connect_errno > 0){
    die('Unable to connect to database');
    header("Location: error.php");
    die();
  }
  if ( !$result = $db->query($query) ){
    die('The was an error with the query '.$query);
    header("Location: error.php");
    die();
  } else {
    return $result;
  }
}
?>

<?php
/**
* This script enables error reporting in php
*/
define('DEBUG', true);

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

function debug($msg)
{
  if (DEBUG){
    echo '<script>console.log("'.$msg.'"); </script>';
  }
}
?>

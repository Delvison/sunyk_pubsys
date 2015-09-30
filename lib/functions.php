<?php

// includes
define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/sunyk-pubsys/');
include_once PROJ_PATH.'lib/error_reporting.php';
include_once PROJ_PATH.'lib/db_helper.php';
include_once PROJ_PATH.'config/db_config.php';

/**
* This function is responsible for handling errors. Redirects to next
* location after a defined wait time
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function error($error, $location, $redirect, $seconds)
{
  echo "<br/>";
  echo "<h1>".$error."</h1>";
  if ($redirect)  {
    header("Refresh: $seconds; URL='$location'");
  }
  die();
}

/**
* Takes in a target directory and a filename and ensures that the file to be
* inserted in the directory has a unique filename.
* @param String $target_dir Target directory for file
* @param String $filename Name of file to be inserted to target directory.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function create_unique_filename($target_dir,$filename)
{
  $now = time();
  while ( file_exists($result = $target_dir . $now.'-'.$filename))
  {
    $now++;
  }
  return $result;
}

/**
* This function checks whether the password contains any alphabetic
*	characters and numeric values
* @author Nuwan
*/
function check_pwd($str)
{
  if ( strlen($str) >= 8 &&
  strlen($str) <= 30 &&
  preg_match('/[A-Z]/',$str ) &&
  preg_match('#[0-9]#',$str) &&
  preg_match('/[a-z]/',$str ))
  {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

/**
* This function checks whether a given username is greater than 8
* characters and less than 30.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function check_username($str)
{
  if ( strlen($str) >= 4 &&
  strlen($str) <= 30)
  {
    return TRUE;
  } else {
    return FALSE;
  }
}

/**
* This function checks whether a given email is valid.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function check_email($str)
{
  if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

/**
* Produces an html dropdown list
* @param String $filename path of file to be read
* @param String $id html id element name
* @author Delvison Castillo
*/
function produce_dropdown($filename,$id)
{
  $read = fopen($filename,"r");
  if ($read)
  {
    $str = '<select id="'.$id.'" name="'.$id.'">';
    while (($line = fgets($read)) !== false)
    {
      $str = $str . '<option value="'.$line.'">'.$line.'</option>';
    }
    $str = $str . '</select>';
    echo $str;
  } else {
    // error has occurred
     debug('error reading countries');
  }
}


/**
* Produce a table of all publications unfiltered
* @author Delvison Castillo
*/
function all_publications_table()
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $publication_tb;
  global $publication_metadata_tb;
  global $is_author_of_tb;
  global $is_category_tb;
  global $journal_tb;
  global $conference_tb;

  // query for all publications
  // $query = "SELECT ".
  // "$publication_tb.id,".
  // "$publication_tb.title,".
  // "$publication_tb.abstract,".
  // "$publication_tb.publication_date,".
  // "$publication_metadata_tb.country,".
  // "$publication_tb.user_posted ".
  // "FROM $publication_tb, $publication_metadata_tb".
  // " WHERE $publication_tb.id = $publication_metadata_tb.id;";

  $query = "SELECT ".
  "$publication_tb.id,".
  "$publication_tb.title,".
  "$publication_tb.abstract,".
  "$publication_tb.publication_date,".
  //"$publication_tb.user_posted, ".
  "$publication_metadata_tb.vol,".
  "$publication_metadata_tb.issue,".
  "$publication_metadata_tb.start_pg,".
  "$publication_metadata_tb.end_pg,".
  "$publication_metadata_tb.impact_factor,".
  "$publication_metadata_tb.country,".
  "$is_author_of_tb.author,".
  "$is_category_tb.journal,".
  "$is_category_tb.conference ".
  "FROM $publication_tb, $publication_metadata_tb, $is_author_of_tb, $is_category_tb".
  " WHERE $publication_tb.id = $publication_metadata_tb.id".
  " AND $publication_tb.id = $is_author_of_tb.publication".
  " AND $publication_tb.id = $is_category_tb.publication";

  $receive = receive_query($query,$db_hostname,$db_user,$db_password,
            $publications_db);

  $str = "<table border='1' class='table mytable' id='mytable' name='mytable

  </tbody>'>";
  $str .= "<tr>".
  "<th>Article Title</th>".
  "<th>Abstract</th>".
  "<th>Date Published</th>".
  "<th>Volume</th>".
  "<th>Issue</th>".
  "<th>Start Page</th>".
  "<th>End Page</th>".
  "<th>Impact Factor</th>".
  "<th>Country</th>".
  "<th>Author(s)</th>".
  "<th>Journal</th>".
  "<th>Conference</th>".
  "</tr>";
  while ($result = $receive->fetch_assoc())
  {
    $str.= '<tbody class="fbody"><tr>';

    foreach($result as $val)
    {
      if (strcmp($val,$result['abstract']) == 0 && strlen($val) >= 100 ) {
        $val = substr($val,0,100) . '...';
      }
      if (strcmp($val,$result['title']) == 0)
      {
        $str.= "<td><a href='view_publication.php?t=".
        $result['id']."'>$val</a></td>";
      } else {
        if (strcmp($result['id'], $val) != 0) $str.= "<td>".$val."</td>";
      }
    }
    $str.= '</tr></tbody>';
  }
  $str = $str . "</table>";
  echo $str;
}

function upload_file($user_id)
{
  // to receive a file upload use $_FILES
  // FILES explained: http://php.net/manual/en/reserved.variables.files.php
  // define maxfilesize
  // TODO: correct max filesize
  define("MAX_FILESIZE", 100000000);

  // receive upload
  $fieldname = "inputFile";
  // echo "file: " . $_FILES[$fieldname]['name'];
  // echo "<br/>type: " . $_FILES[$fieldname]['type'];
  // echo "<br/>temp_name: " . $_FILES[$fieldname]['tmp_name'];
  // make a note of the current working directory
  $dir_proj = str_replace(basename(__DIR__).'/',
  '',str_replace(basename($_SERVER['PHP_SELF']), '',
  $_SERVER['PHP_SELF']));
  // echo "<br/> dir self: ". $dir_proj;
  // make a note of the directory that will recieve the uploaded file
  $uploadsDirectory = PROJ_PATH . 'uploads/';
  // echo "<br/> uploads directory: ".$uploadsDirectory;
  // make a note of the location of the upload form in case we need it
  // TODO: correct location of upload form
  $uploadForm = PROJ_PATH . 'views/add_publication.php';
  // echo "<br/>upload form: " . $uploadForm;
  // possible errors
  $errors = array(1 => 'max file size exceeeded',
                  2 => 'html form max file size exceeded',
                  3 => 'file upload was only partial',
                  4 => 'no file was attached');
  // check for PHP's built-in uploading errors
  ($_FILES[$fieldname]['error'] == 0)
    or error($errors[$_FILES[$fieldname]['error']], $uploadForm, TRUE, 5);
  // check that the file we are working on really was the subject of
  // an HTTP upload
  @is_uploaded_file($_FILES[$fieldname]['tmp_name'])
    or error('not an HTTP upload', $uploadForm, TRUE, 5);
  // // check that user has a folder to house uploads. Create if not.
  // create_user_dir($uploadsDirectory = $uploadsDirectory . $user_id ."/")
  //   or error('insuffiecient permission to create dir', $uploadForm, TRUE, 5);
  // make a unique filename for the uploaded file and check it is not already
  // taken... if it is already taken keep trying until we find a vacant one
  // sample filename: 1140732936-filename.jpg
  $uploadFilename = create_unique_filename($uploadsDirectory,
  $_FILES[$fieldname]['name']);
  //check if temp file exists
  file_exists($_FILES[$fieldname]['tmp_name'])
    or error('Temp file not uploaded', $uploadForm, FALSE,5);
  //echo "<br/>upload_filename: ". $uploadFilename;
  // move the file to its final location with unique filename
  // ensure that proper permissions are set:
  // sudo chown -R www-data:www-data /var/www
  @move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
    or error('receiving directory insuffiecient permission for '.
    $_FILES[$fieldname]['tmp_name'].' under filename '.$uploadFilename , $uploadForm,
    FALSE, 5);
  // image successfully received
  // TODO: redirect appropriately
  return str_replace(PROJ_PATH,"", $uploadFilename);
}

/**
* Creates a user directory for images if it doesnt already exist
* @param String $path Absolute path to the users image directory
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function create_user_dir($path)
{
  if (!file_exists($path)){
    mkdir($path,0777,true);
  }
  return true;
}
?>

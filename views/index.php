<?php
  define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/sunyk_pubsys/');
  session_id('sunykSesh');
  session_start();
	if (isset($_SESSION['username'])) {
    header("Location: ../views/home.php");
  }
?>


<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>

<title> Publication v.0.0.1 </title>

<body background="text.JPG">
<img src="logo.PNG" style="float: left;width:100px;height:60px;" />
<h2> &nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>

<div align = "center ">


<h2> SUNY KOREA Digital Library </h2>
</div>
<hr>
<div style="width: 100%;overflow:auto;">
    <div style="float:right; width: 50%">
	
	
	
<h2> Sign In </h2>

<form action="login.php" method = "post">
User ID (SBU ID in case of students) : <br><input type = "text" name = "user"></input>
<br></br>
Password : <br><input type = "password" name = "pass" ></input> </br>
<br>
<input type = "submit" value= "Login"></input>
</form>
<br>

<hr>
<h2> Sign Up </h2>

<form action = "create.php" method = "post">
	User ID (SBU ID in case of students) :<br><input type = "text" name = "user">
	<br></br>
	First Name :<br><input type = "text" name = "fname"></input>
	<br></br>
	Last Name :<br><input type = "text" name = "lname"></input>
	<br></br>
	Password :<br><input type = "password" name = "pass"></input>
	<br></br>
	
	Designation :<br> <select name="designation"></p>
	  <option value="">Designation...</option>
	 <option value="Student">Student</option>
	 <option value="Professor">Professor</option>
	 <option value="Others">Others</option>
	 
	</select>
	<br></br>
<input type ="submit" value ="Create New Account">

</form>
</div>

    <div style="float:left; width :50%">

	<img src="index.JPG" alt="SUNY KOREA" height="70%" width="90%">
    
	</div>
	<?php echo "Debug: PROJ_PATH: ".PROJ_PATH; ?>
</div>
</body>
</html>


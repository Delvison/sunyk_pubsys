<html>

<title> Publication v.0.0.1 </title>


<body background="text.JPG">
<img src="logo.PNG" style="float: left;width:100px;height:60px;" />
<h2> &nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>



<div align = "center ">
<h2> SUNY KOREA Digital Library</h2>
</div>

<hr>
<div style="width: 100%;overflow:auto;">

 <div style="float:left; width: 25%">
<br></br>
 <div align = "left">
<form action = "conjour.html">
<input type = "submit" value = "Insert Your Conference/ Journal Information">
</form>
</div>

<div align = "left">
<form action = "pap.html">
<input type = "submit" value = "Insert Your Paper Information">
</form>
</div>

<div align = "left">
<form action = "projpap.html">
<input type = "submit" value = "Insert Your Project Information">
</form>
</div>

		<div align = "left">
		<form action = "showlist.php">
		<input type = "submit" value = "List of Papers ">
		</form>
		</div>


		<div align = "left">
		<form action = "journalinfo.php">
		<input type = "submit" value = "Journal/Conference List">
		</form>
		</div>
		
		<div align = "left">
		<form action = "abstract.php">
		<input type = "submit" value = "Papers with Abstract">
		</form>
		</div>
		
		<div align = "left">
		<form action = "papercsv.php">
		<input type = "submit" value = "Download Paper List">
		</form>
		
		</div><div align = "left">
		<form action = "journalcsv.php">
		<input type = "submit" value = "Download Journal List">
		</form>
		</div>
		
		<div align = "left">
		<form action = "home.php">
		<input type = "submit" value = "Refresh">
		</form>
		</div>


<br></br>
<a href="http://www.cs.sunykorea.ac.kr/" target="_blank">Department of Computer Science, SUNY Korea</a><br></br>
<a href="http://www.sunykorea.ac.kr/" target="_blank">State University of New York, Korea</a><br></br>
<a href="https://www.cs.stonybrook.edu/" target="_blank">Department of Computer Science, Stony Brook University</a><br></br>
<br> </br>
<div align = "left">
<form action = "index.html">
<input type = "submit" value="Log out">
</form>
</div>
</div>

<div style="float:left; width: 75%">
<b></br>


	<div align = "right"> 
	<form method="post" name="display" action="authorsearch.php" /> 
	<input type="text" placeholder=" Author Search" name="name" /> 
	<input type="submit" name="Submit" value="Search" /> 
	</form>
	</div>

<table cellpadding="10">
<tr>
<td><b>S. No.</b></td>
<td><b>Title</td>
<td><b>First Author</td>
<td><b>Co Author</td>
<td><b>Start Page</td>
<td><b>End Page</td>
<td><b>Journal/ Conference Name</td>
<td><b>Area</td>
<td><b>Year</td>
<td><b>Country</td>
<td><b>Paper Type</td>


</tr>

<?php

    $taken = "false";
    $database = "sunypub";
    $password = "";
    $username = "root";

    // Connect to database
   $con = mysql_connect('localhost', $username, $password) or die("Unable to connect database");
	@mysql_select_db($database, $con) or die("Unable to connect");
$query="SELECT * FROM paper Order BY ptitle ASC";
$result=mysql_query($query);
mysql_close();
$i = 1;
while ($row=mysql_fetch_array($result)){
echo ("<tr> <td>$i. </td>");	
echo ("<td>$row[ptitle]</td>");
echo ("<td>$row[fauthor]</td>");
echo ("<td>$row[coauthor]</td>");
//echo ("<td>$row[abstract]</td>");
echo ("<td>$row[stpage]</td>");
echo ("<td>$row[endpage]</td>");

echo ("<td>$row[jname]</td>");
echo ("<td>$row[area]</td>");
echo ("<td>$row[year]</td>");
echo ("<td>$row[country]</td>");
echo ("<td>$row[papertype]</td>");
echo ("<td><a href=\"papedit.php?id=$row[ptitle]\">Edit</a></td>");
echo ("<td><a href=\"datadelete.php?id=$row[ptitle]\">Delete</a></td></tr>");
$i++;
}
echo "</table>";

?>

</div>


</div>

</body>
</html>
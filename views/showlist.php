<html>

<title> Publication v.0.0.1 </title>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"> </script>
<script src="../jquery.js"> </script>
<script
src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body background="text.JPG">
<script>
      // function for table filtering
      $(document).ready(function()
      {
        $("#searchInput").keyup(function ()
        {
          //split the current value of searchInput
          var data = this.value.split(" ");
          //create a jquery object of the rows
          var jo = $(".fbody").find("tr");
          if (this.value == "") {
            jo.show();
            return;
          }
          //hide all the rows
          jo.hide();
          //Recusively filter the jquery object to get results.
          jo.filter(function (i, v) {
            var $t = $(this);
            for (var d = 0; d < data.length; ++d)
            {
              if ($t.is( ":contains('" + data[d] + "')") ) {
                return true;
              }
            }
            return false;
        })
        //show the rows that match.
        .show();
        }).focus(function () {
          this.value = "";
          $(this).css({
            "color": "black"
          });
          $(this).unbind('focus');
        }).css({ "color": "#C0C0C0" });
        $("#searchInput").focusout(function(){
          if ($(this).val() == '') {
            $(this).val('Filter...');
          }
          $(this).css({"color": "#C0C0C0" });
        })
        .focusin(function(){
          if ($(this).val() == 'Filter...'){
            $(this).val('');
          }
          $(this).css({"color": "black" });
        });
      });
    </script>
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

	<div align = "right" > 
	<form method="post" name="display" action="authorsearch.php" /> 
	<input type="text" id="searchInput" placeholder=" Author Search" name="name" /> 
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
<tbody class="fbody"><tr>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
<td>meow</td>
</tr></tbody>
<tbody class="fbody"><tr>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
<td>dog</td>
</tr></tbody>
</table>


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
echo("<tr>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<td>meow</td>");
echo("<tr>");
echo "</table>";

?>

</div>


</div>

</body>

</html>

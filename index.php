<html>
<head>
<title>Internet Programming Class</title>
</head>
<body>
<h1>HTML Webpage with PHP and MySQL (Reading from Database)</h1>

<?php
if(!isset($_POST["submit"]))
{
?>
Click on submit button to read from the database.
<form action="" method="post">
	<input type="submit" name="submit" value="Submit me!"> 
</form>
<?php
}
else
{
	echo "To connect to MySQL you need the Server IP address <var>host</var>, MySQL user name <var>user</var> and the user's password <var>pass</var><p>";
	echo "The connection is made using:<br>";
	echo "mysql_connect(<var>host</var>, <var>user</var>, <var>pass</var>)<p>";

	$host = "localhost";
	$user = "root";
	$pass = "ims";
		
	//$conn = mysql_connect("localhost","root","ims");//Alternatively the variables can be typed directly.
	
	echo "Specify name of database and table to read from.<P>";
	$dbName = "cns";
	$tbName = "users";
	
	//Many records/rows
	echo "<P>Multi record query - Uses <code>while</code> loop<p>";
	$mysqlMultiData = "SELECT `user`,`address` FROM `$dbName`.`$tbName` WHERE `status`='0'";
	
	$conn = mysql_connect($host ,$user,$pass);
	$data = mysql_query($mysqlMultiData) or die(mysql_error());
	mysql_close($conn);

	if(mysql_num_rows($data) > 0){
	$num = 1;
	while($dataArray = mysql_fetch_array($data)){
	$myName = $dataArray['user'];
	$myEmail = $dataArray['address'];

	echo "Hey we found record: ".$num."<BR>";
	echo "Name: " . $myName . "<BR>";
	echo "Email: " . $myEmail . "<p>";
	$num++;
	}
	} else { 
		echo "Empty result - Please try later";
	}
}
?>
</body>
</html>
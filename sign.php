<?php
if(!isset($_SESSION)){
		session_start();
}

$db = mysqli_connect('localhost','root','','test')
 or die('Error connecting to MySQL server.');

$fristname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$re_password = $_POST['password2'];

$_SESSION["name"] = $fristname." ".$lastname;
$_SESSION["database"] = $fristname;
if($password == $re_password){
	$query = "INSERT INTO users
		(`Fname`,`Lname`,`Email`,`Password`) 
			VALUES 
		('$fristname','$lastname','$email','$password')";

$result = mysqli_query($db,$query) or die('Error querying database.');
	$query2 = "CREATE TABLE ".$fristname."business_no (
				id int(10) NOT NULL AUTO_INCREMENT,
				word VARCHAR(30),
				count INT(10),
				PRIMARY KEY (id))";
mysql_select_db( 'test' );
$result2 = mysqli_query($db,$query2) or die('Error querying database21.');
	$query4 = "CREATE TABLE ".$fristname."business_yes (
				id int(10) NOT NULL AUTO_INCREMENT,
				word VARCHAR(30),
				count INT(10),
				PRIMARY KEY (id))";
				
$result4 = mysqli_query($db,$query4) or die('Error querying database22.');
	$query2 = "CREATE TABLE ".$fristname."everyday_no (
				id int(10) NOT NULL AUTO_INCREMENT,
				word VARCHAR(30),
				count INT(10),
				PRIMARY KEY (id))";
$result2 = mysqli_query($db,$query2) or die('Error querying database31.');
	$query4 = "CREATE TABLE ".$fristname."everyday_yes (
				id int(10) NOT NULL AUTO_INCREMENT,
				word VARCHAR(30),
				count INT(10),
				PRIMARY KEY (id))";
$result4 = mysqli_query($db,$query4) or die('Error querying database32.');
				
	$query2 = "CREATE TABLE ".$fristname."tecnical_no (
				id int(10) NOT NULL AUTO_INCREMENT,
				word VARCHAR(30),
				count INT(10),
				PRIMARY KEY (id))";
$result2 = mysqli_query($db,$query2) or die('Error querying database41.');
	$query4 = "CREATE TABLE ".$fristname."tecnical_yes (
				id int(10) NOT NULL AUTO_INCREMENT,
				word VARCHAR(30),
				count INT(10),
				PRIMARY KEY (id))";
$result4 = mysqli_query($db,$query4) or die('Error querying database42.');			
				
ini_set('max_execution_time', 300);
set_time_limit(0);

$query3 ="INSERT INTO ".$fristname."business_no  SELECT * FROM business";
mysqli_multi_query($db,$query3);
$query3 ="INSERT INTO ".$fristname."everyday_no  SELECT * FROM everyday";
mysqli_multi_query($db,$query3);
$query3 ="INSERT INTO ".$fristname."tecnical_no  SELECT * FROM tecnical";
mysqli_multi_query($db,$query3);

mysqli_close($db);
echo "<script type='text/javascript'>
		alert('Succesfuly add person');
		
 		</script>";
 		include("home.html");
}else{
	require_once 'register.php';
	echo '<script type="text/javascript">
		document.getElementById("pass2").style.borderColor = "red";
		document.getElementById("pass2").style.borderStyle = "solid";
 		</script>';
	
}

?>



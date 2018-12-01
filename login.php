<?php
session_start();
?>
<?php
$db = mysqli_connect('localhost','root','','project')
 or die('Error connecting to MySQL server.');

$name = $_POST['username'];
$password = $_POST['Password'];

$query = "SELECT * FROM Admin WHERE Name ='$name' AND Password ='$password'";
$result = mysqli_query($db,$query) or die('Error querying database.');
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$s1 = $row['Name'];

if($s1==""){
	echo "<script type='text/javascript'>
		alert('Error');
		</script>";
 		require_once 'loginto.php';
}else{
	$_SESSION['name'] = $s1;
	include("Home.php");
		
}
mysqli_close($db);
	
?>



<html style="background-image:url( images/389875.jpg);">
<body>
<?php
$Bname=$_POST["searchfield"];
$con=mysqli_connect("localhost","root","","project");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM reference_material WHERE `Title` LIKE '%$Bname%' OR `BookID` LIKE '%$Bname%'";
$result = mysqli_query($con,$sql);

//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//echo mysqli_num_rows($result);
while($row = $result-> fetch_array()){
	$s1 = $row['Title'];
	$s2 = $row['Author'];
	$s3 = $row['BookID'];
	$s4 = $row['LendingOption'];
	$s5 = $row['Avalibility'];
	$s6 = $row['Catogery'];
	if($s4==1){
		$Lending='Lending';
	}else{
		$Lending='Refer';
	}

	if($s1 == null){
		echo "<script type='text/javascript'>
			alert('Book Not Found');
			</script>";
		require_once 'index.html';
	}else{
		echo "
			<style type='text/css'>
			h1{
				font-size:45px;
			}
			#table th{
				width:400px;
				height:40px;
				color:white;
				font-size:25px;	
			}
			#table td{
				width:300px;
				height:40px;
				color:white;
				font-size:25px;	
			}
			#div1{
			background-color: rgba(212, 126, 92, 0.41);
			margin:50px 10px 10px 340px; 
			width:600px;
			height:550px; 
			border:3px solid; 
			padding-left:50px;
			color: aliceblue;
			
			}
			</style>
			<div id='div1'>
			<h1><ins>Details of Reference material</ins></h1>
			<table style='text-align:left;padding-top: 60px;' id='table'>
				<tr>
					<th>Title :</th>
					<td>$s1</td>
				</tr>
				<tr>
					<th>Author:</th>
					<td>$s2</td>
				</tr>
				<tr>
					<th>BookID :</th>
					<td> $s3</td>
				</tr>
				<tr>
					<th>Lending Option(Lending or Refer): </th>
					<td> $Lending</td>
				</tr>
				<tr>
					<th>Number of Book Availibility: </th>
					<td> $s5</td>
				</tr>
				<tr>
					<th>Category : </th>
					<td> $s6</td>
				</tr>
				 
			</table>
			<div>
				<form action='index.html'>
						<input type='submit' value='Home' name='home' style='
											margin: 50px 0 0 150px;
											width: 250px;
											height: 50px;
											background-color: rgba(0, 0, 0, 0.39);
											color:white;
											font-size:30px;

						'>
					</form>
			</div>
			</div>
			 


		";
		}


	}

mysqli_close($con);
?>
</body>
</html>
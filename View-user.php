<?php require_once('forhome/connection.php'); ?>
<?php if(!isset($_SESSION)){
		session_start();}		
?>
<?php
	if(!isset($_SESSION['name'])){
		header('Location: index.html');
	}

	$header_name ='hi';

	if(isset($_POST['view_user'])){

		$user_id = $_POST['user_id'];
		// Select user data
		$query01  = "SELECT * FROM  library_user WHERE IDNUM ='{$user_id}'";
		$result01 = mysqli_query($connection, $query01);
		$row = mysqli_fetch_assoc($result01);
		$header_name = $row['Fname'].' '.$row['Lname'];
		// Get user book Usage
		$query02  = "SELECT * FROM  borrow WHERE UserID ='{$user_id}'";
		$result02 = mysqli_query($connection, $query02);

	}

	if(isset($_POST['view_book'])){

		$book_id = $_POST['book_id'];
		// Select book data
		$query01  = "SELECT * FROM  reference_material WHERE BookID ='{$book_id}'";
		$result01 = mysqli_query($connection, $query01);
		$row = mysqli_fetch_assoc($result01);
		$header_name = $row['Title'];
		// Get user book Usage
		$query02  = "SELECT * FROM  borrow WHERE BookID ='{$book_id}'";
		$result02 = mysqli_query($connection, $query02);

	}
	
?>

<!doctype html>  
 
<html lang="en-us"><!--  -->
<head>
	<title>Library</title>
	<link rel="stylesheet" href="css/documenter_style.css" media="all">

	<script>document.createElement('section');var duration=500,easing='swing';</script>
	<script src="js/script.js"></script>
	
	<style>
		html{background:#444444;color:#DDDDDD; }
		::-moz-selection{background:#444444;color:#DDDDDD;}
		::selection{background:#444444;color:#DDDDDD;}
		a{color:#0000FF;}
		hr{border-top:1px solid #EBEBEB;border-bottom:1px solid #FFFFFF;}
		.documenter_sidebar, .documenter_sidebar ol a{ background-image:url(images/444824.jpg);}
		.documenter_sidebar ol{border-top:1px solid #AAAAAA;}
		.documenter_sidebar ol a{border-top:1px solid #EEEEEE;border-bottom:1px solid #AAAAAA;}
		.nav-pills>li.active>a{background: #4d0aeaba;}
		.documenter_sidebar ol a:hover{background:#1518F2;color:#DDDDDD;border-top:1px solid #444444;}
		#documenter_copyright{display:block !important;visibility:visible !important;}
	</style>
	
</head>
<body>
	<div class="documenter_sidebar">
		<a href="#documenter_cover" id="documenter_logo">LbMS</a>
		<ol id="documenter_nav">
			<li><p><img src="images/user.jpg" alt="user_photo"></p>
				<p  id="username"><span><?php echo $_SESSION['name']; ?></span><a href="logout.php"><button>Log out</button></a></p>
			</li>
			<li><a href="home.php#documenter_cover">Home</a></li>
			<li><a href="home.php#barrow">Barrow Book</a></li>
			<li><a href="home.php#about">Return Book</a></li>
			<li><a href="home.php#add_book">Add Book</a></li>
			<li><a href="home.php#add_person">Add Person</a></li>
			<li><a href="home.php#add_book">Reduce Panelty</a></li>
			<li><a href="home.php#remove">Remove Book / Person</a></li>
			 

		</ol>
		<div id="documenter_copyright"> 
		
		</div>
	</div>
	<div id="documenter_content">
	<section id="view">
		<h3><?php echo $header_name; ?></h3><hr class="notop">
		<form action="Home.php#ViewUser" method="post">
			<div id="left_part">
				<img src="images/avatar.png"/>
				<table>
				<?php
					if(isset($_POST['view_user'])){
						echo "<tr><th>User ID    </th><td>:</td><td>".$user_id."</td></tr>";
						echo "<tr><th>Address    </th><td>:</td><td>".$row['Address']."</td></tr>";
						echo "<tr><th>Gender     </th><td>:</td><td>".$row['Sex']."</td></tr>";
						echo "<tr><th>Tel. Number</th><td>:</td><td>".$row['Contact']."</td></tr>";
						echo "<tr><th>Reg. Date  </th><td>:</td><td>".$row['RegisteredDate']."</td></tr>";
					}elseif (isset($_POST['view_book'])) {
						echo "<tr><th>Book ID    </th><td>:</td><td>".$book_id."</td></tr>";
						echo "<tr><th>Publisher ID</th><td>:</td><td>".$row['PublisherID']."</td></tr>";
						echo "<tr><th>Author     </th><td>:</td><td>".$row['Author']."</td></tr>";
						echo "<tr><th>Catogery</th><td>:</td><td>".$row['Catogery']."</td></tr>";
						echo "<tr><th>Available Books </th><td>:</td><td>".$row['Avalibility']."</td></tr>";
					}
				 ?>
				</table>
			</div>
			<div id="right_part">
				<table>
					<tr>
						<th>ID Number</th>
						<th>IssueDate</th>
						<th>ReturnDate</th>
					</tr>
					<?php 
					if(isset($_POST['view_user'])){
						while ($row02 = mysqli_fetch_assoc($result02)) {
							if($row02['Returned'] == 'No'){
								echo "<tr style=\"background:green;\">";
								echo "<td>".$row02['BookID']."</td>";
								echo "<td>".$row02['IssueDate']."</td>";
								echo "<td>".$row02['ReturnDate']."</td>";
								echo "</tr>";
							}else{
								echo "<tr style=\"background:red;\">";
								echo "<td>".$row02['BookID']."</td>";
								echo "<td>".$row02['IssueDate']."</td>";
								echo "<td>".$row02['ReturnDate']."</td>";
								echo "</tr>";
							}
							
						}
					}
					if(isset($_POST['view_book'])){
						while ($row02 = mysqli_fetch_assoc($result02)) {
							if($row02['Returned'] == 'No'){
								echo "<tr style=\"background:green;\">";
								echo "<td>".$row02['UserID']."</td>";
								echo "<td>".$row02['IssueDate']."</td>";
								echo "<td>".$row02['ReturnDate']."</td>";
								echo "</tr>";
							}else{
								echo "<tr style=\"background:red;\">";
								echo "<td>".$row02['UserID']."</td>";
								echo "<td>".$row02['IssueDate']."</td>";
								echo "<td>".$row02['ReturnDate']."</td>";
								echo "</tr>";
							}
							
						}
					}

				 ?>	
				</table>
				
			</div>
		  </form>
	</section>
 </div>
	<div id="documenter_sidebar2">
		 
		<div id="documenter_copyright"> 
		
		</div>
	</div>
</body>
</html>
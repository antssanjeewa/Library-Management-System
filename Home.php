<?php require_once('forhome/connection.php'); ?>
<?php if(!isset($_SESSION)){
		session_start();}		
?>
<?php
	if(!isset($_SESSION['name'])){
		header('Location: index.html');
	}

	$query01 = "SELECT BookID FROM reference_material WHERE Avalibility > 0 ";
	$result01 = mysqli_query($connection, $query01);
	if(!$result01){
		echo "error reference_material";
	}
	$query02 = "SELECT IDNUM FROM library_user WHERE Is_deleted=0";
	$result02 = mysqli_query($connection, $query02);
	if(!$result02){
		echo "error library_user";
	}

	$query03 = "SELECT * FROM borrow WHERE Returned='No'";
	$result03 = mysqli_query($connection, $query03);
	if(!$result03){
		echo "error library_user";
	}else{
		$borrowbook = array();
		$borrowusers = array();

		while ($row = mysqli_fetch_assoc($result03)) {
			$borrowbook[] = $row['BookID'];
			$borrowusers[] = $row["UserID"];
		}
		$borrowbook = array_unique($borrowbook);
		$borrowusers = array_unique($borrowusers);
	}

	$query04 = "SELECT PublisherID FROM publisher";
	$result04 = mysqli_query($connection, $query04);
	if(!$result04){
		echo "error library_user";
	}
	
?>
<!doctype html>  
 
<html lang="en-us"><!--  -->
<head>
	<title>Library</title>
	<link rel="stylesheet" href="css/documenter_style.css" media="all">
	<script>document.createElement('section');var duration=500,easing='swing';</script>
	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
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
<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">
	<div class="documenter_sidebar">
		<a href="#documenter_cover" id="documenter_logo">LbMS</a>
		<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">

		<nav id="myScrollspy">
			<ol class="nav nav-pills nav-stacked">
				<li><p><img src="images/user.jpg" alt="user_photo"></p>
					<p  id="username"><span><?php echo $_SESSION['name']; ?></span><a href="logout.php"><button>Log out</button></a></p>
				</li>
				<li><a href="#documenter_cover">Home</a></li>
				<li><a href="#barrow">Barrow Book</a></li>
				<li><a href="#about">Return Book</a></li>
				<li><a href="#add_book">Add Book</a></li>
				<li><a href="#add_person">Add Person</a></li>
				<li><a href="#">Reduce Panelty</a></li>
				<li><a href="#remove">Remove Book / Person</a></li>
			</ol>
		</nav>
		<div id="documenter_copyright"> 
		
		</div>
	</div>
	<div id="documenter_content">

	<!-- Home start Section-->
	<section id="documenter_cover"><h1>WelCome</h1><br />
		<h2>to</h2>
		<h2>Library Details</h2><br />
		<p style="
	    text-align: center;
	    background-color: #080808ba;
	    padding: 20px;">
			This is for the use of the Librarian and the authorized personel only. You can add a person, a book.

		</p>
		<div id="ViewUser">
		<form action="View-user.php" method="post" target="_blank">
			<table style="margin: 50px auto;" class="view">
				 <tr>
					<td>View Detais of Persons</td>
					<td></td>
					<td></td>
					<td>View Detais of Books</td>
				</tr>
				<tr>
					<td><input list="users" name="user_id" autocomplete="off" placeholder="Enter User ID"/>
							  <datalist id="users">
							  	<?php 
							  		while ($row = mysqli_fetch_assoc($result02)) {
							  			echo '<option value=';
							  			echo $row["IDNUM"];
							  			echo '>';
							  		}
							  	 ?>
							  </datalist> 
					</td>
					<td> <button type="submit" name="view_user" class="button button-block"/>View</button></td>
					<td><pre>       	</pre></td>
					<td><input list="Books" name="book_id" autocomplete="off" placeholder="Enter Book ID"/>
							  <datalist id="Books">
							  	<?php 
							  		while ($row = mysqli_fetch_assoc($result01)) {
							  			echo '<option value=';
							  			echo $row["BookID"];
							  			echo '>';
						  			}
						  	 	?>
							  </datalist> 
					</td>
					<td> <button type="submit" name="view_book" class="button button-block"/>View</button></td>
				</tr>
			 </table>
		</form>
		</div>
	
	</section>

	<!-- Book Borrow Section-->
	<section id="barrow">
	<h3>Barrow Book</h3><hr class="notop">
		<form action="forhome/barrow.php" method="post">
		<table>
			<tr>
				<td>Book ID</td>
				<td><input list="Books" name="book_id" required autocomplete="off" placeholder="Book ID"/>
				</td>
			</tr>
			<tr>
				<td>User ID</td>
				<td><input list="users" name="user_id" required autocomplete="off" placeholder="User ID"/>
						  <datalist id="users">
						  	<?php 
						  		while ($row = mysqli_fetch_assoc($result02)) {
						  			echo '<option value=';
						  			echo $row["IDNUM"];
						  			echo '>';
						  		}
						  	 ?>
						  </datalist> 
				</td>
			</tr>
			<tr>
				<td>Return Date</td>
				<td> <input type="date" name="return_date" required autocomplete="off" placeholder="Date"/></td>
			</tr>
			 <tr>
				<td></td>
				<td></td>
				<td> <button type="submit" name="borrow_submit" class="button button-block">Enter</button></td>
			</tr>
		 </table>
		  </form>
	</section>
	
	<!-- Return Book Section-->
	<section id="about">
		<h3>Return Book</h3><hr class="notop">
		<form action="forhome/barrow.php" method="post">
		<table>
			<tr>
				<td>Book ID</td>
				<td><input list="books2" name="book_id" required autocomplete="off" placeholder="Book ID"/>
						  <datalist id="books2">
						  	<?php 
						  		foreach($borrowbook as $x => $value) {
						  			echo '<option value=';
						  			echo $value;
						  			echo '>';
						  		}
						  	 ?>
						  </datalist> 
				</td>
			</tr>
			<tr>
				<td>User ID</td>
				<td><input list="users2" name="user_id" required autocomplete="off" placeholder="User ID"/>
						  <datalist id="users2">
						  	<?php 
						  		foreach($borrowusers as $x => $value) {
						  			echo '<option value=';
						  			echo $value;
						  			echo '>';
						  		}
						  	?>
						  </datalist> 
				</td>
			</tr>
			 <tr>
				<td></td>
				<td></td>
				<td> <button type="submit" name="return_submit" class="button button-block"/>Enter</button></td>
			</tr>
		</table>
		</form>
	</section>

	<!-- Add Book Section-->
	<section id="add_book">
		<h3>Add Book</h3><hr class="notop">
		<form action="forhome/barrow.php" method="post">
			<table>
				<tr>
					<td>Reference Material ID</td>
					<td> <input type="text" name="BookID" required autocomplete="off" placeholder="Book ID"/></td>
			    </tr>
				<tr>
					<td>Publisher ID</td>
					<td><input list="publisher" name="PublisherID" required autocomplete="off" placeholder="Publisher ID"/>
						 <datalist id="publisher">
						  	<?php 
						  		while ($row = mysqli_fetch_assoc($result04)) {
						  			echo '<option value=';
						  			echo $row["PublisherID"];
						  			echo '>';
						  		}
						  	 ?>
						 </datalist> 
					</td>
				</tr>
				<tr>
					<td>Title</td>
					<td> <input type="text" name="Title" required autocomplete="off" placeholder="Title"/></td>
				</tr>
				<tr>
					<td> Author</td>
					<td><input type="text" name="Auther" required autocomplete="off" placeholder="Author"/></td>
				</tr>
				<tr>
					<td>Category</td>
					<td><input list="Category" name="Category" required autocomplete="off" placeholder="Category Name"/>
						 <datalist id="Category">
						  	<option value="Computer Engineering">
						  	<option value="Civil Engineering">
						  	<option value="Mechanical Engineering">
						  	<option value="Production Engineering">
						  	<option value="Chemical Engineering">
						  	<option value="Electrical Engineering">
						 </datalist> 
					</td>
				</tr>
				<tr>
					<td>Avalibility</td>
					<td> <input type="number" name="Avalibility" required autocomplete="off" placeholder="Enter Number Of Books"/></td>
				</tr>
				<tr>
					<td>Lending Option</td>
					<td> <input type="radio" name="LOpt" value="1" required>Lending
						<input type="radio" name="LOpt" value="0" required/>Refer</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td> <button type="submit" name="add_submit" class="button button-block"/>Enter</button></td>
				</tr>
			</table>
		</form>
	</section>

	<!-- Add Person Section-->
	<section id="add_person">
		<h3>Add Person</h3><hr class="notop">
	 	<form action="forhome/barrow.php" method="post">
			<table>
				<tr>
					<td>User ID</td>
					<td> <input type="text" name="UserID" maxlength="6" required autocomplete="off" placeholder="Enter User ID"/></td>
				</tr>
				<tr>
					<td>First Name</td>
					<td> <input type="text" name="Fname" required autocomplete="off" placeholder="Enter First Name"/></td>
				</tr>
				<tr> 
					<td>Last Name</td>
					<td><input type="text" name="Lname" required autocomplete="off" placeholder="Enter Last Name"/></td>
				</tr>
				<tr>
					<td style="vertical-align: top;">Address</td>
					<td> <textarea name="Address" required autocomplete="off" placeholder="Enter Address" rows="5" cols="33"></textarea></td>
				</tr>
				<tr>
					<td>Contact Number</td>
					<td> <input type="text" pattern="[0-9]{10}" name="CNumber" required autocomplete="off" placeholder="Enter Contact Number"/></td>
				</tr>
				<tr>
					<td>Sex</td>
					<td> <input type="radio" name="Sex" value="Male" required>Male
						<input type="radio" name="Sex" value="Female" required/>Female</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td> <button type="submit" name="add_person" class="button button-block"/>Enter</button></td>
				</tr>
			 </table>
			  </form>
	 
	</section>

	<section id="remove">
		<h3>Remove Book / Person</h3><hr class="notop">
		<form action="forhome/barrow.php" method="post">
			<table style="margin-top: 200px;">
				 <tr>
					<td>Enter The Book or Person ID</td>
				</tr>
				<tr>
					<td><input list="users" name="delete" required autocomplete="off" placeholder="Enter The ID"/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td> <button type="submit" name="remove" class="button button-block"/>Enter</button></td>
				</tr>
			</table>
		 </form>
	</section>

 </div>
	<div id="documenter_sidebar2">
		 
		<div id="documenter_copyright"> 
		
		</div>
	</div>
</body>
</html>
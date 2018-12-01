<?php require_once('connection.php'); ?>
<?php if(!isset($_SESSION)){
		session_start();}		
?>
<?php 
	echo print_r($_POST);
	// Borrow Book Section

	if(isset($_POST['borrow_submit'])){
		$book_id     = $_POST['book_id'];
		$user_id     = $_POST['user_id'];
		$return_date = $_POST['return_date'];
		
		//add detais to borrow table
		$query  = "INSERT INTO borrow (IssueDate, BookID, UserID, ReturnDate) VALUES (CURRENT_DATE(), '{$book_id}', '{$user_id}', '{$return_date}')";

		$result = mysqli_query($connection, $query);
		if($result){

			//get Availability value for book
			$query01  = "SELECT Avalibility FROM reference_material WHERE BookID = '{$book_id}'";
			$result01 = mysqli_query($connection, $query01);
			$row = mysqli_fetch_assoc($result01);
			$value = $row['Avalibility'];
			$value -= 1; 
			//Descrease reference_material book availability
			$query02  = "UPDATE reference_material SET Avalibility = '{$value}' WHERE BookID = '{$book_id}'";

			$result02 = mysqli_query($connection, $query02);
			if($result02){
				header('Location: ../home.php?updated');
			}else{
				echo "error query02";
			}
		}else{
			echo "error query";
		}
	}

	// Return Book Section

	if(isset($_POST['return_submit'])){
		$book_id     = $_POST['book_id'];
		$user_id     = $_POST['user_id'];
		
		//update to borrow table
		$query  = "UPDATE borrow SET Returned='Yes' WHERE BookID='{$book_id}' AND UserID='{$user_id}' LIMIT 1";

		$result = mysqli_query($connection, $query);
		if($result){

			//get Availability value for book
			$query01  = "SELECT Avalibility FROM reference_material WHERE BookID = '{$book_id}'";
			$result01 = mysqli_query($connection, $query01);
			$row = mysqli_fetch_assoc($result01);
			$value = $row['Avalibility'];
			$value += 1; 
			//Descrease reference_material book availability
			$query02  = "UPDATE reference_material SET Avalibility = '{$value}' WHERE BookID = '{$book_id}'";

			$result02 = mysqli_query($connection, $query02);
			if($result02){
				header('Location: ../home.php?updated');
			}else{
				echo "error query02";
			}
		}else{
			echo "error query";
		}
	}

	// Add Book Section
	if(isset($_POST['add_submit'])){

		$bookID=$_POST['BookID'];
		$PubliserID=$_POST['PublisherID'];
		$Title=$_POST['Title'];
		$Auther=$_POST['Auther'];
		$Category=$_POST['Category'];
		$Avalibility=$_POST['Avalibility'];
		$LOpt=$_POST['LOpt'];

		$query = "INSERT INTO reference_material
				(BookID, PublisherID, Title, Author, LendingOption, Catogery, Avalibility)
				VALUES 
				('{$bookID}','{$PubliserID}', '{$Title}', '{$Auther}', '{$LOpt}', '{$Category}', '{$Avalibility}')";

		$result = mysqli_query($connection, $query) or die('Error querying database.');
		echo "<script type='text/javascript'>
				alert('Succesfuly add person');
				
		 		</script>";
		header('Location: ../home.php?updated');
	}

	// Add Person Section
	if(isset($_POST['add_person'])){

		$UserID=$_POST['UserID'];
		$Fname=$_POST['Fname'];
		$Lname=$_POST['Lname'];
		$sex=$_POST['Sex'];
		$Add=$_POST['Address'];
		$Pno=$_POST['CNumber'];

		$query = "INSERT INTO library_user
				(IDNUM, Fname, Lname, Sex, Address, Contact,RegisteredDate) 
					VALUES 
				('{$UserID}', '{$Fname}', '{$Lname}', '{$sex}', '{$Add}', '{$Pno}', CURRENT_DATE())";

		$result = mysqli_query($connection, $query) or die('Error querying database.');

		

		echo "<script type='text/javascript'>
				alert('Succesfuly add person');
				
		 		</script>";
		header('Location: ../home.php?updated');
	}

	// Add Person Section
	if(isset($_POST['remove'])){

		$UserID = $_POST['delete'];
		$query02  = "UPDATE library_user SET Is_deleted=1 WHERE IDNUM = '{$UserID}'";

		$result02 = mysqli_query($connection, $query02) or die('Error querying database.');

		echo "<script type='text/javascript'>
				alert('Succesfuly remove person');
				
		 		</script>";
		header('Location: ../home.php?updated');
	}

	mysqli_close($connection);

 ?>

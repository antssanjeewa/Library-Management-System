<!DOCTYPE html>
<html>
<head>
	<title>Register,login and logout user php mysql</title>
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	<div id="header">
			<div id="logo">
				<a href="index.html"><img src="images/Lib1.png" alt="LOGO"></a>
			</div>
	</div>
	<h2>Log In an Existing Account</h2>
<form method="post" action="login.php">
	<table>
		<tr>
			<td><input type="text" name="username" required autocomplete="off" class="textInput" placeholder="User Name "></td>
		</tr>
		<tr>
			<td><input type="Password" required autocomplete="off" name="Password" class="textInput" placeholder="Password"></td>
		</tr>
	<tr>
		<td>
			<br>
			<a href="#">Forget Password..?</a>
		</td>
	</tr>
		<tr>
			<td><input type="submit" name="login_btn" value="Log IN"></td>
		</tr>
	</table>
</form>
</body>
</html>

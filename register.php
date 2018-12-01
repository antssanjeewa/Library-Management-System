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

	<h2>Create an Account</h2>
<form method="post" action="sign.php">
	<table>
		<tr>
			<td><input type="text" required autocomplete="off" name="firstname" class="textInput" placeholder="First Name "></td>
		</tr>
		<tr>
			<td><input type="text" required autocomplete="off" name="lastname" class="textInput" placeholder="Last Name"></td>
		</tr>
    <tr>
			<td><input type="email" required autocomplete="off" name="email" class="textInput" placeholder="Email Address"></td>
		</tr>
		<tr>
			<td><input type="Password" required autocomplete="off" name="password" class="textInput" placeholder="Password " id="pass1"></td>
		</tr>
		<tr>
			<td><input type="Password" required autocomplete="off" name="password2" class="textInput" placeholder="Password agian " id="pass2"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="register_btn" value="Sign up"></td>
		</tr>
	</table>
</form>
</body>
</html>

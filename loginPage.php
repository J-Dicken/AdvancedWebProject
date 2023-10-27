<?php 
	session_start();
	//Redirect if user is logged in already
	if (isset($_SESSION["user"])){
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="styles.css">
	<title>Ohm Electrical: Customer Log In</title>
</head>
<body>
	<?php require "header.php" ?>
	<div id="formContainer">
			<form id="form" action="login.php" method="post">
				<label for="email">Email
				<input type="text" id="email" name="email" placeholder="Email address" required></label>
				<label for="password">Password
				<input type="password" id="password" name="password" placeholder="Password" required></label>
				<input type="submit" value="Log In" id="subBtn">

				<span><a href="index.php">Return Home</a></span>

				<?php
				//Sets errString based on err code received by GET then echos to a span with error icon			
					if (isset($_GET["err"])){
						$errString;
						switch ($_GET["err"]){
							case 0:
								$errString = "Username or password not entered!";
								break;
							case 1:
								$errString = "Invalid username or password!";
								break;
							default:
								$errString = "Unknown Error!";
								break;
						}

						echo "<br><span>" . $errString . "</span>";
					}
				?>
			</form>						
		</div><!-- End of logInContainer div -->
</body>
</html>
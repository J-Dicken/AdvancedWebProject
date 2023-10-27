<?php
	session_start();
	require "config.php";
 	//Run all user input through htmlspecial chars to help prevent xss
	$usr = htmlspecialchars($_POST["email"]);
	$name = htmlspecialchars($_POST["name"]);
	$phone = htmlspecialchars($_POST["phone"]);
	$pass = htmlspecialchars(hash('sha256', $_POST["password"]));
	//Validate email before running through db
	if (filter_var($usr, FILTER_VALIDATE_EMAIL)){
		$sql = "select * from USERS where email = '$usr'";
		$result = $dbo->prepare($sql);
		$result->execute();
		$result = $result->fetch(PDO::FETCH_ASSOC);
		

		if ($result){
			if ($_POST["email"] == $result['email']){
				echo 0; //Signifying user exists
			}
		} else{
			$sql = "INSERT INTO USERS (name, email, tel , password) VALUES (?,?,?,?)";
			$result = $dbo->prepare($sql);
			$result->execute([$name, $usr, $phone, $pass]);
			$_SESSION["user"] = $usr;
			$_SESSION["name"] = $name;
			$_SESSION["phone"] = $phone;
			echo 1; //User successfully added
		}
	} else{
		echo 2; //Invalid email address
	}
?>
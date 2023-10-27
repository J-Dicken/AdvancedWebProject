<?php
	session_start();
	require "config.php";
	$src = '';
	//If no data has been entered, return to logInPage with err 0
	if (empty($_POST["email"])||empty($_POST{"password"})){
		$src = "loginPage.php?err=0";
 	} else {//Rest of code only executes if input is not empty
 		$usr = $_POST["email"];
 		if (filter_var($usr, FILTER_VALIDATE_EMAIL)){
	 		$sql = "select * from USERS where email = '$usr'";
	 		$result = $dbo->prepare($sql);
			$result->execute();
			$result = $result->fetch(PDO::FETCH_ASSOC);
			

			if ($result){
				if (($_POST["email"] == $result['email']) && (hash('sha256', $_POST["password"]) == $result['password'])){
					$_SESSION['user'] = $result['email'];
					$_SESSION["name"] = $result["name"];
					$_SESSION["phone"] = $result["tel"];
					$src = "index.php";

				} else{
					$src = "loginPage.php?err=1";
				}
			} else{
				$src = "loginPage.php?err=1";
			}
		} else{
			$src = "loginPage.php?err=1";
		}
 	}
 	header("Location: $src");
?>
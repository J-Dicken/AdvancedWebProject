<?php
	session_start();
	require "config.php";
	$itemId = $_GET["id"];
	$price = $_GET["price"];
	$sql = "INSERT INTO ORDERS (email, name, tel, productId, price) VALUES (?,?,?,?,?)";
	$result = $dbo->prepare($sql);
	$result->execute([$_SESSION["user"], $_SESSION["name"], $_SESSION["phone"], $itemId, $price]);
	echo '<script>alert("Order successful! Orders can be viewed of your order page.")</script>';
	echo '<script>window.location.replace("index.php")</script>';
?>


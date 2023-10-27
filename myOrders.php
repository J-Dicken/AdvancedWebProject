<?php 
	session_start();
	if (!isset($_SESSION['user'])){
		header("Location: index.php"); //Prevents navigation to here when not logged in
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ohm Elctrical: My orders</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php 
		require "header.php";
		require "config.php";
	?>
	<div id="ordersWrapper">
		<h1>Your Orders</h1>
		<table>
			<tr>
				<th>Order Reference</th>
				<th>Product</th>
				<th>Price</th>
			</tr>
			<?php
				$email = $_SESSION['user'];
				$query="select orders.*, products.name from orders inner join products on orders.productID=products.id where email = '";
				$query = $query . $email. "'";
				foreach ($dbo->query($query) as $row) {
					echo "<tr>";
					echo "<td>" . $row['orderID'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['price'] . "</td>";
					echo "</tr>";
				}
			?>
		</table>
	</div>
</body>
</html>
<div id="header">
	<h1><a href="index.php">Ohm Electrical</a></h1>
	<div id="userLogin">
		<?php
			if (!isset($_SESSION['user'])){
				echo '<a href="loginPage.php">Log In</a> / <a href="register.php">Register</a>';
			} else{
				echo '<h3>Welcome ' . ucfirst($_SESSION['name']) . '</h3><a href="myOrders.php">My Orders</a><a href="logout.php">Log Out</a>';
			}
		?>
	</div>
</div>
<?php
$id = $_GET["id"];

require "config.php";
error_reporting(0);

/*if((strlen($id)) > 0 and (!ctype_alpha($id))){ 
	echo "Data Error";
exit;
}*/
$query = "select * from products where id='$id'";
$sth = $dbo->prepare($query);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_CLASS);
echo json_encode($result);
?>
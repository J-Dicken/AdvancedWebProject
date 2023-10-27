<?Php
require "config.php";

error_reporting(0);
$dept=$_GET['dept']; 
$brand1=$_GET['brand'];
if((strlen($dept)) > 0 and (!ctype_alpha($dept))){ 
	echo "Data Error";
exit;
}

if ((strlen($brand)) > 0 and ctype_alpha(str_replace(' ', '', $brand)) === false) {
	echo "Data Error";
exit;
}

if (strlen($brand1 <= 0)){
	$query = "select * from products where dept='$dept'";
} else{
	$query = "select * from products where dept='$dept' and brand='$brand1'";
}


$sth = $dbo->prepare($query);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_CLASS);
echo json_encode($result); 
?>
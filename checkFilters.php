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

if(strlen($dept) > 0){
$q_brand="select distinct(brand) from products where dept = '$dept'";
}

$sth = $dbo->prepare($q_brand);
$sth->execute();
$brand = $sth->fetchAll(PDO::FETCH_COLUMN);

$main = array('dept'=>$dept,'brand'=>$brand,'value'=>array("brand1" => $brand1));
echo json_encode($main); 

?>
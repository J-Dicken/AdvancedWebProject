<?Php
$dbhost_name = "localhost"; 
$database = "CHANGE THIS"; //Change to database name on local machine
$username = "root";		//Change to database credentials
$password = "";

try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 
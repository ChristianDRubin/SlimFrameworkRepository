<?php 
function getConnection()
{
	try{
		$db_username = "irso";
		$db_password = "colon34";
		$connection = new PDO("mysql:host=www.xints.com.ar;dbname=irso", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Error de conexion: " . $e->getMessage();
	}
	return $connection;
}
?>
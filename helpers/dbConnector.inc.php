<?php
function db_connect(){
	$host     = 'localhost';       
	$username = 'root';            
	$password = '';      		  
	$dbname = 'book';   	

	$conn = mysqli_connect($host, $username, $password, $dbname);
		if (!$conn) {
			die("Verbindung mit der Datenbank nicht möglich, kontaktieren Sie den Seitenadministrator.");}
	return $conn;}		
?>
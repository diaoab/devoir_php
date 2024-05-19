<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "transactions_bancaires"; 

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("La conection avec base de données a echoue: " . mysqli_connect_error());
}

?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webpage";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Something went wrong");

}

?>
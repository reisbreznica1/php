<?php

include_once("config.php");


if(isset($_POST['submit'])){

$namw = $_POST['name'];

$username = $_POST['username'];

$email = $_POST['email'];

$sql = "INSERT INTO user(name, username, email) VALUES (:name, :username, :email)";

$sqlQuery = $conn->prepare($sql);

$sqlQuery->bindparam(':name', $name);
$sqlQuery->bindparam(':username', $username);
$sqlQuery->bindparam(':email', $email);

$sqlQuery->execute();

echo"INSERTED"
}

?>
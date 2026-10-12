<?php
$host = "localhost";
$user = "root";
$db = "db";
$pass = "";


try{

    $conn = new PDO("mysql:host=$host;dbname=$db" , $user , $pass);

    $sql = "CREATE TABLE test(id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL)";

    $conn->exec($sql);

    echo "connected";

}catch(Exception $e){

echo "not connected ".$e->getMessage();


}




?>
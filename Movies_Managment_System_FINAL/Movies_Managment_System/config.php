
<?php

$user = "root";
$pass = "";
$server = "localhost";
$dbname = "movie";

try {
    $conn = new PDO(
        "mysql:host=$server;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database connection failed.");
}

?>

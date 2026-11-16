
<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['id']) || ($_SESSION['is_admin'] ?? 'false') != 'true') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: bookings.php");
    exit();
}

$id = $_GET['id'];

$sql = "UPDATE bookings SET is_approved = 'false' WHERE id = :id";
$prep = $conn->prepare($sql);
$prep->bindParam(':id', $id);
$prep->execute();

header("Location: bookings.php");
exit();
?>

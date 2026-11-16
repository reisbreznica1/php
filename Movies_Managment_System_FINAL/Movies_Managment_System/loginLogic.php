
<?php

session_start();

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
    header("Location: login.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    die("Please fill in all fields.");
}

$sql = "SELECT id, emri, username, email, password, is_admin
        FROM users
        WHERE username = :username";

$selectUser = $conn->prepare($sql);
$selectUser->bindParam(":username", $username);
$selectUser->execute();

$data = $selectUser->fetch();

if (!$data) {
    die("The user does not exist.");
}

if (password_verify($password, $data['password'])) {

    session_regenerate_id(true);

    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['emri'] = $data['emri'];
    $_SESSION['is_admin'] = $data['is_admin'];

    if ($data['is_admin'] == 1) {
        header("Location: dashboard.php");
    } else {
        header("Location: home.php");
    }

    exit();

} else {
    die("The password is not valid.");
}

?>

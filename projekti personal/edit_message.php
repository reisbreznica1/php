<?php
include 'config.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM messages WHERE id = ?");
$stmt->execute([$id]);

foreach ($stmt as $row) {
    $name = $row['name'];
    $email = $row['email'];
    $message = $row['message'];
}

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("UPDATE messages SET name = ?, email = ?, message = ? WHERE id = ?");
    $stmt->execute([$name, $email, $message, $id]);

    header("Location: messages.php");
    exit;
}
?>

<form method="POST">

    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">

    <label>Message:</label>
    <textarea name="message"><?= htmlspecialchars($message) ?></textarea>

    <button type="submit" name="update">Update</button>

</form>
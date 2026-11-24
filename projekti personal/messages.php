<?php
include 'config.php';

$stmt = $conn->prepare("SELECT * FROM messages");
$stmt->execute();

foreach ($stmt as $row):
?>

    <?= htmlspecialchars($row['name']) ?>

    <a href="edit_message.php?id=<?= $row['id'] ?>">Edit</a>

    <a href="delete_message.php?id=<?= $row['id'] ?>">Delete</a>

<?php endforeach; ?>
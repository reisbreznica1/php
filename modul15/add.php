
<?php
include 'config.php';

$message = "";

if (isset($_POST['add'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if ($name && $description && is_numeric($price)
        && $price > 0 && is_numeric($quantity) && $quantity >= 0) {

        $stmt = $conn->prepare(
            "INSERT INTO product (name, description, sasia, price)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([
            $name,
            $description,
            $quantity,
            $price
        ]);

        $message = "Product added successfully!";

    } else {
        $message = "Please enter valid information!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - My Shop</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
        }

        header {
            background: #202938;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            background: white;
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #16a085;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #117c67;
        }

        .message {
            background: #d9f7e9;
            padding: 12px;
            margin-bottom: 15px;
        }

        a {
            color: #16a085;
            text-decoration: none;
        }
    </style>
</head>

<body>

<header>
    <h1>My Shop 🛍️</h1>
</header>

<div class="container">

    <h2>➕ Add New Product</h2>

    <?php if ($message): ?>
        <div class="message">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Product Name</label>
        <input type="text" name="name"
               placeholder="Enter product name" required>

        <label>Description</label>
        <textarea name="description"
                  placeholder="Enter description"
                  required></textarea>

        <label>Price (€)</label>
        <input type="number" name="price"
               min="0.01" step="0.01"
               placeholder="Enter price" required>

        <label>Quantity</label>
        <input type="number" name="quantity"
               min="0" placeholder="Enter quantity" required>

        <button type="submit" name="add">
            Add Product
        </button>

    </form>

    <br>

    <a href="index.php">← Back to Shop</a>

</div>

</body>
</html>


<?php
session_start();
include 'config.php';

// Default products and prices
$products = [
    ['iPhone 15', 'Apple smartphone with excellent camera.', 799.99, 10],
    ['Samsung Galaxy S24', 'Powerful Android smartphone.', 699.99, 15],
    ['Gaming Laptop', 'High performance gaming laptop.', 1199.99, 5],
    ['Headphones', 'Wireless headphones with clear sound.', 49.99, 30],
    ['Smart Watch', 'Modern smartwatch.', 89.99, 20],
    ['Gaming Mouse', 'RGB gaming mouse.', 29.99, 25],
    ['Keyboard', 'Mechanical gaming keyboard.', 59.99, 18],
    ['Speaker', 'Bluetooth wireless speaker.', 39.99, 22],
    ['iPad', 'Apple tablet.', 499.99, 8],
    ['USB Drive', '64GB USB storage.', 12.99, 50],
    ['Power Bank', 'Portable phone charger.', 24.99, 35],
    ['Monitor', '27 inch gaming monitor.', 229.99, 7],
    ['Wireless Charger', 'Fast wireless charger.', 19.99, 40],
    ['Camera', 'Digital camera.', 349.99, 6],
    ['Backpack', 'Waterproof backpack.', 34.99, 20],
    ['PlayStation 5', 'Gaming console.', 499.99, 8],
    ['Xbox Controller', 'Wireless controller.', 59.99, 15],
    ['Smart TV', '50 inch 4K television.', 599.99, 6],
    ['Air Fryer', 'Modern kitchen fryer.', 79.99, 12],
    ['Coffee Machine', 'Automatic coffee maker.', 99.99, 9],
    ['Office Chair', 'Comfortable office chair.', 149.99, 14],
    ['Running Shoes', 'Comfortable sports shoes.', 69.99, 25],
    ['Sunglasses', 'UV protection sunglasses.', 39.99, 30],
    ['Desk Lamp', 'LED desk lamp.', 29.99, 20],
    ['Microphone', 'USB streaming microphone.', 45.99, 11]
];

// Insert default products and update their prices
$check = $conn->prepare("SELECT id FROM product WHERE name = ?");

$insert = $conn->prepare(
    "INSERT INTO product (name, description, sasia, price)
     VALUES (?, ?, ?, ?)"
);

$updatePrice = $conn->prepare(
    "UPDATE product SET price = ? WHERE name = ?"
);

foreach ($products as $p) {

    $check->execute([$p[0]]);
    $existing = $check->fetch(PDO::FETCH_ASSOC);

    if (!$existing) {

        $insert->execute([
            $p[0],
            $p[1],
            $p[3],
            $p[2]
        ]);

    } else {

        $updatePrice->execute([
            $p[2],
            $p[0]
        ]);
    }
}

// Shopping cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$message = "";

// Add to cart
if (isset($_POST['add'])) {

    $id = (int)$_POST['id'];

    $stmt = $conn->prepare(
        "SELECT * FROM product WHERE id = ?"
    );

    $stmt->execute([$id]);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($p && $p['sasia'] > ($_SESSION['cart'][$id] ?? 0)) {

        $_SESSION['cart'][$id] =
            ($_SESSION['cart'][$id] ?? 0) + 1;

        $message = "Product added to cart!";

    } else {

        $message = "Product is out of stock!";
    }
}

// Remove from cart
if (isset($_POST['remove'])) {

    unset($_SESSION['cart'][(int)$_POST['id']]);

    header("Location: index.php?cart=1");
    exit;
}

// Checkout
if (isset($_POST['checkout'])) {

    $name = trim($_POST['customer_name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    if (
        $name &&
        filter_var($email, FILTER_VALIDATE_EMAIL) &&
        $address &&
        !empty($_SESSION['cart'])
    ) {

        try {

            $conn->beginTransaction();

            foreach ($_SESSION['cart'] as $id => $qty) {

                $stmt = $conn->prepare(
                    "UPDATE product
                     SET sasia = sasia - ?
                     WHERE id = ? AND sasia >= ?"
                );

                $stmt->execute([$qty, $id, $qty]);

                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Not enough stock!");
                }
            }

            $conn->commit();

            $_SESSION['cart'] = [];

            $message = "Thank you, " .
                htmlspecialchars($name) .
                "! Your order was successful.";

        } catch (Exception $e) {

            if ($conn->inTransaction()) {
                $conn->rollBack();
            }

            $message = $e->getMessage();
        }

    } else {

        $message = "Please enter a valid name, email and delivery address!";
    }
}

// Get all products
$allProducts = $conn->query(
    "SELECT * FROM product ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);

$cartPage = isset($_GET['cart']);

$cartCount = array_sum($_SESSION['cart']);

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Shop</title>

<style>

* {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    color: #222;
}

header {
    background: #202938;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

header h2 {
    margin: 0;
}

header div {
    display: flex;
    gap: 10px;
}

header a {
    color: white;
    text-decoration: none;
    background: #16a085;
    padding: 12px;
    border-radius: 5px;
}

.hero {
    background: #16a085;
    color: white;
    text-align: center;
    padding: 40px;
}

.hero h1 {
    font-size: 35px;
}

.container {
    padding: 30px;
    max-width: 1200px;
    margin: auto;
}

.products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.product, .cart {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 12px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.product:hover {
    transform: translateY(-4px);
}

.price {
    color: #16a085;
    font-size: 22px;
    font-weight: bold;
}

button {
    background: #16a085;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background: #117c67;
}

button:disabled {
    background: #aaa;
    cursor: not-allowed;
}

.remove {
    background: #e74c3c;
}

input, textarea {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.message {
    background: #d9f7e9;
    color: #126b4b;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
}

footer {
    background: #202938;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 40px;
}

@media(max-width: 600px) {

    header {
        flex-direction: column;
    }

    header div {
        flex-wrap: wrap;
    }

    .hero h1 {
        font-size: 27px;
    }

}

</style>

</head>

<body>

<header>

    <h2>My Shop</h2>

    <div>

        <a href="index.php">
            Home
        </a>

        <a href="add.php">
            + Add Product
        </a>

        <a href="index.php?cart=1">
            Cart (<?= $cartCount ?>)
        </a>

    </div>

</header>

<div class="hero">

    <h1>Welcome to My Shop!</h1>

    <p>Find your favorite products here.</p>

</div>

<div class="container">

<?php if ($message): ?>

    <div class="message">
        <?= htmlspecialchars($message) ?>
    </div>

<?php endif; ?>


<?php if (!$cartPage): ?>

    <h2>Our Products</h2>

    <div class="products">

    <?php foreach ($allProducts as $p): ?>

        <div class="product">

            <h3>
                <?= htmlspecialchars($p['name']) ?>
            </h3>

            <p>
                <?= htmlspecialchars($p['description']) ?>
            </p>

            <p class="price">
                €<?= number_format((float)$p['price'], 2) ?>
            </p>

            <p>
                Stock: <?= (int)$p['sasia'] ?>
            </p>

            <form method="POST">

                <input type="hidden"
                       name="id"
                       value="<?= (int)$p['id'] ?>">

                <button name="add"
                    <?= $p['sasia'] <= 0 ? 'disabled' : '' ?>>

                    <?= $p['sasia'] > 0
                        ? 'Add to Cart'
                        : 'Out of Stock' ?>

                </button>

            </form>

        </div>

    <?php endforeach; ?>

    </div>


<?php else: ?>

    <div class="cart">

        <h2>Your Shopping Cart</h2>

        <?php foreach ($_SESSION['cart'] as $id => $qty):

            $stmt = $conn->prepare(
                "SELECT * FROM product WHERE id = ?"
            );

            $stmt->execute([$id]);

            $p = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$p) continue;

            $subtotal = (float)$p['price'] * $qty;

            $total += $subtotal;

        ?>

            <h3>
                <?= htmlspecialchars($p['name']) ?>
            </h3>

            <p>Quantity: <?= $qty ?></p>

            <p>
                €<?= number_format($subtotal, 2) ?>
            </p>

            <form method="POST">

                <input type="hidden"
                       name="id"
                       value="<?= (int)$id ?>">

                <button class="remove" name="remove">
                    Remove
                </button>

            </form>

            <hr>

        <?php endforeach; ?>


        <h2>
            Total: €<?= number_format($total, 2) ?>
        </h2>


        <?php if ($cartCount > 0): ?>

            <h2>Checkout</h2>

            <form method="POST">

                <label>Full Name</label>

                <input type="text"
                       name="customer_name"
                       placeholder="Enter your full name"
                       required>

                <label>Email Address</label>

                <input type="email"
                       name="email"
                       placeholder="Enter your email address"
                       required>

                <label>Delivery Address</label>

                <textarea name="address"
                          placeholder="Enter your delivery address"
                          required></textarea>

                <button name="checkout">
                    Place Order
                </button>

            </form>

        <?php else: ?>

            <p>Your cart is empty!</p>

        <?php endif; ?>


        <br>

        <a href="index.php">
            Continue Shopping
        </a>

    </div>

<?php endif; ?>

</div>

<footer>

    <h3>My Shop</h3>

    <p>Thank you for shopping with us!</p>

    <p>© 2026 My Shop. All rights reserved.</p>

</footer>

</body>
</html>

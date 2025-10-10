<?php
session_start();
include 'config/db.php'; // Required to access DB for fetching product name

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If product already in cart, update the quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Fetch product name for the message
    $stmt = $conn->prepare("SELECT name FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    $product_name = $product ? $product['name'] : 'Product';

    // Set a user-friendly message
    $_SESSION['cart_message'] = "✔️ '$product_name' has been added to your cart (Quantity: $quantity).";

    // Redirect back to products page
    header('Location: products.php');
    exit();
}
?>

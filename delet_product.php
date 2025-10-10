<?php
// delete_product.php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete image from folder (optional)
    $sql = "SELECT image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $product = $res->fetch_assoc();

    if ($product && $product['image'] && file_exists("assets/images/" . $product['image'])) {
        unlink("assets/images/" . $product['image']);
    }

    // Delete from DB
    $del = $conn->prepare("DELETE FROM products WHERE id = ?");
    $del->bind_param("i", $id);
    $del->execute();
}

header("Location: dashboard.php");
exit();
?>

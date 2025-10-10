<?php
session_start();
include('includes/header.php');

// Dummy implementation of placing order
if (!isset($_SESSION['user_id']) || !isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}

// Clear cart
unset($_SESSION['cart']);
?>

<div class="container mt-5">
    <div class="alert alert-success">
        <h4 class="alert-heading">Order Placed Successfully!</h4>
        <p>Thank you <strong><?php echo $_SESSION['user_name']; ?></strong> for your order. We'll get it to you soon!</p>
        <hr>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>

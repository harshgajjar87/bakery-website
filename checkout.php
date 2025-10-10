<?php
session_start();
$total = 0;

// Example cart session check
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
} else {
    echo "<h3>Your cart is empty.</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - UPI Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Checkout</h2>
    <p>Total Amount: <strong>₹<?php echo number_format($total, 2); ?></strong></p>

    <h4>Pay via UPI</h4>
    <p>Scan the QR Code using your UPI App (Paytm / PhonePe / Google Pay)</p>
    <img src="images/upi_qr_code.png" width="200" alt="Scan UPI QR Code">
    <p><strong>UPI ID:</strong> yourname@upi</p>

    <form action="order_success.php" method="post" class="mt-4">
        <div class="form-group">
            <label for="txn_id">Enter Transaction ID</label>
            <input type="text" class="form-control" name="txn_id" id="txn_id" required>
        </div>
        <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
        <button type="submit" class="btn btn-primary">Confirm Payment</button>
    </form>
</body>
</html>

<?php
include 'includes/auth_check.php';
include 'config/db.php';
include 'includes/header.php';

// Initialize cart if not already
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle item removal
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
}

// Handle WhatsApp order form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_whatsapp'])) {
    $name = htmlspecialchars(trim($_POST['customer_name']));
    $address = htmlspecialchars(trim($_POST['customer_address']));

    $whatsappMessage = "Hi, I want to place an order:\n";
    $total = 0;

    foreach ($_SESSION['cart'] as $product_id => $qty) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($product = $result->fetch_assoc()) {
            $line_total = $product["price"] * $qty;
            $whatsappMessage .= "- " . $product['name'] . " (₹" . number_format($product['price'], 2) . ") x $qty = ₹" . number_format($line_total, 2) . "\n";
            $total += $line_total;
        }
    }

    $whatsappMessage .= "\nTotal: ₹" . number_format($total, 2);
    $whatsappMessage .= "\n\nCustomer Name: $name\nAddress: $address";

    $encodedMessage = urlencode($whatsappMessage);
    $yourWhatsAppNumber = "+918866319009";
    $whatsappLink = "https://wa.me/$yourWhatsAppNumber?text=$encodedMessage";

    // Store notification in DB
$order_details = '';
foreach ($_SESSION['cart'] as $product_id => $qty) {
    $stmt = $conn->prepare("SELECT name FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($product = $result->fetch_assoc()) {
        $order_details .= $product['name'] . " (x$qty), ";
    }
}
$order_details = rtrim($order_details, ", ");

$insert = $conn->prepare("INSERT INTO order_notifications (customer_name, customer_address, message) VALUES (?, ?, ?)");
$insert->bind_param("sss", $name, $address, $order_details);
$insert->execute();

    header("Location: $whatsappLink");
    exit;
}
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Your Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-info text-center">
            Your cart is empty. <a href="products.php" class="btn btn-sm btn-outline-primary ms-2">Shop Now</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $product_id => $qty) {
                        $sql = "SELECT * FROM products WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $product_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($product = $result->fetch_assoc()) {
                            $subtotal = $product['price'] * $qty;
                            $total += $subtotal;
                            echo '<tr>
                                <td><img src="assets/images/' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" width="80"></td>
                                <td>' . htmlspecialchars($product['name']) . '</td>
                                <td>' . number_format($product['price'], 2) . '</td>
                                <td>' . $qty . '</td>
                                <td>₹' . number_format($subtotal, 2) . '</td>
                                <td><a href="cart.php?remove=' . intval($product['id']) . '" class="btn btn-sm btn-danger">Remove</a></td>
                            </tr>';
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2"><strong>₹<?= number_format($total, 2) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- WhatsApp Order Form -->
        <form method="POST" class="mt-4">
            <!-- <p>Note: If you want to do customization than click on "Order via whatsapp button".</p> -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="customer_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="customer_address" class="form-control" placeholder="Your Address" required>
                </div>
            </div>
            <button type="submit" name="order_whatsapp" class="btn btn-success">Order via WhatsApp</button>
        </form>

        <!-- <div style="text-align: right; margin-top: 10px;">
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a> -->
</div>

    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

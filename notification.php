<?php
session_start();
include 'config/db.php';
include 'includes/header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Incoming WhatsApp Orders</h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Order Details</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM order_notifications ORDER BY created_at DESC");
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td><?= htmlspecialchars($row['customer_address']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr><td colspan="4" class="text-center">No notifications yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>

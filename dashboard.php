<?php
// dashboard.php
include 'includes/auth_check.php';
requireAdmin();
include 'config/db.php';

// Fetch all products
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2>Admin Dashboard</h2>
    <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price (₹)</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['description']); ?></td>
                        <td><?= $row['price']; ?></td>
                        <td>
                            <?php if ($row['image']): ?>
                                <img src="assets/images/<?= $row['image']; ?>" width="80">
                            <?php else: ?>
                                No image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_product.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_product.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this product?')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No products found.</div>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
    <div class="text-end mb-4">
        <a href="admin_upload_gallery.php" class="btn btn-primary">Upload Images in Gallery</a>
    </div>
<?php endif; ?>

</div>
<?php include 'includes/footer.php'; ?>

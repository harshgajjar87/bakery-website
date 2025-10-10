<?php
session_start();
include("includes/header.php");
include("config/db.php");

// Fetch all products
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Our Products</h2>
    <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Product deleted successfully.</div>
<?php endif; ?>

    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($row['image']): ?>
                            <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height:250px; object-fit:cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text fw-bold">₹<?php echo number_format($row['price'], 2); ?></p>

                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                <div class="mt-auto">
                                    <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>


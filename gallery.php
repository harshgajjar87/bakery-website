<?php
include 'config/db.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<div class="container mt-5">
    <h3 class="mb-4 text-center">Gallery</h3>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= $row['image_path'] ?>" class="card-img-top" alt="Gallery Image">
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

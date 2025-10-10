<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['gallery_image'])) {
    $image = $_FILES['gallery_image'];
    $targetDir = "assets/images/";
    $imageName = basename($image['name']);
    $targetPath = $targetDir . $imageName;

    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
        $stmt = $conn->prepare("INSERT INTO gallery (image_path) VALUES (?)");
        $stmt->bind_param("s", $targetPath);
        $stmt->execute();
        $message = "Image uploaded successfully!";
    } else {
        $message = "Image upload failed!";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $res = $conn->query("SELECT image_path FROM gallery WHERE id = $id");
    $row = $res->fetch_assoc();
    if ($row && file_exists($row['image_path'])) {
        unlink($row['image_path']); // Delete from folder
    }
    $conn->query("DELETE FROM gallery WHERE id = $id"); // Delete from DB
    header("Location: admin_upload_gallery.php?deleted=1");
    exit;
}

// Fetch all gallery images
$result = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h3>Gallery Management (Admin)</h3>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-danger">Image deleted successfully.</div>
    <?php endif; ?>

    <!-- Upload form -->
    <form method="post" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <input type="file" name="gallery_image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload Image</button>
    </form>

    <!-- Image List -->
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="<?= $row['image_path'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <a href="admin_upload_gallery.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

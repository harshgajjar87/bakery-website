<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all categories
$cat_result = $conn->query("SELECT id, name FROM categories");

// Handle form submission
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = time() . '_' . $_FILES['image']['name'];
    
    move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/" . $image);

    $sql = "INSERT INTO products (name, description, price, image, category_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $name, $desc, $price, $image, $category_id);
    $stmt->execute();

    $_SESSION['success_message'] = "Product '$name' has been added successfully!";
    header("Location: dashboard.php");
    exit();
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category:</label>
            <select name="category_id" class="form-control" required>
                <?php while ($cat = $cat_result->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-success">Add Product</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>

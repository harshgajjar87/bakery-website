<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit();
}

$product_sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($product_sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit();
}

$cat_result = $conn->query("SELECT id, name FROM categories");

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $product['image'];

    if ($_FILES['image']['name']) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "assets/images/" . $image);
    }

    $update_sql = "UPDATE products SET name=?, description=?, price=?, image=?, category_id=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssdssi", $name, $desc, $price, $image, $category_id, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Category:</label>
            <select name="category_id" class="form-control" required>
                <?php while ($cat = $cat_result->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Image:</label>
            <input type="file" name="image" class="form-control">
            <img src="assets/images/<?= $product['image'] ?>" alt="Product Image" height="80" class="mt-2">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Product</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>

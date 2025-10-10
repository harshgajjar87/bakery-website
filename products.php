<?php
session_start();
include 'config/db.php';
include 'includes/header.php';

$cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : null;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
?>
<!-- <pre><?php print_r($_SESSION); ?></pre> -->

<div class="container mt-5">
    <?php if (isset($_SESSION['cart_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['cart_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['cart_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_name'])): ?>
        <h2 class="mb-4">Hey <?= $_SESSION['user_name']; ?>, welcome to Harsh Cake Zone!</h2>
    <?php else: ?>
        <h2 class="mb-4">Welcome to Harsh Cake Zone!</h2>
    <?php endif; ?>

    <!-- Search and Category Filter -->
    <div class="text-center mb-4">
        <form method="GET" class="d-inline-block mb-3">
            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Search products..." class="form-control d-inline-block w-auto">
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
        <br>
        <form method="GET" class="d-inline-block">
            <select name="cat_id" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
                <option value="">All Categories</option>
                <?php
                $categories = $conn->query("SELECT * FROM categories");
                if (!$categories) {
                    die("Query failed: " . mysqli_error($conn));
                }
                while ($cat = $categories->fetch_assoc()):
                ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat_id == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <?php
    // Handle Search
    if ($search) {
        echo "<h3 class='mb-4 text-center'>Search Results for '" . htmlspecialchars($search) . "'</h3>";
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY created_at DESC");
        $search_term = "%$search%";
        $stmt->bind_param("ss", $search_term, $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()):
    ?>
        <div class="col-md-4 mb-4">
            <?php include 'includes/product_card.php'; ?>
        </div>
    <?php endwhile; ?>
        </div>
        <div class="text-center mt-4 mb-5">
            <a href="products.php" class="btn btn-secondary">← Back to All Products</a>
        </div>

    <?php
    // View All Category Products
    } elseif ($cat_id) {
        $cat_stmt = $conn->prepare("SELECT name FROM categories WHERE id = ?");
        $cat_stmt->bind_param("i", $cat_id);
        $cat_stmt->execute();
        $cat_result = $cat_stmt->get_result();
        $category = $cat_result->fetch_assoc();
        $category_name = $category ? $category['name'] : "Unknown Category";

        echo "<h3 class='mb-4 text-center'>" . htmlspecialchars($category_name) . " Products</h3>";

        $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()):
    ?>
        <div class="col-md-4 mb-4">
            <?php include 'includes/product_card.php'; ?>
        </div>
    <?php endwhile; ?>
        </div>
        <div class="text-center mt-4 mb-5">
            <a href="products.php" class="btn btn-secondary">← Back to All Products</a>
        </div>

    <?php
    } else {
        // Show 3 Products Per Category with "View All"
        $categories = $conn->query("SELECT * FROM categories");

        while ($cat = $categories->fetch_assoc()):
            echo "<h4 class='mb-3'>" . htmlspecialchars($cat['name']) . "</h4>";
            $products = $conn->query("SELECT * FROM products WHERE category_id = {$cat['id']} ORDER BY created_at DESC LIMIT 3");

            echo "<div class='row'>";
            while ($row = $products->fetch_assoc()):
    ?>
        <div class="col-md-4 mb-4">
            <?php include 'includes/product_card.php'; ?>
        </div>
    <?php endwhile; ?>
        </div>
        <div class="text-end mb-5">
            <a href="products.php?cat_id=<?= $cat['id'] ?>" class="btn btn-outline-primary">View All</a>
        </div>
    <?php
        endwhile;
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>

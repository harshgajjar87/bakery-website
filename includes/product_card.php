<?php if (!isset($_SESSION)) session_start(); ?>

<div class="card h-100">
<img src="/bakery-website/assets/images/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
        <p class="card-text fw-bold">₹<?= htmlspecialchars($row['price']) ?></p>
    </div>
    <div class="card-footer text-center">
        <?php if (isset($_SESSION['user_id']) && (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin')): ?>
            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        <?php else: ?>
            <a href="login.php" class="btn btn-outline-primary">Log in to Order</a>
        <?php endif; ?>
    </div>
</div>

<?php
session_start();
include('includes/header.php');
include('config/db.php');
?>

<div class="container mt-5">
    <div class="row">
        <!-- Left Side: Main Content -->
        <div class="col-md-7 main-content">
            <h1>Welcome to Harsh Cake Zone.</h1>
            <p>Delicious cakes and pastries made with love. Order online and enjoy at home!
            From freshly baked cupcakes to decadent cheesecakes, we have something for every sweet tooth.
            Whether it's a birthday, anniversary, or just a craving, we bake with passion and precision. 
            </p>
            <a href="login.php" class="btn btn-primary">Login to Order</a>
            <a href="register.php" class="btn btn-outline-secondary">Register</a>
        </div>

        <!-- Right Side: Image Slider -->
        <div class="col-md-5 image-slider">
            <img id="sliderImage" src="assets/images/banner.jpg" alt="Slideshow" class="slider-img">
        </div>
    </div>

    <br><br><br><br>

    <!-- Product Cards -->
    <div class="row">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="assets/images/' . $row['image'] . '" class="card-img-top" style="height:250px;object-fit:cover;" alt="' . $row['name'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['name'] . '</h5>
                                <p class="card-text">' . $row['description'] . '</p>
                                <p class="text-success fw-bold">₹' . $row['price'] . '</p>';
                if (isset($_SESSION['user_id'])) {
                    echo '<form action="add_to_cart.php" method="POST">
                              <input type="hidden" name="product_id" value="' . $row['id'] . '">
                              <button type="submit" class="btn btn-primary">Add to Cart</button>
                          </form>';
                } else {
                    echo '<a href="login.php" class="btn btn-outline-primary">Login to Order</a>';
                }
                echo '</div></div></div>';
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</div>

<script>
    const images = [
        "assets/images/1744360145_photo_45_2025-02-16_21-37-42.jpg",
        "assets/images/1744360447_photo_2025-02-16_21-30-43 (5).jpg",
        "assets/images/1744360731_photo_31_2025-02-16_21-37-42.jpg",
        "assets/images/1744360286_photo_2025-02-16_21-30-53 (6).jpg"
    ];

    let index = 0;
    const slider = document.getElementById("sliderImage");

    setInterval(() => {
        slider.style.opacity = 0;

        setTimeout(() => {
            index = (index + 1) % images.length;
            slider.src = images[index];
            slider.style.opacity = 1;
        }, 1000);
    }, 5000);
</script>

<?php include 'includes/footer.php'; ?>
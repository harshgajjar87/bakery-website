<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harsh Cake Zone</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <?php if (isset($_SESSION['user_id']) || (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin')): ?>
    <span class="navbar-brand text-light">Harsh Cake Zone</span>
<?php else: ?>
    <a class="navbar-brand" href="index.php">Harsh Cake Zone</a>
<?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="products.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>

                    <?php if (!isset($_SESSION)) session_start(); ?>

                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="notification.php">Notification</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php" onclick="confirmLogout()">Logout</a></li>
                        <script>
                            function confirmLogout() {
                                if (confirm("Do you really want to log out?")) {
                                    window.location.href = "logout.php";
                                }
                            }
                        </script>

                    <?php elseif (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="profile.php">My Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php" onclick="confirmLogout()">Logout</a></li>
                        <script>
                            function confirmLogout() {
                                if (confirm("Do you really want to log out?")) {
                                    window.location.href = "logout.php";
                                }
                            }
                        </script>
                        <li class="nav-item">
                            <a href="cart.php" class="btn btn-warning ms-2">View Cart</a>
                        </li>
                        
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <?php endif; ?>

                    
                </ul>
            </div>
        </div>
    </nav>
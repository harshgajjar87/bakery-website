<?php // File: register.php
include 'config/db.php';

if (isset($_POST['register'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $username = htmlspecialchars(trim($_POST['username']));
    $role = 'user'; // Default to user, remove self-selection
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $address = htmlspecialchars(trim($_POST['address']));

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error = "Username or email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, mobile, username, password, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $mobile, $username, $password, $address, $role);
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success_message'] = "Registration successful! Welcome to Harsh Cake Zone, $name. You can now log in.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2>Register</h2>
    <?php
    if (isset($error)) echo "<div class='alert alert-danger'>$error</div>";
    if (isset($success)) echo "<div class='alert alert-success'>$success</div>";
    ?>
    <form method="POST">
        <div class="mb-3">
            <label>Full Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone Number:</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <button type="submit" name="register" class="btn btn-success">Register</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
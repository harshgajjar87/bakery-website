<?php
// File: login.php
include 'config/db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password']) || $password === $user['password']) {
            // Regenerate session ID for security
            session_regenerate_id(true);

            // ✅ SET SESSION VARIABLES
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];

            // Set success message for notification
            $_SESSION['success_message'] = "Welcome back, " . $user['name'] . "! You have successfully logged in.";

            // ✅ REDIRECT BASED ON ROLE
            if ($user['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: products.php");
            }
            exit();

        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with that username";
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
        <p class="mt-2">Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</div>
<?php include 'includes/footer.php'; ?>

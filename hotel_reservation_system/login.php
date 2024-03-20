<?php
session_start();
include_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Escape user input
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate login credentials using a prepared statement
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
<div class="area">
  <ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
 
  
  <!-- FORM CONTAINER -->
  <div class="login-container">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
        <a href="forgot_password.php">Forgot Password?</a><br>
        <span>Don't have an account? <a href="signup.php">Sign Up</a></span>
    </form>
</div>

<!----- Content ------>
<div class="content">
  <h1><i class="fas fa-hotel">LodgiGo</i></h1>
  <br>
  <p class="par">Experience the ultimate travel companion with LodgiGo!<br>
    Discover a world of possibilities and embark on unforget<br>table journeys.
    Whether you're seeking a tranquil escape<br>a vibrant city adventure
    or a cozy home away from home<br>
    LodgiGo is here to make your travel dreams a reality.</p>
</div>
</ul>

</body>
</html>

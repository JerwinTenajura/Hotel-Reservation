<?php
session_start();
include_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Email already exists.";
        $_SESSION['error'] = $error;
    } else {
        // Get the last user_id from the table
        $last_id_query = "SELECT MAX(user_id) as last_id FROM users";
        $last_id_result = mysqli_query($conn, $last_id_query);
        $row = mysqli_fetch_assoc($last_id_result);
        $last_id = $row['last_id'];

        // Increment the last user_id to get a new unique user_id
        $user_id = $last_id + 1;

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $query = "INSERT INTO users (user_id, email, username, password, role) VALUES ('$user_id', '$email', '$username', '$hashed_password', '$role')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Account created successfully. Please login.');</script>";
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed. Please try again.";
            $_SESSION['error'] = $error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
  <div class="signin-container">
        <h1>Register</h1>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <button type="submit" name="signup">Sign Up</button>
            <span>Already have an account? <a href="login.php">Login</a></span>
        </form>
    </div>

  <!----- Content ------>
  <div class="content">
    <h1><i class="fa-solid fa-hotel"> LodgiGo</i></h1>
    <br>
    <p class="par">Experience the ultimate travel companion with LodgiGo!<br>
      Discover a world of possibilities and embark on unforget<br>table journeys.
      Whether you're seeking a tranquil escape<br>a vibrant city adventure
      or a cozy home away from home<br>
      LodgiGo is here to make your travel dreams a reality.</p>
  </div>
  </ul>
</div>

</body>
</html>

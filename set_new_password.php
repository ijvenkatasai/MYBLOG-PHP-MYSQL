<?php
session_start();
include("database.php");



$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new = $_POST["new_password"] ?? '';
    $confirm = $_POST["confirm_password"] ?? '';


    if ($new === $confirm) {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        if ($conn) {
            $hashed = password_hash($new, PASSWORD_DEFAULT);
            $user=$_SESSION["username"];
            $update = "UPDATE users SET password = '$hashed' WHERE username = '$user'";
            if (mysqli_query($conn, $update)) {
                $message = "<div class='message'>Password reset successfully! You can now log in.</div>";
               header("refresh:2; url=/APEXPLANET/profile.php");  
                
            } else {
                $message = "<div class='error'>Failed to update password.</div>";
            }
        } else {
            $message = "<div class='error'>Database connection failed.</div>";
        }
    } else {
        $message = "<div class='error'>Passwords do not match.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Set New Password – My Blog</title>
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      color: #F2BFA4;
      margin: 40px 0 10px;
      font-size: 2.5rem;
    }
    .container {
      max-width: 500px;
      margin: 30px auto;
      padding: 30px;
      background-color: #1f1f1f;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.4);
    }
    label {
      display: block;
      text-align: left;
      margin-bottom: 8px;
      font-weight: bold;
    }
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: none;
      border-radius: 6px;
      background-color: #2e2e2e;
      color: white;
    }
    button {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      color: white;
      background-color: #4681f4;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #3a6edc;
    }
    .message, .error {
      text-align: center;
      font-weight: bold;
      margin-top: 15px;
    }
       .message {
      color: #28a745;
    }
    .error {
      color: #dc3545;
    }
  </style>
</head>
<body>
<div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>

<div class="back-button" style="margin-left: 40px; margin-top: 10px;">
  <a href="password_reset.php" style="
    background-color: #4681f4;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
  ">Back</a>
</div>

<div class="container">
  
  <?php if (empty($message)): ?>
  <form method="post" action="set_new_password.php">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Reset Password</button>
  </form>
  <?php endif; ?>
</div>
<?= $message ?>
</body>
</html>
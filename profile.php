<?php
include("database.php");
session_start();

$message = "";
$show_username_form = false;
$show_password_form = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if (!$conn) {
        $message = "<div class='error'>Database connection failed.</div>";
    } else {
        $user = $_SESSION["username"] ?? '';

        if (isset($_POST["submit"])) {
            if ($_POST["submit"] === "change_username") {
                $show_username_form = true;
            } elseif ($_POST["submit"] === "change_password") {
                $show_password_form = true;
            }
        }
     if (isset($_POST["new_username"])) {
    $new_username = trim($_POST["new_username"]);
    if ($new_username === '') {
        $message = "<div class='error'>Username cannot be empty.</div>";
    } else {
        $check = "SELECT username FROM users WHERE username = '$new_username'";
        $res = mysqli_query($conn, $check);

        if (mysqli_num_rows($res) > 0) {
            $message = "<div class='error'>Username already exists. Please choose another.</div>";
        } else {
            
            
           
            $update_user = "UPDATE users SET username = '$new_username' WHERE username = '$user'";
           
            $update_posts = "UPDATE posts SET user_id = '$new_username' WHERE user_id = '$user'";

            if (mysqli_query($conn, $update_user) && mysqli_query($conn, $update_posts)) {
                $_SESSION["username"] = $new_username;
                $message = "<div class='message'>Username updated successfully!</div>";
                
            } else {
                $message = "<div class='error'>Failed to update username.</div>";
            }
        }
    }
}
        if (isset($_POST["old_password"])) {
            $old = $_POST["old_password"] ?? '';
            $new = $_POST["new_password"] ?? '';
            $confirm = $_POST["confirm_password"] ?? '';

            $sql = "SELECT password FROM users WHERE username = '$user'";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) === 1) {
                $row = mysqli_fetch_assoc($res);
                if (password_verify($old, $row["password"])) {
                    if ($new === $confirm) {
                        $hashed = password_hash($new, PASSWORD_DEFAULT);
                        $update = "UPDATE users SET password = '$hashed' WHERE username = '$user'";
                        if (mysqli_query($conn, $update)) {
                            $message = "<div class='message'>Password changed successfully! Redirecting...</div>";
                            header("refresh:2; url=/APEXPLANET/myblog.php");
                            exit();
                        } else {
                            $message = "<div class='error'>Failed to update password.</div>";
                        }
                    } else {
                        $message = "<div class='error'>New and confirm passwords do not match.</div>";
                    }
                } else {
                    $message = "<div class='error'>Incorrect old password.</div>";
                }
            } else {
                $message = "<div class='error'>User not found.</div>";
            }
        }
        
    }
    if (isset($_POST["submit"]) && $_POST["submit"] === "delete_account") {
    $delete_posts = "DELETE FROM posts WHERE user_id = '$user'";
    $delete_user = "DELETE FROM users WHERE username = '$user'";

    if (mysqli_query($conn, $delete_posts) && mysqli_query($conn, $delete_user)) {
        session_destroy();
        header("Location: /APEXPLANET/index.php");
        exit();
    } else {
        $message = "<div class='error'>Failed to delete account.</div>";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile – My Blog</title>
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
    h2 {
      text-align: center;
      font-size: 1.4rem;
      color: #ccc;
      margin-bottom: 20px;
    }
    .back-button {
      margin-left: 40px;
      margin-top: 10px;
    }
    .back-button a {
      background-color: #4681f4;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
    }
    .back-button a:hover {
      background-color: #3a6edc;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 30px;
      background-color: #1f1f1f;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.4);
      text-align: center;
    }
    .container input[type="password"],
    .container input[type="text"] {
      padding: 10px;
      width: 80%;
      margin: 10px 0;
      border-radius: 6px;
      border: none;
      background-color: #2e2e2e;
      color: white;
    }
    .container button {
      padding: 12px 24px;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      color: white;
      background-color: #4681f4;
      transition: background-color 0.3s ease;
    }
    .container button:hover {
      background-color: #3a6edc;
    }
    .container a {
      color: #4681f4;
      text-decoration: none;
      font-weight: bold;
    }
    .container a:hover {
      text-decoration: underline;
    }
    .message, .error {
      font-weight: bold;
      margin-top: 10px;
      text-align: center;
    }
    .message {
      color: #28a745;
    }
    .error {
      color: #dc3545;
    }
    form {
      display: inline-block;
      width: 100%;
    }
  </style>
</head>
<body>
  <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
  <div class="back-button">
    <a href="/APEXPLANET/myblog.php">Back</a>
  </div>

  <h2>Your Profile</h2>
  <div class="container">
    <?php if (!$show_username_form && !$show_password_form): ?>
     <form method="post" action="profile.php">
  <button type="submit" name="submit" value="change_username">Change Username</button><br><br>
  <button type="submit" name="submit" value="change_password">Change Password</button><br><br>
  <button type="submit" name="submit" value="delete_account" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</button><br><br>
</form>
    <?php endif; ?>

    <?php if ($show_password_form): ?>
      <form method="post" action="profile.php">
        <input type="password" name="old_password" placeholder="Enter old password" required /><br>
        <input type="password" name="new_password" placeholder="Enter new password" required /><br>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required /><br>
        <button type="submit">Update Password</button><br><br>
        <a href="Password_reset.php">Forgot password?</a>
      </form>
    <?php endif; ?>

    <?php if ($show_username_form): ?>
      <form method="post" action="profile.php">
        <input type="text" name="new_username" placeholder="Enter new username" required /><br>
        <button type="submit">Change Username</button>
      </form>
    <?php endif; ?>
  </div>

  <?php if (!empty($message)) echo $message; ?>
</body>
</html>
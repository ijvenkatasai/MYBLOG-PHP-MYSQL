<?php
include("database.php");
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"])) {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if (!$conn) {
        $message = "<div class='error'>Database connection failed.</div>";
    } else {
        $session_user = $_SESSION["username"] ?? '';
        $user = mysqli_real_escape_string($conn, $_POST["username"]);
        $user_input=$_POST["username"];
        
    if (strcasecmp(trim($session_user), trim($user_input)) === 0) {
    $sql = "SELECT * FROM users WHERE username='$user'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        
        header("Location: /APEXPLANET/set_new_password.php");
      
    } 
}else {
    $message = "<div class='error'>Username mismatch! You can only reset your own password.</div>";
}
    
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Password Reset – My Blog</title>
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
    input[type="text"] {
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
  <div class="back-button">
    <a href="/APEXPLANET/profile.php">Back</a>
  </div>

  <div class="container">
    
    <form method="post" action="Password_reset.php">
      <label for="username">Username:</label>
      <input type="text" name="username" placeholder="Enter your username" required>

      <button type="submit">Submit</button>
    </form>
  </div>
  <?= $message ?>
</body>
</html>
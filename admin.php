<?php
include("database.php");
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN LOGIN</title>
    </head>
  <style>
    body {
      background-color: #2c2c2c;
      color: #e0e0e0;
 
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
      font-size: 3rem;
    }

    a {
      color: #4681f4;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      color: #3a6edc;
      text-decoration: underline;
    }

    .form-container {
      background-color: #3a3a3a;
      max-width: 400px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    h2 {
      color: #F2BFA4;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      background-color: #e0e0e0;
      color: #333;
    }

    input[type="submit"] {
      background-color: #4681f4;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    input[type="submit"]:hover {
      background-color: #3a6edc;
      transform: scale(1.05);
      
    }

    .form-container a {
      display: inline-block;
      margin-top: 10px;
    }
    .center-wrapper {
  text-align: center;
  margin-top: 20px;

}
.message{
            text-align: center;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }
        .error {
            text-align: center;
            font-weight: bold;
            color: #dc3545;
            margin-top: 20px;
        }
  </style>


<body>
<<<<<<< HEAD
  <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
  <div style="text-align: center; margin-top: 10px;">
    <a href="/APEXPLANET/index.php">HOME</a>
  </div>

  <div class="form-container">
    <h2 style="text-align: center;">ADMIN LOGIN</h2>
=======
  <h1>MY BLOG</h1>
  <div style="text-align: center; margin-top: 10px;">
    <a href="index.php">HOME</a>
  </div>

  <div class="form-container">
    <h2 style="text-align: center;">LOGIN</h2>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    <form action="admin.php" method="post">
  
  <label for="email"><b>E-MAIL:</b></label><br>
  <input type="email" id="email" name="email" required size="50" style="width: 370px;height: 30px; border-radius: 5px;"><br><br>
<label><b>PASSWORD:</b></label><br>
      <input type="password" name="password"><br>
    <div class="center-wrapper">
  <input type="submit" name="login" value="Login"><br>
  
</div>
    </form>
  </div>
  
</body>

</html>
<?php


if (isset($_POST["login"])) {
    $admin_email = "Apexplanet@gmail.com";
    $admin_password = "Apex12345";

    $input_email = $_POST["email"] ?? '';
    $input_password = $_POST["password"] ?? '';

    if (empty($input_email) || empty($input_password)) {
        echo '<div class="error">Enter Email and Password!</div>';
    } elseif ($input_email === $admin_email && $input_password === $admin_password) {
        $_SESSION["username"] = "Admin";
        $_SESSION["role"] = "admin";
        echo '<div class="message">Login successful!</div>';
<<<<<<< HEAD
        header("refresh:2; url=/APEXPLANET/adminhome.php");
=======
        header("refresh:2; url=adminhome.php");
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        exit();
    } else {
        echo '<div class="error">Access Denied! Invalid Admin Credentials.</div>';
    }
}
?>

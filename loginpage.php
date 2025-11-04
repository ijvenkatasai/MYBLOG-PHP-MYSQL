<?php
include("database.php");
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
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
=======
  <h1>MY BLOG</h1>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
  <div style="text-align: center; margin-top: 10px;">
    <a href="index.php">HOME</a>
  </div>

  <div class="form-container">
    <h2 style="text-align: center;">LOGIN</h2>
    <form action="loginpage.php" method="post">
      <label><b>USERNAME:</b></label><br>
      <input type="text" name="username"><br>
      <label><b>PASSWORD:</b></label><br>
      <input type="password" name="password"><br>
    <div class="center-wrapper">
  <input type="submit" name="login" value="Login"><br>
<<<<<<< HEAD
  <span>New user?</span> <a href="/APEXPLANET/register.php">Register</a>
=======
  <span>New user?</span> <a href="register.php">Register</a>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
</div>
    </form>
  </div>
  
</body>

</html>
<?php
if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo '<div class="error">Enter Username/password !!!</div>';
    } else {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $user = mysqli_real_escape_string($conn, $_POST["username"]);
        $pass = $_POST["password"];
        $sql = "SELECT * FROM users WHERE username='$user'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (password_verify($pass, $row["password"])) {
                echo '<div class="message">Login successful!!!!!!!</div>';
                $_SESSION["username"] = $user;
                $_SESSION["role"] = "user";
<<<<<<< HEAD
                header("refresh:2; url=/APEXPLANET/myblog.php");
=======
                header("refresh:2; url=myblog.php");
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
            } else {
                echo '<div class="error">Incorrect Password!!!</div>';
            }
        } else {
            echo '<div class="error">User not Found!!!</div>';
        }
    }
}
?>


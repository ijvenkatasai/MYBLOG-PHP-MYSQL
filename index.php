<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Index</title>
  <style>
    body {
      background-color: #2c2c2c;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
      
    }

    

    .btn {
      border: none;
      padding: 10px 20px;
      margin-left: 10px;
      border-radius: 5px;
      cursor: pointer;
      color: white;
    }

    

    

    .btn-admin {
      background-color: #f44336; 
    }

    .btn-admin:hover {
      background-color: #d32f2f;
    }

    .btn-user {
      background-color: #4caf50;
    }

    .btn-user:hover {
      background-color: #388e3c;
    }

    h1 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
      font-size: 3rem;
    }

    .container-wrapper {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 40px;
    }

    .admin-container, .user-container {
      background-color: #3a3a3a;
      width: 200px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
      text-align: center;
    }

    .intro-text {
      text-align: center;
      font-size: 18px;
      margin: 80px auto 20px;
      max-width: 600px;
    }
    footer {
      text-align: center;
      font-size: 0.9rem;
      color: #888;
      margin: 60px 0 20px;
    }

  </style>
</head>
<body>
<div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>

  

  <p class="intro-text">
    Welcome to <strong>My Blog</strong> — a space where ideas come alive! Whether you're here to share your thoughts, explore new perspectives, or simply enjoy a good read, you've found the right place. Dive into posts, connect with others, and make your voice heard. Let's build something meaningful together.
  </p>

  <div class="container-wrapper">
    <div class="admin-container">
      <h4>Login as Administrator</h4>
      <a href="/APEXPLANET/admin.php"><button class="btn btn-admin">LOGIN</button></a>
    </div>
    <div class="user-container">
      <h4>Login as User</h4>
      <a href="/APEXPLANET/loginpage.php"><button class="btn btn-user">LOGIN</button></a>
    </div>
  </div>
   <p class="intro-text">
 <strong> My Blog</strong> is a secure, student-built platform designed for simplicity, control, and personal expression. Whether you're here to share your thoughts or manage your account, this blog offers a smooth and intuitive experience. Key features include secure login and session management, the ability to reset your password safely, and the option to update your username — all with real-time validation and user-friendly feedback. Built using PHP and MySQL, the platform follows best practices in authentication, form handling, and role-based access. With a clean interface and a focus on usability, My Blog empowers users to write freely while staying in control of their identity and data.

  </p>
   <footer>
    &copy; <?php echo date("Y"); ?> My Blog. Built by I. Jaganmohan Venkata Sai (Venkat).
  </footer>
</body>
</html>
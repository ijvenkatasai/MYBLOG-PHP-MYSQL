<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE POST</title>
    <style>
        body {
      background-color: #1e1e1e;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
    }

        h1 ,h2{
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
     
    }

        .container {
            background-color: #3a3a3a;
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      border-radius: 10px;
       box-shadow: 0 0 10px rgba(255,255,255,0.1);
      color: #F2BFA4;
        }

        label, b {
            font-size: 1.1em;
            color: #F2BFA4;
        }

        input[type="text"], textarea {
            width: 95%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            
        }

        input[type="submit"], button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            text-align: center;
            margin-left: 10px;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
            font-weight: bold;
            text-align: center;
            
        }

        .back-button {
            display: block;
            margin: 0 auto 10px auto;
            text-align: center;
            font-weight: bold;
            padding: 20px;
            margin-left: 10px;
        }

        .message {
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
        .submit-button {
    text-align: center;
}
    </style>
</head>
<body>
<<<<<<< HEAD
    <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
    <h2>NEW POST</h2>
=======
    <h1>MY BLOG</h1>
    <h2>CREATE POST</h2>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    <a href="myblog.php"><button>Back</button></a>
    <div class="container">
        <form action="create_post.php" method="POST">
            <label for="title"><b>TITLE:</b></label><br>
            <input type="text" name="title" id="title"><br>
            <label for="content"><b>CONTENT:</b></label><br>
            <textarea id="content" name="content" rows="10"></textarea><br>
            <div class="submit-button">
    <input type="submit" name="POST" value="POST">
</div>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["username"];

    if (empty($title)) {
        echo '<div class="error">Assign Title/Content!!!</div>';
    } else {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);
        $user_id = mysqli_real_escape_string($conn, $user_id);

        $sql = "INSERT INTO posts (title, content, user_id) 
                VALUES ('$title', '$content', '$user_id')";
        try {
            mysqli_query($conn, $sql);
            echo '<div class="message">POST Created Successfully!!!!</div>';
        } catch (mysqli_sql_exception) {
            echo '<div class="error">Title is Already Taken!!!</div>';
        }
      

        mysqli_close($conn);
    }
}
?>

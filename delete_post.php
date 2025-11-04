<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE POST</title>
</head>
<style>
  body {
    background-color: #2c2c2c;
    color: #e0e0e0;
    margin: 0;
    padding: 0;
  }

  h1{
    text-align: center;
    color: #F2BFA4;
    margin-top: 30px;
  }
h2{
   text-align: center;
    color: #F2BFA4;
    margin-top: 20px; 
}
  button {
    background-color: #4681f4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  button:hover {
    background-color: #3a6edc;
    transform: scale(1.05);
  }

  form {
    background-color: #3a3a3a;
    max-width: 400px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    color: #e0e0e0;
  }

  input[type="text"] {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    background-color: #e0e0e0;
    color: #333;
  }
  label{
    display: block;
            width: 100%;
            margin-bottom: 20px;
            font-size: 1em;
            color:#e0e0e0 ;
  }

  input[type="submit"] {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  input[type="submit"]:hover {
    background-color: #d32f2f;
    transform: scale(1.05);
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
    color: #ff4c4c;
    margin-top: 20px;
  }
  .back-button {
    text-align: left;
    margin: 20px 0 0 20px;
}
</style>
<body>
    <h1 style="text-align: center;">MY BLOG </h1>
    
    <div class="back-button">
<a href="myblog.php"><button>Back</button></a>
    </div>
    
    <br><br><br><br>
    <div>
        <form action="delete_post.php" method="POST" style="text-align: center;">
            <h2 style="text-align: center;">DELETE POST</h2>
        <label for="postid">POST_ID:</label>
        <input type="text" name="postid">
        <input type="submit" name="delete" value="Delete"><br><br>
    
        </form>
        
    </div>
    
</body>
</html>
<?php
if (isset($_POST["delete"]))  {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $post_id = mysqli_real_escape_string($conn, $_POST["postid"]);
    $user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
    if(!empty($post_id)){
    $sql = "SELECT * FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
<<<<<<< HEAD
      $user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $s = "DELETE FROM posts WHERE id = '$post_id' AND user_id LIKE '$userid'";
=======
    $s = "DELETE FROM posts WHERE id = '$post_id'";
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    mysqli_query($conn, $s);
    echo '<div class="message">Post Deleted successfully!!!</div>';
    header("refresh:2; url=myblog.php");
} else {
    echo '<div class="error">No Post Found!!!</div>';
    header("refresh:2; url=myblog.php");
}
}
    else{
        echo '<div class="error">Enter Post Id!!!</div>';
    }
    }
    mysqli_close($conn);

?>

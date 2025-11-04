<?php
include("database.php");
session_start();
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

$existing_title = "";
$existing_content = "";
$post_id = "";
$error_message = "";
$success_message = "";


if (isset($_GET["id"])) {
    $post_id = mysqli_real_escape_string($conn, $_GET["id"]);
    $user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $sql = "SELECT * FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $existing_title = htmlspecialchars($row["title"]);
        $existing_content = htmlspecialchars($row["content"]);
    } else {
        $error_message = "Post Not found or access denied!";
    }
}

if (isset($_POST["update"])) {
    $id = mysqli_real_escape_string($conn, $_POST["post_id"]);
    $title = mysqli_real_escape_string($conn, $_POST["newtitle"]);
    $content = mysqli_real_escape_string($conn, $_POST["newcontent"]);
    $user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);

    $sql = "SELECT * FROM posts WHERE id = '$id' AND user_id = '$user_id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        if (!empty($title)) {
            $check_sql = "SELECT * FROM posts WHERE title = '$title' AND id != '$id'";
            $check_res = mysqli_query($conn, $check_sql);
            if (mysqli_num_rows($check_res) > 0) {
                $error_message = "Title already taken! Title not updated.";
            } else {
                $sql = "UPDATE posts SET title = '$title' WHERE id = '$id' AND user_id = '$user_id'";
                mysqli_query($conn, $sql);
                $success_message .= "Title";
            }
        }

        if (!empty($content)) {
            $sql = "UPDATE posts SET content = '$content' WHERE id = '$id' AND user_id = '$user_id'";
            mysqli_query($conn, $sql);
            $success_message .= "/Content updated!!!<br>";
        }
    } else {
        $error_message = "Post not found or access denied!";
    }
    header("refresh:2; url=myblog.php?filter=user");
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Edit Post</title>
=======
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT POST</title>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    <style>
        body {
            background-color: #1e1e1e;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
<<<<<<< HEAD
=======

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        h1, h2 {
            text-align: center;
            color: #F2BFA4;
            margin-top: 30px;
        }
<<<<<<< HEAD
=======

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        .note {
            color: #ff4d4d;
            text-align: center;
            margin-top: 10px;
            font-size: 0.95em;
        }
<<<<<<< HEAD
=======

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        .container {
            max-width: 500px;
            margin: 30px auto;
            padding: 25px;
            background-color: #2c2c2c;
            border-radius: 10px;
            color: #F2BFA4;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }
<<<<<<< HEAD
=======

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        label, input[type="text"], textarea {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            font-size: 1em;
        }
<<<<<<< HEAD
=======

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        input[type="text"], textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000000ff;
            width: 95%;
        }
<<<<<<< HEAD
=======

      

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        input[type="submit"], button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
<<<<<<< HEAD
        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }
        .back-button {
            margin: 20px 0 0 10px;
        }
=======

        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin: 20px 0 0 10px;
        }

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        .message {
            text-align: center;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }
<<<<<<< HEAD
=======

>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
        .error {
            text-align: center;
            font-weight: bold;
            color: #dc3545;
            margin-top: 20px;
        }
        .submit-button {
<<<<<<< HEAD
            text-align: center;
        }
    </style>
</head>
<body>
   <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
    <h2>EDIT POST</h2>
    <div class="back-button">
        <a href="myblog.php?filter=user"><button>Back</button></a>
    </div>

    <div class="container">
        <?php if (!empty($existing_title) || !empty($existing_content)) { ?>
        <form method="POST" action="edit_post.php">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">

            <label for="newtitle">New Post Title:</label>
            <input type="text" name="newtitle" id="newtitle" value="<?php echo $existing_title; ?>">

            <label for="content">New Post Content:</label>
            <textarea id="content" name="newcontent" rows="10"><?php echo $existing_content; ?></textarea>

            <div class="submit-button">
                <input type="submit" name="update" value="Update">
            </div>
        </form>
        <?php } ?>
        <?php if (!empty($success_message)) { echo '<div class="message">' . $success_message . '</div>'; } ?>
        <?php if (!empty($error_message)) { echo '<div class="error">' . $error_message . '</div>'; } ?>
    </div>
</body>
</html>
=======
    text-align: center;
}
    </style>
</head>
<body>
    <h1>MY BLOG</h1>
    <h2>EDIT POST</h2>
    <div class="back-button">
        <a href="myblog.php"><button>Back</button></a>
    </div>
    <p class="note">Note: Need Post ID to edit/update. (Go to View Post to know the Post ID).</p>
    <div class="container">
        <form action="edit_post.php" method="POST">
            <label for="post_id">POST ID:</label>
            <input type="text" name="post_id" id="post_id">

            <label for="newtitle">NEW POST TITLE:</label>
            <input type="text" name="newtitle" id="newtitle">

            <label for="content">NEW POST CONTENT:</label>
            <textarea id="content" name="newcontent" rows="10"></textarea>
             <div class="submit-button">
<input type="submit" name="update" value="UPDATE">
             </div>
            
            <p class="note">Note: Leave empty if you don't want to change. Otherwise, old data will be updated.</p>
        </form>
    </div>
    
</body>
</html>

<?php
if (isset($_POST["update"])) {
    $id = $_POST["post_id"];
    $title = $_POST["newtitle"];
    $content = $_POST["newcontent"];
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);
        if (!empty($title)) {
            $sql = "UPDATE posts SET title = '$title' WHERE id = $id";
            mysqli_query($conn, $sql);
            echo '<div class="message">Title is updated!!!</div>';
        }
        if (!empty($content)) {
            $sql = "UPDATE posts SET content = '$content' WHERE id = $id";
            mysqli_query($conn, $sql);
            echo '<div class="message">Content is updated!!!</div>';
        }
    } else {
        echo '<div class="error">Post Not found!!!</div>';
    }
    header("refresh:2; url=myblog.php");
    mysqli_close($conn);
}
?>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053

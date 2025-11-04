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
   
    $sql = "SELECT * FROM posts WHERE id = '$post_id'";
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

    $sql = "SELECT * FROM posts WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        if (!empty($title)) {
            $check_sql = "SELECT * FROM posts WHERE title = '$title' AND id != '$id'";
            $check_res = mysqli_query($conn, $check_sql);
            if (mysqli_num_rows($check_res) > 0) {
                $error_message = "Title already taken! Title not updated.";
            } else {
                $sql = "UPDATE posts SET title = '$title' WHERE id = '$id'";
                mysqli_query($conn, $sql);
                $success_message .= "Title updated!<br>";
            }
        }

        if (!empty($content)) {
            $sql = "UPDATE posts SET content = '$content' WHERE id = '$id'";
            mysqli_query($conn, $sql);
            $success_message .= "Content updated!<br>";
        }
    } else {
        $error_message = "Post not found or access denied!";
    }
    header("refresh:2; url=/APEXPLANET/adminhome.php?filter=user");
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #F2BFA4;
            margin-top: 30px;
        }
        .note {
            color: #ff4d4d;
            text-align: center;
            margin-top: 10px;
            font-size: 0.95em;
        }
        .container {
            max-width: 500px;
            margin: 30px auto;
            padding: 25px;
            background-color: #2c2c2c;
            border-radius: 10px;
            color: #F2BFA4;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }
        label, input[type="text"], textarea {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            font-size: 1em;
        }
        input[type="text"], textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000000ff;
            width: 95%;
        }
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
        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }
        .back-button {
            margin: 20px 0 0 10px;
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
    <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
    <h2>ADMIN EDIT</h2>
    <div class="back-button">
        <a href="adminhome.php?filter=user"><button>Back</button></a>
    </div>

    <div class="container">
        <?php if (!empty($existing_title) || !empty($existing_content)) { ?>
        <form method="POST" action="admin_edit.php">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">

            <label for="newtitle">New Post Title:</label>
            <input type="text" name="newtitle" id="newtitle" value="<?php echo $existing_title; ?>">

            <label for="content">New Post Content:</label>
            <textarea id="content" name="newcontent" rows="10"><?php echo $existing_content; ?></textarea>

            <div class="submit-button">
                <input type="submit" name="update" value="Update">
            </div>
            <p class="note">Leave fields empty if you don't want to change them.</p>
        </form>
        <?php } ?>
        <?php if (!empty($success_message)) { echo '<div class="message">' . $success_message . '</div>'; } ?>
        <?php if (!empty($error_message)) { echo '<div class="error">' . $error_message . '</div>'; } ?>
    </div>
</body>
</html>
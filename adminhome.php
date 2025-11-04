<?php
include("database.php");
session_start(); 
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
<<<<<<< HEAD
    header("Location: /APEXPLANET/admin.php");
=======
    header("Location: admin.php");
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIM HOME</title>
  <style>
    body {
      background-color: #1e1e1e;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 40px;
    }
    .top-bar {
      display: flex;
      justify-content: flex-end;
      padding: 20px 40px;
    }
    .top-bar a {
      background-color: #4681f4;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
    .top-bar a:hover {
      background-color: #3a6edc;
    }
    .post {
      background-color: #3a3a3a;
      padding: 15px;
      margin: 20px auto;
      max-width: 800px;
      border-radius: 8px;
      border-left: 5px solid #F2BFA4;
    }
    .post h3 {
      margin: 0;
      color: #F2BFA4;
    }
    .post p {
      margin: 10px 0;
      line-height: 1.5;
    }
    .edit-btn, .delete-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
      color: white;
    }
    .edit-btn {
      background-color: #28a745;
    }
    .edit-btn:hover {
      background-color: #218838;
    }
    .delete-btn {
      background-color: #dc3545;
      margin-left: 10px;
    }
    .delete-btn:hover {
      background-color: #c82333;
    }
    .message, .error {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
    }
    .message {
      color: #28a745;
    }
    .error {
      color: #dc3545;
    }
    .pagination {
      text-align: center;
      margin-top: 20px;
    }
    .pagination a {
      color: #F2BFA4;
      margin: 0 5px;
      text-decoration: none;
      font-weight: bold;
    }
    .pagination a:hover {
      text-decoration: underline;
      color: #fff;
    }
    .pagination .current {
      color: #fff;
      font-weight: bold;
      margin: 0 5px;
    }
  </style>
</head>
<body>
<<<<<<< HEAD
  <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
  <div class="top-bar">
    <a href="/APEXPLANET/index.php">Logout</a>
=======
  <h1>MY BLOG</h1>
  <div class="top-bar">
    <a href="index.php">Logout</a>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
  </div>

  <h2 style="margin-left: 40px;"><?php echo "Welcome ", $_SESSION["username"], ","; ?></h2>

<?php
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

<<<<<<< HEAD

=======
// Handle delete request
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
if (isset($_GET['delete_id'])) {
  $delete_id = (int)$_GET['delete_id'];
  $delete_sql = "DELETE FROM posts WHERE id = $delete_id";
  if (mysqli_query($conn, $delete_sql)) {
    $_SESSION['message'] = "Post deleted successfully";
<<<<<<< HEAD
    header("Location:/APEXPLANET/adminhome.php?page=$page");
=======
    header("Location: myblog.php?page=$page");
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    exit();
  } else {
    echo '<div class="error">Failed to delete post.</div>';
  }
}

<<<<<<< HEAD

=======
// Show flash message
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
if (isset($_SESSION['message'])) {
  echo '<div class="message" id="flash-message">' . $_SESSION['message'] . '</div>';
  unset($_SESSION['message']);
}
?>

<script>
<<<<<<< HEAD

=======
  // Hide flash message after 60 seconds
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
  setTimeout(() => {
    const msg = document.getElementById('flash-message');
    if (msg) msg.style.display = 'none';
  }, 60000);
</script>

<?php
<<<<<<< HEAD

=======
// Fetch posts
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
  while ($row = mysqli_fetch_assoc($res)) {
    echo '<div class="post">';
    echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
    echo '<p><strong>Post ID:</strong> ' . $row["id"] . '</p>';
    echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
    echo '<p><em>Created at: ' . $row["created_at"] . '</em></p>';
    echo '<p><strong>Author:</strong> ' . $row["user_id"] . '</p>';
<<<<<<< HEAD
    //echo '<a class="edit-btn" href="/APEXPLANET/admin_edit.php?id=' . $row["id"] . '">Edit</a>';
    echo '<a class="delete-btn" href="/APEXPLANET/adminhome.php?delete_id=' . $row["id"] . '&page=' . $page . '" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</a>';
    echo '</div>';
  }


=======
    echo '<a class="edit-btn" href="edit_post.php?id=' . $row["id"] . '">Edit</a>';
    echo '<a class="delete-btn" href="myblog.php?delete_id=' . $row["id"] . '&page=' . $page . '" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</a>';
    echo '</div>';
  }

  // Pagination
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
  $count_sql = "SELECT COUNT(*) AS total FROM posts";
  $count_res = mysqli_query($conn, $count_sql);
  $count_row = mysqli_fetch_assoc($count_res);
  $total_posts = $count_row['total'];
  $total_pages = ceil($total_posts / $limit);

  echo '<div class="pagination">';
  if ($page > 1) {
<<<<<<< HEAD
    echo '<a href="adminhome.php?page=' . ($page - 1) . '">Previous</a>';
=======
    echo '<a href="myblog.php?page=' . ($page - 1) . '">Previous</a>';
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
  }
  for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
      echo '<span class="current">' . $i . '</span>';
    } else {
<<<<<<< HEAD
      echo '<a href="adminhome.php?page=' . $i . '">' . $i . '</a>';
    }
  }
  if ($page < $total_pages) {
    echo '<a href="adminhome.php?page=' . ($page + 1) . '">Next</a>';
=======
      echo '<a href="myblog.php?page=' . $i . '">' . $i . '</a>';
    }
  }
  if ($page < $total_pages) {
    echo '<a href="myblog.php?page=' . ($page + 1) . '">Next</a>';
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
  }
  echo '</div>';
} else {
  echo '<div class="error">No Posts found!!!</div>';
}
?>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053

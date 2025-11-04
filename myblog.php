<?php
include("database.php");
session_start();
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "user") {
    header("Location: loginpage.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>USER HOME</title>
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
      justify-content: space-between;
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
    .edit-btn {
      display: inline-block;
      margin-top: 10px;
      background-color: #28a745;
      color: white;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
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
    .filter-bar {
      text-align: center;
      margin-top: 20px;
    }
    .filter-bar form {
      display: inline-block;
      margin: 10px;
    }
    .filter-bar input[type="text"] {
      padding: 10px;
      border-radius: 6px;
      width: 250px;
      border: none;
    }
    .filter-bar button {
      background-color: #4681f4;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    .filter-bar button:hover {
      background-color: #3a6edc;
    }
  </style>

  <?php

  $show_message = false;
  if (isset($_POST["delete_post"])) {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $delete_id = mysqli_real_escape_string($conn, $_POST["delete_id"]);
    $delete_sql = "DELETE FROM posts WHERE id = '$delete_id' AND user_id = '$user_id'";
    if (mysqli_query($conn, $delete_sql)) {
      $show_message = true;
      echo '<meta http-equiv="refresh" content="3;url=myblog.php?filter=user">';
    } else {
      echo '<div class="error">Failed to delete post.</div>';
    }
  }
  ?>
</head>
<body>
  <div style="background-color: #1f1f1f; padding: 40px 20px; text-align: center; border-bottom: 1px solid #444; box-shadow: 0 2px 10px rgba(0,0,0,0.4);">
  <h1 style="color: #F2BFA4; font-size: 3rem; letter-spacing: 2px; margin: 0;">MY BLOG</h1>
</div>
  <div class="top-bar">
  <a href="/APEXPLANET/create_post.php">New Post</a>
  <a href="/APEXPLANET/profile.php">Profile</a>
  <a href="/APEXPLANET/index.php">Logout</a>
</div>


  <h2 style="margin-left: 40px;"><?php echo "Welcome ", $_SESSION["username"], ","; ?></h2>

  <div class="filter-bar">
    <form method="get" action="myblog.php">
      <input type="hidden" name="filter" value="user">
      <button type="submit">Show My Posts</button>
    </form>

    <form method="post" action="myblog.php">
      <input type="text" name="search_user_id" placeholder="Search by User ID" required>
      <button type="submit" name="search_by_user">Search</button>
    </form>
  </div>

  <?php if (isset($_GET['filter']) || isset($_POST['search_by_user'])): ?>
    <div class="filter-bar">
      <form method="get" action="myblog.php">
        <button type="submit">Back</button>
      </form>
    </div>
  <?php endif; ?>

  <?php if ($show_message): ?>
    <div class="message">Post deleted successfully!</div>
  <?php endif; ?>

<?php
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
$user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_POST["search_by_user"])) {
  $search_user_id = mysqli_real_escape_string($conn, $_POST["search_user_id"]);
  $sql = "SELECT * FROM posts WHERE user_id LIKE '%$search_user_id%' ORDER BY created_at DESC";
  $res = mysqli_query($conn, $sql);

  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      echo '<div class="post">';
      echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
      echo '<p><strong>Post ID:</strong> ' . $row["id"] . '</p>';
      echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
      echo '<p><em>Created at: ' . $row["created_at"] . '</em></p>';
      echo '<p><strong>Author:</strong> ' . $row["user_id"] . '</p>';
      echo '</div>';
    }
  } else {
    echo '<div class="error">No posts found for that User ID!</div>';
  }
} else {
  $filter = isset($_GET['filter']) && $_GET['filter'] === 'user';
  $sql = $filter
    ? "SELECT * FROM posts WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT $limit OFFSET $offset"
    : "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

  $res = mysqli_query($conn, $sql);

  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      echo '<div class="post">';
      echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
      echo '<p><strong>Post ID:</strong> ' . $row["id"] . '</p>';
      echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
      echo '<p><em>Created at: ' . $row["created_at"] . '</em></p>';
      echo '<p><strong>Author:</strong> ' . $row["user_id"] . '</p>';
      if ($filter && $row["user_id"] === $_SESSION["username"]) {
        echo '<a class="edit-btn" href="/APEXPLANET/edit_post.php?id=' . $row["id"] . '">Edit</a>';
        echo '<form method="post" action="myblog.php" style="display:inline;">
                <input type="hidden" name="delete_id" value="' . $row["id"] . '">
                <button type="submit" name="delete_post" class="edit-btn delete-btn" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</button>
              </form>';
      }
           echo '</div>';
    }

    $count_sql = $filter
      ? "SELECT COUNT(*) AS total FROM posts WHERE user_id = '$user_id'"
      : "SELECT COUNT(*) AS total FROM posts";

    $count_res = mysqli_query($conn, $count_sql);
    $count_row = mysqli_fetch_assoc($count_res);
    $total_posts = $count_row['total'];
    $total_pages = ceil($total_posts / $limit);

    echo '<div class="pagination">';
    if ($page > 1) {
      echo '<a href="myblog.php?page=' . ($page - 1) . ($filter ? '&filter=user' : '') . '">Previous</a>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $page) {
        echo '<span class="current">' . $i . '</span>';
      } else {
        echo '<a href="myblog.php?page=' . $i . ($filter ? '&filter=user' : '') . '">' . $i . '</a>';
      }
    }

    if ($page < $total_pages) {
      echo '<a href="myblog.php?page=' . ($page + 1) . ($filter ? '&filter=user' : '') . '">Next</a>';
    }
    echo '</div>';
  } else {
    echo '<div class="error">No Posts found!!!</div>';
  }
}
?>
</body>
</html>

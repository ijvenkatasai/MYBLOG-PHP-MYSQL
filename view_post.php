<?php
include("database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VIEW POST</title>
  <style>
    body {
      background-color: #1e1e1e;
      color: #f0f0f0;
      margin: 0;
      padding: 0;
<<<<<<< HEAD

=======
>>>>>>> d7e8896ea5528c4d4e4fc9411ca22b3be2921053
    }

    h1, h2 {
      text-align: center;
      color: #F2BFA4;
      margin-top: 30px;
    }

    .container {
      max-width: 700px;
      margin: 30px auto;
      padding: 20px;
      background-color: #2c2c2c;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(255,255,255,0.1);
    }

    .search-form {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"] {
      width: 60%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1em;
      background-color: #3a3a3a;
      color: #f0f0f0;
    }

    button {
      padding: 10px 20px;
      margin-left: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .back-button {
      text-align: left;
      margin: 10px 0 0 10px;
    }

    .post {
      background-color: #3a3a3a;
      padding: 15px;
      margin-bottom: 20px;
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
  <h1>MY BLOG</h1>
  <h2>POSTS</h2>
  <div class="back-button">
    <a href="myblog.php"><button>BACK</button></a>
  </div>
  <div class="container">
    <form action="view_post.php" method="POST" class="search-form">
      <input type="text" name="search" placeholder="Search posts...">
      <button type="submit">Search</button>
    </form>

<?php
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
$user_id = mysqli_real_escape_string($conn, $_SESSION["username"]);
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_POST["search"])) {
  $search = mysqli_real_escape_string($conn, $_POST["search"]);
  if (!empty($search)) {
    $sql = "SELECT * FROM posts WHERE (id = '$search' OR title LIKE '%$search%' OR content LIKE '%$search%') AND user_id = '$user_id'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        echo '<div class="post">';
        echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
        echo '<p><strong>Post ID:</strong> ' . $row["id"] . '</p>';
        echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
        echo '<p><em>Created at: ' . $row["created_at"] . '</em></p>';
        echo '</div>';
      }
    } else {
      echo '<div class="error">No Post found!!!</div>';
    }
  } else {
    echo '<div class="error">Enter id/title/content!!!</div>';
  }
} else {
  $sql = "SELECT * FROM posts WHERE user_id = '$user_id' LIMIT $limit OFFSET $offset";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      echo '<div class="post">';
      echo '<h3>' . htmlspecialchars($row["title"]) . '</h3>';
      echo '<p><strong>Post ID:</strong> ' . $row["id"] . '</p>';
      echo '<p>' . nl2br(htmlspecialchars($row["content"])) . '</p>';
      echo '<p><em>Created at: ' . $row["created_at"] . '</em></p>';
      echo '</div>';
    }
    $total_sql = "SELECT COUNT(*) AS total FROM posts WHERE user_id = '$user_id'";
    $total_res = mysqli_query($conn, $total_sql);
    $total_row = mysqli_fetch_assoc($total_res);
    $total_posts = $total_row['total'];
    $total_pages = ceil($total_posts / $limit);

    echo '<div class="pagination">';
    if ($page > 1) {
      echo '<a href="view_post.php?page=' . ($page - 1) . '">Previous</a>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $page) {
        echo '<span class="current">' . $i . '</span>';
      } else {
        echo '<a href="view_post.php?page=' . $i . '">' . $i . '</a>';
      }
    }

    if ($page < $total_pages) {
      echo '<a href="view_post.php?page=' . ($page + 1) . '">Next</a>';
    }
    echo '</div>';
  } else {
    echo '<div class="error">No Posts found!!!</div>';
  }
}
?>
  </div>
</body>
</html>
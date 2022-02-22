<?php
    session_start();
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';
    require 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>

<ul>
    <li><a href="news_main.php">Home</a></li>
    <li><a href="post.php">Post</a></li>
    <?php if ($username == 'guest') { ?>
        <li style="float:right"><a href="login.php">Login</a></li>
        <li style="float:right"><a href="create.php">Create an Account</a></li>
    <?php } else { ?>
        <li style="float:right"><a href="logout.php">Logout</a></li>
    <?php } ?>
</ul>
<?php
    $stmt = "SELECT * FROM posts";
    $result = mysqli_query($mysqli, $stmt);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($posts as $post) {
        $id = $post['id'];
        $poster = $post['username'];
        $link = $post['link'];
        $message = $post['message']; ?>
        <div class="post">
        <a href="<?php echo $link; ?>"><?php echo $message; ?></a><br>

        <a href='comments.php?id=<?php echo $id; ?>'>View Comments </a>
        <a href='new_comment.php?id=<?php echo $id; ?>'>New Comment </a>
        <?php
            if ($username == $poster) { ?>
                <a href='delete_post.php?id=<?php echo $id; ?>'>Delete Post</a>
            <?php } ?>

        </div>
    <?php } ?>


</body>
</html>




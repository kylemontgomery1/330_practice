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
    $stmt = "SELECT * FROM comments Where post_id =".$_GET['id'];
    $result = mysqli_query($mysqli, $stmt);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($comments as $comment) {
        $id = $comment['id'];
        $commenter = $comment['username'];
        $content = $comment['content']; ?>
        <div>
        <p><?php echo $commenter.': '. $content; ?></a><br>
        <?php
            if ($username == $commenter) {
                echo "<a href='delete_comment.php'>Delete Comment</a>";
            }
        ?>
        <br><br></div>
    <?php } ?>


</body>
</html>
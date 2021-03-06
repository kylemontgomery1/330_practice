<?php
    session_start();
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';
    require 'database.php';
    $comment_id = $_GET['id'];
    $post_id = $_GET['post_id'];
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
$stmt = $mysqli->prepare("Delete from comments where id = (?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
    }

    $stmt->bind_param('i', $comment_id);
    $stmt->execute();
    $stmt->close();
    header("Location: comments.php?id=$post_id");
            
    ?>

</body>
</html>
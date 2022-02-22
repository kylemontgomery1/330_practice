<!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
    <?php 
        session_start();
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';
        require 'database.php';
        $post_id = $_GET['id'];
        if ($username == 'guest') { ?>
        <p>You need to an account to comment. Please <a href="login.php">Login</a> or <a href="create.php">create an account</a></p>
    <?php } else{?>
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

    <h2>Comment</h2>

    <form method="post", action='new_comment.php?id=<?php echo $post_id; ?>'>

    <label for="comment">Comment:</label><br>
    <textarea id="comment" name="comment" rows="4" cols="100"></textarea><br><br>

    <input type="submit" value="Post", name='submit'>
    </form> 
    <?php
        if(isset($_POST['submit'])){
            $comment = $_POST['comment'];
            $stmt = $mysqli->prepare("insert into comments (post_id, username, content) values (?, ?, ?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }

            $stmt->bind_param('iss', $post_id, $username, $comment);
            $stmt->execute();
            $stmt->close();
            header("Location: comments.php?id=$post_id");
        } }?>
</body>
</html>
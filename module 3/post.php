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
        if ($username == 'guest') { ?>
        <p>You need to an account to post. Please <a href="login.php">Login</a> or <a href="create.php">create an account</a></p>
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

    <h2>Post</h2>

    <form method="post", action=post.php>

    <label for="link">Link:</label><br>
    <textarea id="link" name="link" rows="4" cols="100"></textarea><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" rows="4" cols="100"></textarea><br><br>

    <input type="submit" value="Post", name='submit'>
    </form> 
    <?php
        if(isset($_POST['submit'])){
            $link = $_POST['link'];
            $description = $_POST['description'];
            $stmt = $mysqli->prepare("insert into posts (username, link, message) values (?, ?, ?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }

            $stmt->bind_param('sss', $username, $link, $description);
            $stmt->execute();
            $stmt->close();
            
            echo "<p>Post Sucessful. Go back to <a href='news_main.php'>home</a></p>";
        } }?>
</body>
</html>

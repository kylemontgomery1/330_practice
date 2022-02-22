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
</ul>
    <h2>Login</h2>

    <form method="post", action=login.php>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="pw">Password:</label><br>
    <input type="password" id="pw" name="pw"><br><br>

    <input type="submit" value="Log In", name='submit'>
    </form> 
    <?php
        require 'database.php';
        session_start();
        if(isset($_POST['submit'])){
            
            $username = $_POST['username'];
            $password = $_POST['pw'];

            $stmt = $mysqli->prepare("select * from users where username = '$username' and password = '$password'");
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                header("Location: news_main.php");
            } else {
                echo "<div>
                    <h3>Incorrect Username/password.</h3><br/>
                    <p>Click here to <a href='login.php'>Login</a> again.</p>
                    </div>";
            }
        }

    ?>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>The DeGiverville Post</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
    <h2>Login</h2>

    <form method="post", name = 'login'>

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
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                // Redirect to user dashboard page
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
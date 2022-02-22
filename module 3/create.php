<!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
    <h2>Create an Account</h2>

    <form method="post">

    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname"><br>

    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname"><br><br>

    <label for="uname">Username:</label><br>
    <input type="text" id="uname" name="uname"><br><br>

    <label for="pw">Password:</label><br>
    <input type="text" id="pw" name="pw"><br><br>

    <input type="submit" value="Submit", name='submit'>
    </form> 
    <?php
        if(isset($_POST['submit'])){
            require 'database.php';
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname'];
            $username = $_POST['uname'];
            $password = $_POST['pw'];

            $stmt = $mysqli->prepare("insert into users (first_name, last_name, username, password) values (?, ?, ?, ?)");
            if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->bind_param('ssss', $first_name, $last_name, $username, $password);
            $stmt->execute();
            $stmt->close();
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        }

    ?>

</body>
</html>

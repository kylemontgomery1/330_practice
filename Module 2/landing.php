<!DOCTYPE html>
<head><title>FileSystem</title></head>
<body>
    <?php
        $username = $_GET['user'];

        $h = fopen("/var/www/users.txt", "r");

        $linenum = 1;
        while( !feof($h) ){
            if ($username == fgets($h)){
                session_start();
                $user = @$_SESSION['user'];
                fclose($h);
                ?>
                <form action="action.php" method="GET">
                    <p>
                        <strong>What would you like to do?</strong>
                        <input type="radio" name="opperation" value="upload" id="upload" /> <label for="upload">Upload a file</label> &nbsp;
                        <input type="radio" name="opperation" value="view" id="view" /> <label for="view">View a file</label> &nbsp;
                        <input type="radio" name="opperation" value="delete" id="delete" /> <label for="delete">Delete a file</label> &nbsp;
                    </p>
                    <p>
                        <input type="submit" value="Send" />
                        <input type="reset" />
                    </p>
                </form>
                <?php
                    $opperation = @$_SESSION['opperation'];
                    break;
                    exit;
            }
        } 
    ?>
</body>
</html>

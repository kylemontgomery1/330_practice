<head><title>FileSystem</title></head>
<body>
    <?php
        session_start();
        $opperation = $_SESSION['opperation'];
        if ($opperation = "upload"){
            ?>
                <form enctype="multipart/form-data" action="action.php" method="POST">
	                <p>
		                <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		                <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	                </p>
	                <p>
		                <input type="submit" value="Upload File" />
	                </p>
                </form>
            <?php
                $filename = basename($_FILES['uploadedfile']['name']);
                if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                    echo "Invalid filename";
                    exit;
                }
                $username = $_SESSION['user'];
                if( !preg_match('/^[\w_\-]+$/', $username) ){
	                echo "Invalid username";
	                exit;
                }
                $full_path = sprintf("/svr/uploads/%s/%s", $username, $filename);
                if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
                    header("Location: upload_success.html");
                    exit;
                }else{
                    header("Location: upload_failure.html");
                    exit;
                }
        } elseif ($opperation = "view") {
            ?>
            <form action="landing.php" method="GET">
                <p>
                    <label for="filename">File name:</label>
                    <input type="text" name="file" id="filename"/>
                </p>
            </form>
            <?php
                session_start();

                $filename = $_GET['file'];
                
                // We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
                // To perform the check, we will use a regular expression.
                if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                    echo "Invalid filename";
                    exit;
                }
                
                // Get the username and make sure that it is alphanumeric with limited other characters.
                // You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
                // since we will be concatenating the string to load files from the filesystem.
                $username = $_SESSION['username'];
                if( !preg_match('/^[\w_\-]+$/', $username) ){
                    echo "Invalid username";
                    exit;
                }
                
                $full_path = sprintf("/svr/uploads/%s/%s", $username, $filename);
                
                // Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($full_path);
                
                // Finally, set the Content-Type header to the MIME type of the file, and display the file.
                header("Content-Type: ".$mime);
                header('content-disposition: inline; filename="'.$filename.'";');
                readfile($full_path);
        } else{
            ?>
            <form action="landing.php" method="GET">
                <p>
                    <label for="filename">File name:</label>
                    <input type="text" name="file" id="filename"/>
                </p>
            </form>
            <?php
                session_start();

                $filename = $_GET['file'];
                
                // We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
                // To perform the check, we will use a regular expression.
                if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
                    echo "Invalid filename";
                    exit;
                }
                
                // Get the username and make sure that it is alphanumeric with limited other characters.
                // You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
                // since we will be concatenating the string to load files from the filesystem.
                $username = $_SESSION['username'];
                if( !preg_match('/^[\w_\-]+$/', $username) ){
                    echo "Invalid username";
                    exit;
                }
                
                $full_path = sprintf("/svr/uploads/%s/%s", $username, $filename);
                unlink($full_path);
        }
     ?>
</body>
</html>   
    
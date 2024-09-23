<?php 
    session_start();
    $usernameCheck = $_SESSION['user_id'];

    //redirects user if login session is empty
    if(empty($usernameCheck)){
        header("Location: ../admin_index.php");
        // echo "session: ".$usernameCheck;
    }
?>
<?php 
    session_start();
    session_destroy();

    echo 'Logging Out...';

    header("Location: ../../user/user_index.php");
    exit();
?>
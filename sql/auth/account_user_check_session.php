<?php 
    session_start();
    
    //redirects user if login session is empty
    if(isset($_SESSION['user_id'])){
        header('Location: ../user/request.php');
        exit();
      }
?>

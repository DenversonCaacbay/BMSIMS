<?php 
    $pdo = require 'connection.php';
    session_start();
    $user = $_SESSION['user_id'];

    $name = '';
    $address = '';
    $email_address = '';
    $contact_number = '';

    $sql = 'UPDATE account SET name=:name WHERE acc_id='.$user;

    $statement = $pdo->prepare($sql);

    $update_user = [
        'name' => 'test',
    ];

    $statement->bindParam(':name', $update_user['name']);

    //change
    $update_user['name'] = $_POST['name'];

    //execute query
    $statement->execute();

    // alert msg
    echo "<script>
    alert('Profile Update Success!');
    window.location.href='../user_account.php';
   
    </script>";
    // header("Location: ../profile.php");

    exit();
?>
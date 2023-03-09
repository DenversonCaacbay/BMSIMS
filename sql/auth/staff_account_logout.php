<?php 
    session_start();

    // make a time out log
    $pdo = require '../config/connection.php';

    $sql_log = 'INSERT INTO tbl_logs_staff (acc_id, type) 
        VALUES (:acc_id, 0)';

    $statement_log = $pdo->prepare($sql_log);

    $new_log = [
        "acc_id" => 0,
    ];

    $statement_log->bindParam(':acc_id', $new_log['acc_id']);

    // real values
    $new_log['acc_id'] = $_SESSION['user_id'];

    // exec
    $statement_log->execute();

    session_destroy();

    echo 'Logging Out...';

    header("Location: ../../admin/index.php");
    exit();
?>
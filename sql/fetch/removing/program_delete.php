<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../../../sql/connection.php';

    $event_title = '';

    $id =  $_POST['delete'];

    $sql = "DELETE FROM tbl_programs WHERE program_id = :program_id";
    $sql2 = 'INSERT INTO tbl_logs_programs(acc_id, fullname, event_title, date_config, status) VALUES (:acc_id ,:fullname, :event_title, :date_config, :status)';

    $statement = $pdo->prepare($sql);
    $statement->bindParam('program_id', $id);


    $statement1 = $pdo->prepare($sql2);

    $newProd1 = [
        'acc_id' => 'zzz',
        'fullname' => 'zzz',
        'event_title' => 'zzz',
        'date_config' => 'zzz',
        'status' => 'zzz',
    ];

    $statement1->bindParam(':acc_id', $newProd1['acc_id']);
    $statement1->bindParam(':fullname', $newProd1['fullname']);
    $statement1->bindParam(':event_title', $newProd1['event_title']);
    $statement1->bindParam(':date_config', $newProd1['date_config']);
    $statement1->bindParam(':status', $newProd1['status']);

    //change
    $newProd1['acc_id'] = $_POST['acc_id'];
    $newProd1['fullname'] = $_POST['fullname'];
    $newProd1['event_title'] = $_POST['event_title'];
    $newProd1['date_config'] = $_POST['date_config'];
    $newProd1['status'] = $_POST['status'];
     //execute query
    
    // header("Location: ../../admin/manageprogram.php");
    // exit();
 

    if($statement->execute() && $statement1->execute()){
        echo'
        <script type="text/javascript">
            $(document).ready(function(){
        
            swal({
                position: "top-end",
                type: "success",
                title: "Program  Remove Successfully",
                showConfirmButton: false,
                timer: 1500
            }, function(){
                window.location.href="../../../admin/manageprogram.php";
            })
            });         
         </script>';
    
        return;
    }
    else{
        // echo "<script>
        // alert('Update Failed!');
        // window.location.href='../../../admin/manageprogram.php';
        // </script>";
    }


    // $id =  $_POST['delete'];

    // $sql = "DELETE FROM tbl_programs WHERE program_id = :program_id";



    // $statement = $pdo->prepare($sql);
    // $statement->bindParam('program_id', $id);

    // if($statement->execute()){
    //     header("Location: ../manageprogram.php");
    //     echo 'deleted!';
    // }
?>
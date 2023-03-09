<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    $id =  $_POST['update'];
    $data = [
        'acc_id' => 1,
        'password' => 'zzz',
        'fullname' => 'zzz',
    ];
    
    if($id == 1)
        {
            echo "<script>alert('This is an Admin Account');
                    window.location.href='../../admin/staff_accounts.php';
                    </script>";
        } 
    else{
    $sql = "UPDATE account SET password= :password WHERE fullname = :fullname";
    $sql2 = 'INSERT INTO tbl_logs_staff(acc_id, staff,username , fullname, password, date_config, status) VALUES (:acc_id ,:staff, :username, :fullname,:password, :date_config, :status)';
        
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':fullname', $data['fullname']);
    $statement->bindParam(':password', $data['password']);

    //change
    $data['fullname'] = $_POST['fullname'];
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $statement1 = $pdo->prepare($sql2);

    $newProd1 = [
        'acc_id' => 'zzz',
        'staff' => 'zzz',
        'username' => 'zzz',
        'fullname' => 'zzz',
        'password' => 'zzz',
        'date_config' => 'zzz',
        'status' => 'zzz',
    ];

    $statement1->bindParam(':acc_id', $newProd1['acc_id']);
    $statement1->bindParam(':staff', $newProd1['staff']);
    $statement1->bindParam(':username', $newProd1['username']);
    $statement1->bindParam(':fullname', $newProd1['fullname']);
    $statement1->bindParam(':password', $newProd1['password']);
    $statement1->bindParam(':date_config', $newProd1['date_config']);
    $statement1->bindParam(':status', $newProd1['status']);

    //change
    $newProd1['acc_id'] = $_POST['acc_id'];
    $newProd1['staff'] = $_POST['staff'];
    $newProd1['username'] = $_POST['username'];
    $newProd1['fullname'] = $_POST['fullname'];
    $newProd1['password'] = $_POST['password'];
    $newProd1['date_config'] = $_POST['date_config'];
    $newProd1['status'] = $_POST['status'];

    if($statement->execute() && $statement1->execute()){
        echo'
                <script type="text/javascript">

                $(document).ready(function(){

                swal({
                    position: "top-end",
                    type: "success",
                    title: "Password Updated Successfully",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                    window.location.href="../../admin/staff_accounts.php";
                })
                });
                
                </script>';

return;
    }
    else{
        echo'
        <script type="text/javascript">

        $(document).ready(function(){

        swal({
            position: "top-end",
            type: "Error",
            title: "Password Updated Failed",
            showConfirmButton: false,
            timer: 1500
        }, function(){
            window.location.href="../../admin/staff_accounts.php";
        })
        });
        
        </script>';

return;
    }
}

?>
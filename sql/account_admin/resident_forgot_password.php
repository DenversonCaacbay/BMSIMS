<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../config/connection.php';

    $data = [
        'acc_id' => 1,
        'password' => 'zzz',
    ];

    $sql = "UPDATE tbl_resident SET password= :password WHERE firstname = :firstname";
    $sql2 = 'INSERT INTO tbl_logs_resident(firstname,lastname, admin_power) VALUES ( :firstname,:lastname ,:admin_power)';
 
    $statement = $pdo->prepare($sql);

    $statement->bindParam(':firstname', $data['firstname']);
    $statement->bindParam(':password', $data['password']);

    //change
    $data['firstname'] = $_POST['firstname'];
    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement2 = $pdo->prepare($sql2);

    $newProd2 = [
        'firstname' => 'zzz',
        'lastname' => 'zzz',
        'admin_power' => 'zzz',
    ];


    $statement2->bindParam(':firstname', $newProd2['firstname']);
    $statement2->bindParam(':lastname', $newProd2['lastname']);
    $statement2->bindParam(':admin_power', $newProd2['admin_power']);

    //change

    $newProd2['firstname'] = $_POST['firstname'];
    $newProd2['lastname'] = $_POST['lastname'];
    $newProd2['admin_power'] = $_POST['admin_power'];

            if($statement->execute() && $statement2->execute()){
                echo'
                        <script type="text/javascript">
    
                        $(document).ready(function(){
    
                        swal({
                            position: "top-end",
                            type: "success",
                            title: "Update Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }, function(){
                            window.location.href="../../admin/resident_accounts.php";
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
                            title: "Update Failed",
                            showConfirmButton: false,
                            timer: 1500
                        }, function(){
                            window.location.href="../../admin/resident_accounts.php";
                        })
                        });
                        
                        </script>';
    
    return;
                    }

?>  
<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../../config/connection.php';

    $id =  $_POST['delete'];

    $sql = "DELETE FROM tbl_officials WHERE official_id = :official_id";
    // $sql2 = 'INSERT INTO tbl_logs_official(acc_id, staff,position, firstname, middlename, lastname, phone, purok, date_config, status) VALUE (:acc_id, :staff, :position ,:firstname, :middlename, :lastname, :phone, :purok,  :date_config, :status)';

    $statement = $pdo->prepare($sql);
    $statement->bindParam('official_id', $id);

    // $statement2 = $pdo->prepare($sql2);

    //         $newProd2 = [
    //             'acc_id' => 'zzz',
    //             'staff' => 'zzz',
    //             'position' => 'zzz',
    //             'firstname' => 'zzz',
    //             'middlename' => 'zzz',
    //             'lastname' => 'zzz',
    //             'date_config' => 'zzz',
    //             'status' => 'zzz',
                
    //         ];

    //         $statement2->bindParam(':acc_id', $newProd2['acc_id']);
    //         $statement2->bindParam(':staff', $newProd2['staff']);
    //         $statement2->bindParam(':position', $newProd2['position']);
    //         $statement2->bindParam(':firstname', $newProd2['firstname']);
    //         $statement2->bindParam(':middlename', $newProd2['middlename']);
    //         $statement2->bindParam(':lastname', $newProd2['lastname']);
    //         $statement2->bindParam(':date_config', $newProd2['date_config']);
    //         $statement2->bindParam(':status', $newProd2['status']);

    //         //change
    //         $newProd2['acc_id'] = $_POST['acc_id'];
    //         $newProd2['staff'] = $_POST['staff'];
    //         $newProd2['position'] = $_POST['position'];
    //         $newProd2['firstname'] = $_POST['firstname'];
    //         $newProd2['middlename'] = $_POST['middlename'];
    //         $newProd2['lastname'] = $_POST['lastname'];
    //         $newProd2['date_config'] = $_POST['date_config'];
    //         $newProd2['status'] = $_POST['status'];

            if($statement->execute()){
                echo'
                        <script type="text/javascript">
    
                        $(document).ready(function(){
    
                        swal({
                            position: "top-end",
                            type: "success",
                            title: "Official  Remove Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }, function(){
                            window.location.href="../../../admin/barangayofficial.php";
                        })
                        });
                        
                        </script>';
    
    return;
            }
?> 
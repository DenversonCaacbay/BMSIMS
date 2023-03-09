<?php 
    $pdo = require '../../connection.php';

    $data = [
        'official_id' => 1,
        'position' => 'zzz',
        'firstname' => 'zzz',
        'middlename' => 'zzz',
        'lastname' => 'zzz',
        'phone' => 'zzz',
        'purok' => 'zzz',
        'start_term' => 'zzz',
        'start_term' => 999,
    ];

    $sql = "UPDATE tbl_officials SET position = :position, firstname = :firstname, middlename = :middlename, lastname = :lastname, phone = :phone, purok = :purok,  start_term = :start_term, end_term = :end_term WHERE official_id = :official_id";
    $sql2 = 'INSERT INTO tbl_logs_official(acc_id, staff,position, firstname, middlename, lastname, phone, purok, date_config, status) VALUE (:acc_id, :staff, :position ,:firstname, :middlename, :lastname, :phone, :purok,  :date_config, :status)';

    $statement = $pdo->prepare($sql);

    $statement->bindParam(':official_id', $data['official_id']);
    $statement->bindParam(':position', $data['position']);
    $statement->bindParam(':firstname', $data['firstname']);
    $statement->bindParam(':middlename', $data['middlename']);
    $statement->bindParam(':lastname', $data['lastname']);

    //change
    $data['official_id'] = $_POST['official_id'];
    $data['position'] = $_POST['position'];
    $data['firstname'] = $_POST['firstname'];
    $data['middlename'] = $_POST['middlename'];
    $data['lastname'] = $_POST['lastname'];

    $statement2 = $pdo->prepare($sql2);

    $newProd2 = [
        'acc_id' => 'zzz',
        'staff' => 'zzz',
        'position' => 'zzz',
        'firstname' => 'zzz',
        'middlename' => 'zzz',
        'lastname' => 'zzz',
        'date_config' => 'zzz',
        'status' => 'zzz',
        
    ];

    $statement2->bindParam(':acc_id', $newProd2['acc_id']);
    $statement2->bindParam(':staff', $newProd2['staff']);
    $statement2->bindParam(':position', $newProd2['position']);
    $statement2->bindParam(':firstname', $newProd2['firstname']);
    $statement2->bindParam(':middlename', $newProd2['middlename']);
    $statement2->bindParam(':lastname', $newProd2['lastname']);
    $statement2->bindParam(':date_config', $newProd2['date_config']);
    $statement2->bindParam(':status', $newProd2['status']);

    //change
    $newProd2['acc_id'] = $_POST['acc_id'];
    $newProd2['staff'] = $_POST['staff'];
    $newProd2['position'] = $_POST['position'];
    $newProd2['firstname'] = $_POST['firstname'];
    $newProd2['middlename'] = $_POST['middlename'];
    $newProd2['lastname'] = $_POST['lastname'];
    $newProd2['date_config'] = $_POST['date_config'];
    $newProd2['status'] = $_POST['status'];

    if($statement->execute() && $statement2->execute()){
        echo'
                <script type="text/javascript">

                $(document).ready(function(){

                swal({
                    position: "top-end",
                    type: "success",
                    title: "Official Update Successfully",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                    window.location.href="../../../admin/resident_accounts.php";
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
                    type: "success",
                    title: "Official  Update Failed",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                    window.location.href="../../../admin/resident_accounts.php";
                })
                });
                
                </script>';
                return;
    }

?>
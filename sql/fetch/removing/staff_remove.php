<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../../../sql/connection.php';

    $event_title = '';
    $id =  $_POST['delete'];
    if($id == 1)
    {
        echo'
        <script type="text/javascript">

        $(document).ready(function(){

        swal({
            position: "top-end",
            type: "warning",
            title: "Admin Cant be Deleted",
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
        
        $data = [
            'acc_id' => 1,
            'remove' => 1,
            'user_id' =>1,
            'fullname'=>'zzz'

        ];
        $sql = "UPDATE account SET remove = :remove WHERE fullname = :fullname";
        $sql2 = 'INSERT INTO tbl_logs_staff(acc_id, staff, fullname, date_config, status) VALUES (:acc_id ,:staff, :fullname, :date_config, :status)';

        $statement = $pdo->prepare($sql);

        $statement->bindParam(':fullname', $data['fullname']);
        $statement->bindParam(':remove', $data['remove']);

        //change
        $data['fullname'] = $_POST['fullname'];

        if($_POST['remove'] == '1')
                {
                    $_POST['remove'] = "0";
                }
        $data['remove'] = $_POST['remove'];

        $statement1 = $pdo->prepare($sql2);

        $newProd1 = [
            'acc_id' => 'zzz',
            'staff' => 'zzz',
            'fullname' => 'zzz',
            'date_config' => 'zzz',
            'status' => 'zzz',
        ];

        $statement1->bindParam(':acc_id', $newProd1['acc_id']);
        $statement1->bindParam(':staff', $newProd1['staff']);
        $statement1->bindParam(':fullname', $newProd1['fullname']);
        $statement1->bindParam(':date_config', $newProd1['date_config']);
        $statement1->bindParam(':status', $newProd1['status']);

        //change
        $newProd1['acc_id'] = $_POST['acc_id'];
        $newProd1['staff'] = $_POST['staff'];
        $newProd1['fullname'] = $_POST['fullname'];
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
                title: "Remove Successfully",
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

        }


    }
?>
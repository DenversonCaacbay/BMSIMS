<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../../../../config/connection.php';

    $data = [
        'req_id' => 1,
        'amount' => 'zzz',
        'payment_status' => 'zzz',
        'request_status' => 'zzz',
    ];


    $sql = "UPDATE tbl_request SET request_status = :request_status WHERE req_id = :req_id";
    $sql2 = 'INSERT INTO tbl_logs_request(staff,fullname, request_type, status) VALUES (:staff,:fullname, :request_type, :status )';
    $sql3 = 'INSERT INTO tbl_invoice(staff, tracking_id, fullname, request_type, get_date, payment_method, amount, date_paid, request_status) VALUES (:staff, :tracking_id ,:fullname, :request_type, :get_date, :payment_method, :amount, :date_paid, :request_status)';


    $statement = $pdo->prepare($sql);

    $statement->bindParam(':req_id', $data['req_id']);
    $statement->bindParam(':request_status', $data['request_status']);

    //change
    $data['req_id'] = $_POST['req_id'];
    $data['request_status'] = $_POST['request_status'];

    $statement2 = $pdo->prepare($sql2);

 
    $newProd1 = [
        'staff' => 'zzz',
        'fullname' => 'zzz',
        'request_type' => 'zzz',
        'status' => 'zzz',
    ];
    $statement2->bindParam(':staff', $newProd1['staff']);
    $statement2->bindParam(':fullname', $newProd1['fullname']);
    $statement2->bindParam(':request_type', $newProd1['request_type']);
    $statement2->bindParam(':status', $newProd1['status']);     
    //change
    $newProd1['staff'] = $_POST['staff'];
    $newProd1['fullname'] = $_POST['fullname'];
    $newProd1['request_type'] = $_POST['request_type'];
    $newProd1['status'] = $_POST['status'];

    // execute query
    // $statement->execute();
    if($statement->execute() && $statement2->execute()){
        echo'
                <script type="text/javascript">

                $(document).ready(function(){

                swal({
                    position: "top-end",
                    type: "success",
                    title: "Request Update Successfully",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                     window.location.href="../../../../../staff/indigency/indigency_pickup/done.php";
                })
                });
                
                </script>';

return;
    }
            
            exit();

    // if($statement->execute() && $statement1->execute()){
         echo "<script>
        alert('Update Failed!');
        window.location.href='../../../staff/barangay_clearance.php';
        </script>";
        // echo'
        // <script type="text/javascript">
        //     $(document).ready(function(){
        //         swal({
        //             position: "top-end",
        //             type: "success",
        //             title: "Update Status Successfully",
        //             showConfirmButton: false,
        //             timer: 1500
        //         }, function(){
        //             window.location.href="../../staff/barangay_clearance.php";
        //         })
        //     });
        //     </script>';
        //     return;
    // }
    // else{
    //     // echo "<script>
    //     // alert('Update Failed!');
    //     // window.location.href='../../../staff/barangay_clearance.php';
    //     // </script>";
    // }

?>
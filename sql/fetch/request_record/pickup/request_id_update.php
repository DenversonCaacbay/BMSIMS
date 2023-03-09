<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../../../config/connection.php';

    $data = [
        'req_id' => 1,
        'amount' => 'zzz',
        'payment_status' => 'zzz',
        'request_status' => 'zzz',
    ];
 

    $sql = "UPDATE tbl_request SET amount= :amount,date_paid= :date_paid, payment_status= :payment_status, request_status = :request_status WHERE req_id = :req_id";
    $sql2 = 'INSERT INTO tbl_logs_request(staff,fullname, request_type, status) VALUES (:staff,:fullname, :request_type, :status )';
    $sql3 = 'INSERT INTO tbl_invoice(staff, tracking_id, fullname, request_type,payment_method, amount, date_paid, request_status) VALUES (:staff, :tracking_id ,:fullname, :request_type, :payment_method, :amount, :date_paid, :request_status)';


    $statement = $pdo->prepare($sql);

    $statement->bindParam(':req_id', $data['req_id']);
    $statement->bindParam(':amount', $data['amount']);
    $statement->bindParam(':date_paid', $data['date_paid']);
    $statement->bindParam(':payment_status', $data['payment_status']);
    $statement->bindParam(':request_status', $data['request_status']);

    //change
    $data['req_id'] = $_POST['req_id'];
    $data['amount'] = $_POST['amount'];
    if($_POST['payment_status'] == 'Not Paid')
    {
        $_POST['date_paid'] = "None";
    }
    else{$data['date_paid'] = $_POST['date_paid'];}
    
    $data['payment_status'] = $_POST['payment_status'];

    if($_POST['request_status'] == 'Get Record'){
        // INSERT IN INVOICE TABLE
        $statement3 = $pdo->prepare($sql3);
        $newProd2 = [
            'staff' => 'zzz',
            'tracking_id' => 'zzz',
            'fullname' => 'zzz',
            'request_type' => 'zzz',
            'payment_method' => 'zzz',
            'amount' => 'zzz',
            'date_paid' => 'zzz',
            'request_status' => 'zzz',
        ];
        $statement3->bindParam(':staff', $newProd2['staff']);
        $statement3->bindParam(':tracking_id', $newProd2['tracking_id']);
        $statement3->bindParam(':fullname', $newProd2['fullname']);
        $statement3->bindParam(':request_type', $newProd2['request_type']);
        $statement3->bindParam(':payment_method', $newProd2['payment_method']);
        $statement3->bindParam(':amount', $newProd2['amount']);
        $statement3->bindParam(':date_paid', $newProd2['date_paid']);
        $statement3->bindParam(':request_status', $newProd2['request_status']); 
            
            //change
        $newProd2['staff'] = $_POST['staff'];
        $newProd2['tracking_id'] = $_POST['tracking_id'];
        $newProd2['fullname'] = $_POST['fullname'];
        $newProd2['request_type'] = $_POST['request_type'];
        $newProd2['payment_method'] = $_POST['payment_method'];
        $newProd2['amount'] = $_POST['amount'];
        $newProd2['date_paid'] = $_POST['date_paid'];
        $newProd2['request_status'] = $_POST['request_status'];
        $statement3->execute();

    }
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
                     window.location.href="../../../../staff/barangay_id/barangay_id_pickup/get_record.php";
                })
                });
                
                </script>';

return;
    }
            
            exit();

    // if($statement->execute() && $statement1->execute()){
         echo "<script>
        alert('Update Failed!');
        window.location.href='../../../staff/barangay_id.php';
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
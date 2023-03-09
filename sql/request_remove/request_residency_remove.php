<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
     $pdo = require '../connection.php';

    $id =  $_POST['delete'];

    $sql = "DELETE FROM tbl_request WHERE req_id = :req_id";
    // $sql2 = 'INSERT INTO tbl_logs_request(staff, req_id, tracking_id, req_date, fullname, request_type, purpose, date_open, date_close, get_date, payment_method, reference_no, amount, date_paid, payment_status, request_status, username, config_date, status) VALUES (:staff, :req_id, :tracking_id, :req_date ,:fullname, :request_type, :purpose, :date_open, :date_close, :get_date, :payment_method,:reference_no,:amount,:date_paid, :payment_status, :request_status, :username, :config_date, :status)';
       $sql2 = 'INSERT INTO tbl_logs_request(staff, req_id, tracking_id, req_date, fullname, request_type, purpose, date_open, date_close, get_date, payment_method, reference_no, amount, date_paid, payment_status, request_status, username, date_config, status) VALUES (:staff, :req_id, :tracking_id, :req_date ,:fullname, :request_type,:purpose, :date_open, :date_close, :get_date, :payment_method, :reference_no, :amount, :date_paid, :payment_status, :request_status, :username, :date_config, :status )';

    $statement = $pdo->prepare($sql);
    $statement->bindParam('req_id', $id);

    $statement2 = $pdo->prepare($sql2);


    $newProd1 = [
        'staff' => 'zzz',
        'req_id' => 'zzz',
        'tracking_id' => 'zzz',
        'req_date' => 'zzz',
        'fullname' => 'zzz',
        'request_type' => 'zzz',
        'purpose' => 'zzz',
        'date_open' => 'zzz',
        'date_close' => 'zzz',
        'get_date' => 'zzz',
        'payment_method' => 'zzz',
        'reference_no' => 'zzz',
        'amount' => 'zzz',
        'date_paid' => 'zzz',
        'payment_status' => 'zzz',
        'request_status' => 'zzz',
        'username' => 'zzz',
        'date_config' => 'zzz',
        'status' => 'zzz',
    ];
    $statement2->bindParam(':staff', $newProd1['staff']);
    $statement2->bindParam(':req_id', $newProd1['req_id']);
    $statement2->bindParam(':tracking_id', $newProd1['tracking_id']);
    $statement2->bindParam(':req_date', $newProd1['req_date']);
    $statement2->bindParam(':fullname', $newProd1['fullname']);
    $statement2->bindParam(':request_type', $newProd1['request_type']);
    $statement2->bindParam(':purpose', $newProd1['purpose']);
    $statement2->bindParam(':date_open', $newProd1['date_open']);
    $statement2->bindParam(':date_close', $newProd1['date_close']);
    $statement2->bindParam(':get_date', $newProd1['get_date']);
    $statement2->bindParam(':payment_method', $newProd1['payment_method']);
    $statement2->bindParam(':reference_no', $newProd1['reference_no']);
    $statement2->bindParam(':amount', $newProd1['amount']);
    $statement2->bindParam(':date_paid', $newProd1['date_paid']);
    $statement2->bindParam(':payment_status', $newProd1['payment_status']);
    $statement2->bindParam(':request_status', $newProd1['request_status']);
    $statement2->bindParam(':username', $newProd1['username']);     
    $statement2->bindParam(':date_config', $newProd1['date_config']);     
    $statement2->bindParam(':status', $newProd1['status']);     
       
    //change
    $newProd1['staff'] = $_POST['staff'];
    $newProd1['req_id'] = $_POST['req_id'];
    $newProd1['tracking_id'] = $_POST['tracking_id'];
    $newProd1['req_date'] = $_POST['req_date'];
    $newProd1['fullname'] = $_POST['fullname'];
    $newProd1['request_type'] = $_POST['request_type'];
    $newProd1['purpose'] = $_POST['purpose'];
    $newProd1['date_open'] = $_POST['date_open'];
    $newProd1['date_close'] = $_POST['date_close'];
    $newProd1['get_date'] = $_POST['get_date'];
    $newProd1['payment_method'] = $_POST['payment_method'];
    $newProd1['reference_no'] = $_POST['reference_no'];
    $newProd1['amount'] = $_POST['amount'];
    $newProd1['date_paid'] = $_POST['date_paid'];
    $newProd1['payment_status'] = $_POST['payment_status'];
    $newProd1['request_status'] = $_POST['request_status'];
    $newProd1['username'] = $_POST['username'];
    $newProd1['date_config'] = $_POST['date_config'];
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
                    title: "Request Remove Successfully",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                     window.location.href="../../staff/residency.php";
                })
                });
                
                </script>';

return;
    }
?>
<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    require '../config/code_gen.php';

    $req_date = '';
    $get_date = '';
    $reference_no = '';
    $username = '';

 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $reference_no = $_POST['reference_no'];

         // check for dup prod name
         $searchDate = "SELECT * FROM tbl_request WHERE username='".$username."' AND request_type='Indigency' AND request_status = 'Please Wait'";
         $statement1 = $pdo->query($searchDate);
         $productInfo1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
         $countProd1 = $statement1->rowCount();
         
        if($countProd1 > 0){
            echo'
            <script type="text/javascript">
            $(document).ready(function(){
            swal({
                position: "top-end",
                type: "warning",
                title: "You have a pending Request Wait for it to be approved!!",
                showConfirmButton: false,
                timer: 1500
            }, function(){
                window.location.href="../../user/request.php";
            })
            });       
            </script>';
            return;
         }
        else{
 
            $sql = 'INSERT INTO tbl_request(tracking_id,req_date, fullname, request_type, purpose, date_open, date_close, get_date, payment_method,reference_no,amount,date_paid, payment_status, request_status,username) 
            VALUES (:tracking_id,:req_date ,:fullname, :request_type, :purpose, :date_open, :date_close, :get_date, :payment_method,:reference_no,:amount,:date_paid, :payment_status, :request_status,:username)';

            $statement = $pdo->prepare($sql);


            $newProd = [
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
            ];
            $statement->bindParam(':tracking_id', $newProd['tracking_id']);
            $statement->bindParam(':req_date', $newProd['req_date']);
            $statement->bindParam(':fullname', $newProd['fullname']);
            $statement->bindParam(':request_type', $newProd['request_type']);
            $statement->bindParam(':purpose', $newProd['purpose']);
            $statement->bindParam(':date_open', $newProd['date_open']);
            $statement->bindParam(':date_close', $newProd['date_close']);
            $statement->bindParam(':get_date', $newProd['get_date']);
            $statement->bindParam(':payment_method', $newProd['payment_method']);
            $statement->bindParam(':reference_no', $newProd['reference_no']);
            $statement->bindParam(':amount', $newProd['amount']);
            $statement->bindParam(':date_paid', $newProd['date_paid']);
            $statement->bindParam(':payment_status', $newProd['payment_status']);
            $statement->bindParam(':request_status', $newProd['request_status']);
            $statement->bindParam(':username', $newProd['username']);        
   

            //change
            $newProd['tracking_id'] = generateCode();
            $newProd['req_date'] = $_POST['req_date'];
            $newProd['fullname'] = $_POST['fullname'];
            $newProd['request_type'] = $_POST['request_type'];
            $newProd['purpose'] = $_POST['purpose'];
            $newProd['date_open'] = $_POST['date_open'];
            $newProd['date_close'] = $_POST['date_close'];
            $newProd['get_date'] = $_POST['get_date'];
            $newProd['payment_method'] = $_POST['payment_method'];


            if(empty($_POST['reference_no']))
            {
                $_POST['reference_no'] = "N/A";
            }

            $newProd['reference_no'] = $_POST['reference_no'];

            if($_POST['payment_method'] == 'Pick Up')
            {
                $_POST['amount'] = "0";
            }
            // echo "test: ".$newProd['reference_no'];
            $newProd['amount'] = $_POST['amount'];

            if($_POST['payment_method'] == 'Pick Up' || $_POST['payment_method'] == 'N/A' )
            {
                $_POST['date_paid'] = "N/A";
            }
            $newProd['date_paid'] = $_POST['date_paid'];
            $newProd['payment_status'] = $_POST['payment_status'];
            $newProd['request_status'] = $_POST['request_status'];
            $newProd['username'] = $_POST['username'];


            // execute query
            $statement->execute();
            echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "success",
                        title: "Request Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/my_request.php";
                    })
                    });
                    
                    </script>';

                    return;
            exit();
        }
   }


?> 
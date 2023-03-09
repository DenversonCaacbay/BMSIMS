<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../connection.php';

    //
    // $product_name = '';
    $event_title = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $event_title = $_POST['event_title'];

        // check for dup prod name
        $searchProduct = "SELECT * FROM tbl_programs WHERE event_title = '".$event_title."' ";
        $statement = $pdo->query($searchProduct);
        $productInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        $countProd = $statement->rowCount();
        
        if($countProd > 0){
            echo "<script>alert('Event is already Posted!');
            window.location.href='../../admin/manageprogram.php';
            </script>";
        }
        else{
            // insert product
            $sql = 'INSERT INTO tbl_programs(event_title, event_datetime, place, description) VALUES (:event_title ,:event_datetime, :place, :description)';
            $sql2 = 'INSERT INTO tbl_logs_programs(acc_id, fullname, event_title, date_config, status) VALUES (:acc_id ,:fullname, :event_title, :date_config, :status)';

            $statement = $pdo->prepare($sql);

            $newProd = [
                'event_title' => 'zzz',
                'event_datetime' => 'zzz',
                'place' => 'zzz',
                'description' => 'zzz',
                'remove' => 1,
            ];

            $statement->bindParam(':event_title', $newProd['event_title']);
            $statement->bindParam(':event_datetime', $newProd['event_datetime']);
            $statement->bindParam(':place', $newProd['place']);
            $statement->bindParam(':description', $newProd['description']);

            //change
            $newProd['event_title'] = $_POST['event_title'];
            $newProd['event_datetime'] = $_POST['event_datetime'];
            $newProd['place'] = $_POST['place'];
            $newProd['description'] = $_POST['description'];

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
                        window.location.href="../../admin/manageprogram.php";
                    })
                    });         
                 </script>';
                
                return;
            }
        }
    }


?>
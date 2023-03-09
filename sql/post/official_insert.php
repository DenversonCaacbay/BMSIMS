<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<?php 
    $pdo = require '../config/connection.php';

    //
    // $product_name = '';
     $position = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $position = $_POST['position'];

        // check for dup prod name
        $searchProduct = "SELECT * FROM tbl_officials WHERE position = '".$position."' ";
        $statement = $pdo->query($searchProduct);
        $productInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        $countProd = $statement->rowCount();
        
        if($countProd > 0){
            echo'
            <script type="text/javascript">
            $(document).ready(function(){
            swal({
                position: "top-end",
                type: "warning",
                title: "Position is already Occupied",
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
            // insert product
            $sql = 'INSERT INTO tbl_officials(position, firstname, middlename, lastname) VALUES (:position ,:firstname, :middlename, :lastname)';
            $sql2 = 'INSERT INTO tbl_logs_official(acc_id, staff, position, firstname, middlename, lastname,date_config, status) VALUES (:acc_id, :staff, :position ,:firstname, :middlename, :lastname,:date_config, :status)';

            $statement = $pdo->prepare($sql);

            $newProd = [
                'position' => 'zzz',
                'firstname' => 'zzz',
                'middlename' => 'zzz',
                'lastname' => 'zzz',
            ];

            $statement->bindParam(':position', $newProd['position']);
            $statement->bindParam(':firstname', $newProd['firstname']);
            $statement->bindParam(':middlename', $newProd['middlename']);
            $statement->bindParam(':lastname', $newProd['lastname']);

            //change
            $newProd['position'] = $_POST['position'];
            $newProd['firstname'] = $_POST['firstname'];
            $newProd['middlename'] = $_POST['middlename'];
            $newProd['lastname'] = $_POST['lastname'];

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

                //execute query
            $statement->execute();
            $statement2->execute();
            // header("Location: ../../admin/barangayofficial.php");

            echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "success",
                        title: "Added Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/barangayofficial.php";
                    })
                    });
                    
                    </script>';

            return;
            exit();
            }
    }


?>
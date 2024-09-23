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
        $feedback = $_POST['feedback'];


        // check for dup prod name
        $searchProduct = "SELECT * FROM feedbacks WHERE feedback = '".$feedback."' ";
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
                window.location.href="../../admin/barangayofficial.php";
            })
            });       
            </script>';
            return;
        }
        else{
            // insert product
            $sql = 'INSERT INTO feedbacks( feedback, email) VALUES ( :feedback, :email)';
            // $sql2 = 'INSERT INTO tbl_logs_official(acc_id, staff, position, firstname, middlename, lastname,date_config, status) VALUES (:acc_id, :staff, :position ,:firstname, :middlename, :lastname,:date_config, :status)';

            $statement = $pdo->prepare($sql);

            $newProd = [
                'feedback' => 'zzz',
                'email' => 'zzz',
            ];


            $statement->bindParam(':feedback', $newProd['feedback']);
            $statement->bindParam(':email', $newProd['email']);

            //change

            $newProd['feedback'] = $_POST['feedback'];
            $newProd['email'] = $_POST['email'];

            // $statement2 = $pdo->prepare($sql2);

                //execute query
            $statement->execute();
            // $statement2->execute();
            // header("Location: ../../admin/barangayofficial.php");

            echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "success",
                        title: "Thank you For Feedback",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/user_profile.php";
                    })
                    });
                    
                    </script>';

            return;
            exit();
            }
    }


?>
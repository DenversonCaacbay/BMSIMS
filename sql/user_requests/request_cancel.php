<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';

    $id =  $_POST['delete'];

    $sql = "DELETE FROM tbl_request WHERE req_id = :req_id";

    $statement = $pdo->prepare($sql);
    $statement->bindParam('req_id', $id);

    if($statement->execute()){
        echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "warning",
                        title: "Request Canceled",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/my_request.php";
                    })
                    });
                    
                    </script>';

return;
        
    }
?>
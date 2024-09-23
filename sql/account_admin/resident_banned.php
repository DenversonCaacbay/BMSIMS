<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head> 
<?php 
    $pdo = require '../config/connection.php';

    $data = [
        'acc_id' => 1,
        'access' => 'zzz',
        // 'created_at' => 'zzz',
    ];

    $sql = "UPDATE resident_accounts SET access= :access WHERE fname = :fname";
    // $sql2 = 'INSERT INTO tbl_logs_resident(firstname,lastname, admin_power) VALUES ( :firstname,:lastname ,:admin_power)';

    $statement = $pdo->prepare($sql);

    $statement->bindParam(':fname', $data['fname']);
    $statement->bindParam(':access', $data['access']);
    // $statement->bindParam(':created_at', $data['created_at']);

    //change
    $data['fname'] = $_POST['fname'];
    $data['access'] = $_POST['access'];
    // $data['created_at'] = $_POST['created_at'];

    
    // $statement2 = $pdo->prepare($sql2);

    // $newProd2 = [
    //     'firstname' => 'zzz',
    //     'lastname' => 'zzz',
    //     'admin_power' => 'zzz',
    // ];


    // $statement2->bindParam(':firstname', $newProd2['firstname']);
    // $statement2->bindParam(':lastname', $newProd2['lastname']);
    // $statement2->bindParam(':admin_power', $newProd2['admin_power']);

    // //change

    // $newProd2['firstname'] = $_POST['firstname'];
    // $newProd2['lastname'] = $_POST['lastname'];
    // $newProd2['admin_power'] = $_POST['admin_power'];
// && $statement2->execute()
    if($statement->execute()){ 
        echo'
        <script type="text/javascript">
        $(document).ready(function(){
        swal({
            position: "top-end",
            type: "success",
            title: "Update Successfully",
            showConfirmButton: false,
            timer: 1500
        }, function(){
            window.location.href="../../admin/banned_accounts.php";
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
            type: "Error",
            title: "Update Failed",
            showConfirmButton: false,
            timer: 1500
        }, function(){
            window.location.href="../../admin/resident_accounts.php";
        })
        });    
        </script>';
        return;
    }
?>  
<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    session_start();
    $user = $_SESSION['user_id'];

    $sql = 'UPDATE resident_accounts 
        SET  fname = :fname, mname = :mname, lname = :lname, gender = :gender, pob = :pob, bdate = :bdate,age = :age, status = :status, street = :street, purok = :purok,email = :email , contact = :contact WHERE res_id ='.$user;

    $statement = $pdo->prepare($sql);
    $data = [
        'fname' => 'zzz',
        'mname' => 'zzz',
        'lname' => 'zzz',
        'gender' => 'placeholder',
        'pob' => 'zzz',
        'bdate' => 'zzz',
        'age' => 'zzz',
        'status' => 'zzz',
        'street' => 'zzz',
        'purok' => 'zzz',
        'email' => 'zzz',
        'contact' => 999,
         
    ];
    $statement->bindParam(':fname', $data['fname']);
    $statement->bindParam(':mname', $data['mname']);
    $statement->bindParam(':lname', $data['lname']);
    $statement->bindParam(':gender', $data['gender']);
    $statement->bindParam(':pob', $data['pob']);
    $statement->bindParam(':bdate', $data['bdate']);
    $statement->bindParam(':age', $data['age']);
    $statement->bindParam(':status', $data['status']);
    $statement->bindParam(':street', $data['street']);
    $statement->bindParam(':purok', $data['purok']);
    $statement->bindParam(':email', $data['email']);
    $statement->bindParam(':contact', $data['contact']);


    //change
    $data['fname'] = $_POST['fname'];
    $data['mname'] = $_POST['mname'];
    $data['lname'] = $_POST['lname'];
    $data['gender'] = $_POST['gender'];
    $data['pob'] = $_POST['pob'];
    $data['bdate'] = $_POST['bdate'];
    $data['age'] = $_POST['age'];
    $data['status'] = $_POST['status'];
    $data['street'] = $_POST['street'];
    $data['purok'] = $_POST['purok'];
    $data['email'] = $_POST['email'];
    $data['contact'] = $_POST['contact'];


    if($statement->execute()){
        echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "success",
                        title: "Profile Updated Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/user_profile.php";
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
                        type: "warning",
                        title: "Update Failed",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/user_profile.php";
                    })
                    });
                    
                    </script>';

return;
    }

?> 
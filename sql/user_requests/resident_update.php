<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    session_start();
    $user = $_SESSION['user_id'];

    $sql = 'UPDATE tbl_resident 
        SET  firstname = :firstname, middlename = :middlename, lastname = :lastname, gender = :gender,place_of_birth = :place_of_birth, bdate = :bdate, civil_status = :civil_status, address = :address, purok = :purok,email = :email , phone = :phone WHERE acc_id ='.$user;

    $statement = $pdo->prepare($sql);
    $data = [
        'firstname' => 'zzz',
        'middlename' => 'zzz',
        'lastname' => 'zzz',
        'gender' => 'placeholder',
        'place_of_birth' => 'zzz',
        'bdate' => 'zzz',
        'civil_status' => 'zzz',
        'address' => 'zzz',
        'purok' => 'zzz',
        'email' => 'zzz',
        'phone' => 999,
         
    ];
    $statement->bindParam(':firstname', $data['firstname']);
    $statement->bindParam(':middlename', $data['middlename']);
    $statement->bindParam(':lastname', $data['lastname']);
    $statement->bindParam(':gender', $data['gender']);
    $statement->bindParam(':place_of_birth', $data['place_of_birth']);
    $statement->bindParam(':bdate', $data['bdate']);
    $statement->bindParam(':civil_status', $data['civil_status']);
    $statement->bindParam(':address', $data['address']);

    $statement->bindParam(':purok', $data['purok']);
    $statement->bindParam(':email', $data['email']);
    $statement->bindParam(':phone', $data['phone']);


    //change
    $data['firstname'] = $_POST['firstname'];
    $data['middlename'] = $_POST['middlename'];
    $data['lastname'] = $_POST['lastname'];
    $data['place_of_birth'] = $_POST['place_of_birth'];
    $data['bdate'] = $_POST['bdate'];
    $data['civil_status'] = $_POST['civil_status'];
    $data['address'] = $_POST['address'];
    $data['gender'] = $_POST['gender'];
    $data['purok'] = $_POST['purok'];
    $data['email'] = $_POST['email'];
    $data['phone'] = $_POST['phone'];


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
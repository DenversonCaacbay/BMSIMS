<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    //require 'code_gen.php';

    $username = '';
    $fullname = '';
    $address = '';
    $email_address = '';
    $password = '';
    $confirmPass = '';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPass'];

        $sqlAdmin ="SELECT * FROM account";
        $statement = $pdo->query($sqlAdmin);
        $admin = $statement->fetchAll(PDO::FETCH_ASSOC);
        $admin_count = $statement->rowCount();

        if($admin_count > 2)
        {
            echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "warning",
                        title: "3 Users Only",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/staff_accounts.php";
                    })
                    });
                    
                    </script>';

return;
        }

        else{
            $userSearch = "SELECT * FROM account WHERE username = '".$username."' ";
            $statement = $pdo->query($userSearch);
            $userInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();
            if($password == $confirmPass){
                if($count > 0){
                    echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "warning",
                        title: "Username Already Existed",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/staff_accounts.php";
                    })
                    });
                    
                    </script>';

return;
                }
                else{
                        $sql = 'INSERT INTO account(username, fullname, password) VALUES (:username, :fullname, :password)';
                        $sql2 = 'INSERT INTO tbl_logs_staff(acc_id, staff,username, fullname, password, date_config, status) VALUES (:acc_id, :staff ,:username, :fullname,:password, :date_config, :status)';
    
                    $statement = $pdo->prepare($sql);
    
                    $new_user = [
                        'username' => 'test',
                        'fullname' => 'name',
                        'password' => 'test',
                        'remove' => 1,
                        //'recovery_code' => 'code'
                    ];
    
                    $statement->bindParam(':username', $new_user['username']);
                    $statement->bindParam(':fullname', $new_user['fullname']);
                    $statement->bindParam(':password', $new_user['password']);

                    $new_user['username'] = $_POST['username'];
                    $new_user['fullname'] = $_POST['fullname'];
                    $new_user['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $statement1 = $pdo->prepare($sql2);
 
                    $newProd1 = [
                        'acc_id' => 'zzz',
                        'staff' => 'zzz',
                        'username' => 'zzz',
                        'fullname' => 'zzz',
                        'password' => 'zzz',
                        'date_config' => 'zzz',
                        'status' => 'zzz',
                    ];
        
                    $statement1->bindParam(':acc_id', $newProd1['acc_id']);
                    $statement1->bindParam(':staff', $newProd1['staff']);
                    $statement1->bindParam(':username', $newProd1['username']);
                    $statement1->bindParam(':fullname', $newProd1['fullname']);
                    $statement1->bindParam(':password', $newProd1['password']);
                    $statement1->bindParam(':date_config', $newProd1['date_config']);
                    $statement1->bindParam(':status', $newProd1['status']);
        
                    //change
                    $newProd1['acc_id'] = $_POST['acc_id'];
                    $newProd1['staff'] = $_POST['staff'];
                    $newProd1['username'] = $_POST['username'];
                    $newProd1['fullname'] = $_POST['fullname'];
                    $newProd1['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $newProd1['date_config'] = $_POST['date_config'];
                    $newProd1['status'] = $_POST['status'];
        

                    //$new_user['recovery_code'] = generateCode();
                    //execute query
                    $statement->execute();
                    $statement1->execute();
                    echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "success",
                        title: "Staff Added Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/staff_accounts.php";
                    })
                    });
                    
                    </script>';

return;
                    exit();
                }
            }
        }
    }
    else
    {
        echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "warning",
                        title: "Password Does Not Match",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/staff_accounts.php";
                    })
                    });
                    
                    </script>';

return;
    }
?> 
<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<?php
    $pdo = require '../config/connection.php';
    session_start();

    //login
    $username = '';
    $password = '';
    $newUsername = '';
    $admin_power = '';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //checks if empty
        if(empty($username) || empty($password)){
            echo'
            <script type="text/javascript">
            $(document).ready(function(){
            swal({
                position: "top-end",
                type: "warning",
                title: "Username/Password i Empty",
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

            $sql = "SELECT * FROM account WHERE username = :username";
            $statement = $pdo->prepare($sql);
            
            $statement->execute(array('username' => $username));

            $logins = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();


            $password_result = '';

            foreach($logins as $login){
                $password_result = $login['password'];
                $_SESSION['user_id'] = $login['acc_id'];
                $_SESSION['username'] = $login['username'];
                $_SESSION['fullname'] = $login['fullname'];
                $_SESSION['admin_power'] = $login['admin_power'];
            }

            
            if($count > 0){
                if(password_verify($password, $password_result)){
                    // make a time in log
                    $sql_log = 'INSERT INTO tbl_logs_staff (acc_id, type) 
                        VALUES (:acc_id, 1)';

                    $statement_log = $pdo->prepare($sql_log);

                    $new_log = [
                        "acc_id" => 0,
                    ];

                    $statement_log->bindParam(':acc_id', $new_log['acc_id']);

                    // real values
                    $new_log['acc_id'] = $_SESSION['user_id'];

                    // exec
                    $statement_log->execute();

                    // admin
                    if($_SESSION['admin_power'] == 1){

                        echo'
                    <script type="text/javascript">

                    $(document).ready(function(){
 
                    swal({
                        position: "top-end",
                        type: "success",
                        title: "Admin Login Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/staff_accounts.php";
                    })
                    });
                    
                    </script>';

                    return;

                    }
                    // staff
                    else{
                        
                        echo'
                        <script type="text/javascript">

                        $(document).ready(function(){

                        swal({
                            position: "top-end",
                            type: "success",
                            title: "Staff Login Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }, function(){
                            window.location.href="../../staff/dashboard.php";
                        })
                        });
                        
                        </script>';

                        return;
                    }
                }
                else{
                    echo'
                    <script type="text/javascript">

                    $(document).ready(function(){
 
                    swal({
                        position: "top-end",
                        type: "warning",
                        title: "Username or Password Incorrect",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../admin/index.php";
                    })
                    });
                    
                    </script>';

                    return;
                }
            }
            else{
                echo'
                <script type="text/javascript">

                $(document).ready(function(){

                swal({
                    position: "top-end",
                    type: "warning",
                    title: "Username or Password Incorrect",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                    window.location.href="../../admin/index.php";
                })
                });
                
                </script>';

                return;
            }

        }
    }
?>
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
    $action = '';

    // function test(){
    //     echo "TEST";
    // }

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
                title: "Username/Password is Empty",
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
            $sql = "SELECT * FROM tbl_resident WHERE username = :username";
            $statement = $pdo->prepare($sql);
            
            $statement->execute(array('username' => $username));

            $logins = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();


            $password_result = '';

            foreach($logins as $login){
                $password_result = $login['password'];
                $_SESSION['user_id'] = $login['acc_id'];
                $_SESSION['firstname'] = $login['firstname'];
                $_SESSION['middlename'] = $login['middlename'];
                $_SESSION['lastname'] = $login['lastname'];
                $_SESSION['username'] = $login['username'];
                $_SESSION['admin_power'] = $login['admin_power'];

            }

            if($count > 0){
                if(password_verify($password, $password_result)){
                    if($_SESSION['admin_power'] == 'Not Approved'){

                        echo'
                        <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "error",
                        title: "Account not yet Approved Check your Email if your account is approved",
                        showConfirmButton: false,
                        timer: 2000
                    }, function(){
                        window.location.href="../../user/user_index.php";
                    })
                    });
                    
                    </script>';
                    return;

                    }
                    else if($_SESSION['admin_power'] == 'Banned'){

                        echo'
                        <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "error",
                        title: "Your Account is Banned",
                        showConfirmButton: false,
                        timer: 2000
                    }, function(){
                        window.location.href="../../user/user_index.php";
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
                            type: "success",
                            title: "Login Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }, function(){
                            window.location.href="../../user/request.php";
                        })
                        });
                        
                        </script>';
                        return;

                return; 
                }
                    
                }
                else{
                    echo'
                    <script type="text/javascript">

                    $(document).ready(function(){

                    swal({
                        position: "top-end",
                        type: "error",
                        title: "Wrong Username or Password",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/user_index.php";
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
                        type: "error",
                        title: "Wrong Username or Password",
                        showConfirmButton: false,
                        timer: 1500
                    }, function(){
                        window.location.href="../../user/user_index.php";
                    })
                    });
                    
                    </script>';

return;
            }

        }
    }

?>



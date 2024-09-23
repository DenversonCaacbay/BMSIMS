<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<?php

    $pdo = require '../config/connection.php';
    session_start();

    //login
    $email = '';
    $password = '';
    $newUsername = '';
    $action = '';

    // function test(){
    //     echo "TEST";
    // }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //checks if empty
        if(empty($email) || empty($password)){
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
                window.location.href="../../user/user_index.php";
            })
            });       
            </script>';
            return;
        }
        else{
            $sql = "SELECT * FROM resident_accounts WHERE email = :email";
            $statement = $pdo->prepare($sql);
            
            $statement->execute(array('email' => $email));

            $logins = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();


            $password_result = '';

            foreach($logins as $login){
                $password_result = $login['password'];
                $_SESSION['user_id'] = $login['res_id'];
                $_SESSION['fname'] = $login['fname'];
                $_SESSION['mname'] = $login['mname'];
                $_SESSION['lname'] = $login['lname'];
                $_SESSION['email'] = $login['email'];
                $_SESSION['access'] = $login['access'];

            }

            if($count > 0)
            {
                if(password_verify($password, $password_result))
                {
                    if($_SESSION['access'] == 'Not Yet Approved')
                    {
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
                    else if($_SESSION['access'] == 'Banned')
                    {
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
                    else if($_SESSION['access'] == 'Approved')
                    {
                        $_SESSION['loggedin'] = true;
                        echo'
                        <script type="text/javascript">
                        $(document).ready(function(){
                        swal({
                            position: "top-end",
                            type: "success",
                            title: "Login Successfully",
                            showConfirmButton: false,
                            timer: 2000
                        }, function(){
                            window.location.href="../../user/request.php";
                        })
                        });
                        </script>';
                        return;
                    }

                    else
                    {
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
    }

?>



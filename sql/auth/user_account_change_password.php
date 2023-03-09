<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<?php 
    $pdo = require '../config/connection.php';

    session_start();
    $user = $_SESSION['user_id'];

    $oldPass = '';
    $newPass = '';
    $confirmPass = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        $confirmPass = $_POST['confirmPass'];

        if($newPass == $confirmPass){
            $sql = "SELECT * FROM tbl_resident WHERE acc_id =".$user;
            $statement = $pdo->query($sql);

            $logins = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();

            $password_result = '';

            foreach($logins as $login){
                $password_result = $login['password'];
            }

            // proceed
            if(password_verify($oldPass, $password_result)){
                $update = 'UPDATE tbl_resident SET password=:password WHERE acc_id='.$user;

                $statement = $pdo->prepare($update);

                $update_password = [
                    'password' => 'test',
                ];

                $statement->bindParam(':password', $update_password['password']);

                //change
                $update_password['password'] = password_hash($newPass, PASSWORD_DEFAULT);

                //execute query
                $statement->execute();

                // alert msg
                echo'
                <script type="text/javascript">

                $(document).ready(function(){

                swal({
                    position: "top-end",
                    type: "success",
                    title: "Password Updated Successfully",
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
            else{
                // wrong password
                echo'
                <script type="text/javascript">

                $(document).ready(function(){

                swal({
                    position: "top-end",
                    type: "warning",
                    title: "Password Incorrect",
                    showConfirmButton: false,
                    timer: 1500
                }, function(){
                    window.location.href="../../user/user_profile.php";
                })
                });
                
                </script>';

return;
            }
        }
        else{
            // if $newPass != $confirmPass
            echo'
            <script type="text/javascript">

            $(document).ready(function(){

            swal({
                position: "top-end",
                type: "warning",
                title: "Password Does not match",
                showConfirmButton: false,
                timer: 1500
            }, function(){
                window.location.href="../../user/user_profile.php";
            })
            });
            
            </script>';

return;
        }
    }

?>
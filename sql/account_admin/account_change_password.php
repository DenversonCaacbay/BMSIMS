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
            $sql = "SELECT * FROM account WHERE acc_id =".$user;
            $statement = $pdo->query($sql);

            $logins = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();

            $password_result = '';

            foreach($logins as $login){
                $password_result = $login['password'];
            }

            // proceed
            if(password_verify($oldPass, $password_result)){
                $update = 'UPDATE account SET password=:password WHERE acc_id='.$user;

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
                echo "<script>
                alert('Password Updated!');
                window.location.href='../../user_account.php';
                </script>";

                exit();
            }
            else{
                // wrong password
                echo "<script>
                alert('Password is incorrect!');
                window.location.href='../../user_account.php';
                </script>";
            }
        }
        else{
            // if $newPass != $confirmPass
            echo "<script>
            alert('Password does not match!');
            window.location.href='../../user_account.php';
            </script>";
        }
    }

?>
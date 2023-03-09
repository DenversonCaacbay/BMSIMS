<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';

    //
    // $product_name = '';
     $username = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];

        // check for dup prod name
        $searchProduct = "SELECT * FROM tbl_resident WHERE username = '".$username."' ";
        $statement = $pdo->query($searchProduct);
        $productInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        $countProd = $statement->rowCount();
        
        if($countProd > 0){
            echo "<script>alert('Username already existed!');
            window.location.href='../../admin/resident_accounts.php';
            </script>";
        }
        else{
            // insert product
            $sql = 'INSERT INTO tbl_resident(admin_power,username, firstname, middlename, lastname, gender, place_of_birth, bdate, civil_status,address, purok, email,phone, password) VALUES (:admin_power,:username ,:firstname, :middlename, :lastname, :gender, :place_of_birth, :bdate, :civil_status,:address, :purok, :email, :phone, :password)';
            $sql2 = 'INSERT INTO tbl_logs_resident(acc_id, staff, username, firstname, middlename, lastname, gender, place_of_birth, bdate, civil_status,address, purok, email,phone, password, date_config, status) VALUES (:acc_id, :staff, :username ,:firstname, :middlename, :lastname, :gender, :place_of_birth, :bdate, :civil_status,:address, :purok, :email, :phone, :password, :date_config, :status)';

            $statement = $pdo->prepare($sql);

            $newProd = [
                'admin_power' => 'zzz',
                'username' => 'zzz',
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
                'phone' => 'zzz',
                'password' => 999,
                
            ];
            $statement->bindParam(':admin_power', $newProd['admin_power']);
            $statement->bindParam(':username', $newProd['username']);
            $statement->bindParam(':firstname', $newProd['firstname']);
            $statement->bindParam(':middlename', $newProd['middlename']);
            $statement->bindParam(':lastname', $newProd['lastname']);
            $statement->bindParam(':gender', $newProd['gender']);
            $statement->bindParam(':place_of_birth', $newProd['place_of_birth']);
            $statement->bindParam(':bdate', $newProd['bdate']);
            $statement->bindParam(':civil_status', $newProd['civil_status']);
            $statement->bindParam(':address', $newProd['address']);
            $statement->bindParam(':purok', $newProd['purok']);
            $statement->bindParam(':email', $newProd['email']);
            $statement->bindParam(':phone', $newProd['phone']);
            $statement->bindParam(':password', $newProd['password']);

                //change
            $newProd['admin_power'] = $_POST['admin_power'];
            $newProd['username'] = $_POST['username'];
            $newProd['firstname'] = $_POST['firstname'];
            $newProd['middlename'] = $_POST['middlename'];
            $newProd['lastname'] = $_POST['lastname'];
            $newProd['gender'] = $_POST['gender'];
            $newProd['place_of_birth'] = $_POST['place_of_birth'];
            $newProd['bdate'] = $_POST['bdate'];
            $newProd['civil_status'] = $_POST['civil_status'];
            $newProd['address'] = $_POST['address'];
            $newProd['purok'] = $_POST['purok'];
            $newProd['email'] = $_POST['email'];
            $newProd['phone'] = $_POST['phone'];
            $newProd['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $statement2 = $pdo->prepare($sql2);

            $newProd2 = [
                'acc_id' => 'zzz',
                'staff' => 'zzz',
                'username' => 'zzz',
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
                'phone' => 'zzz',
                'password' => 999,
                'date_config' => 'zzz',
                'status' => 'zzz',
                
            ];

            $statement2->bindParam(':acc_id', $newProd2['acc_id']);
            $statement2->bindParam(':staff', $newProd2['staff']);
            $statement2->bindParam(':username', $newProd2['username']);
            $statement2->bindParam(':firstname', $newProd2['firstname']);
            $statement2->bindParam(':middlename', $newProd2['middlename']);
            $statement2->bindParam(':lastname', $newProd2['lastname']);
            $statement2->bindParam(':gender', $newProd2['gender']);
            $statement2->bindParam(':place_of_birth', $newProd2['place_of_birth']);
            $statement2->bindParam(':bdate', $newProd2['bdate']);
            $statement2->bindParam(':civil_status', $newProd2['civil_status']);
            $statement2->bindParam(':address', $newProd2['address']);
            $statement2->bindParam(':purok', $newProd2['purok']);
            $statement2->bindParam(':email', $newProd2['email']);
            $statement2->bindParam(':phone', $newProd2['phone']);
            $statement2->bindParam(':password', $newProd2['password']);
            $statement2->bindParam(':date_config', $newProd2['date_config']);
            $statement2->bindParam(':status', $newProd2['status']);

            //change
            $newProd2['acc_id'] = $_POST['acc_id'];
            $newProd2['staff'] = $_POST['staff'];
            $newProd2['username'] = $_POST['username'];
            $newProd2['firstname'] = $_POST['firstname'];
            $newProd2['middlename'] = $_POST['middlename'];
            $newProd2['lastname'] = $_POST['lastname'];
            $newProd2['gender'] = $_POST['gender'];
            $newProd2['place_of_birth'] = $_POST['place_of_birth'];
            $newProd2['bdate'] = $_POST['bdate'];
            $newProd2['civil_status'] = $_POST['civil_status'];
            $newProd2['address'] = $_POST['address'];
            $newProd2['purok'] = $_POST['purok'];
            $newProd2['email'] = $_POST['email'];
            $newProd2['phone'] = $_POST['phone'];
            $newProd2['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $newProd2['date_config'] = $_POST['date_config'];
            $newProd2['status'] = $_POST['status'];
                //execute query
            $statement->execute();
            $statement2->execute();
            echo'
            <script type="text/javascript">

            $(document).ready(function(){

            swal({
                position: "top-end",
                type: "success",
                title: "Resident Added Successfully",
                showConfirmButton: false,
                timer: 1500
            }, function(){
                window.location.href="../../admin/resident_accounts.php";
            })
            });
            
            </script>';

return;
            exit();
            }
    }


?>
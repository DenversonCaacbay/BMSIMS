<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    
    $username = '';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $imageProperties = getimageSize($_FILES['image']['tmp_name']);
        $imgData1 = addslashes(file_get_contents($_FILES['profile_pic']['tmp_name']));
        $imageProperties = getimageSize($_FILES['profile_pic']['tmp_name']);

        //Checking if username is already taken
        $searchProduct = "SELECT * FROM tbl_resident WHERE username = '".$username."' ";
        $statement = $pdo->query($searchProduct);
        $productInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        $countProd = $statement->rowCount(); 
        if($countProd > 0){
            echo "<script>alert('Username already existed!');
            window.location.href='../user_index.php';
            </script>";
        }
        else{
            // insert resident
            $sql = 'INSERT INTO tbl_resident(admin_power,profile_pic, username, firstname, middlename, lastname, gender, place_of_birth, bdate, civil_status,address, purok, email,phone,image, password) VALUES (:admin_power,"'.$imgData1.'", :username ,:firstname, :middlename, :lastname, :gender, :place_of_birth, :bdate, :civil_status, :address, :purok, :email, :phone, "'.$imgData.'", :password)';
            $statement = $pdo->prepare($sql);
            $newProd = [
                'admin_power' => 'Not Yet Approve',
                'profile_pic' => 'zzz',
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
                'image' => 'zzz',
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
            // $statement->bindParam(':image', $newProd['image']);
            $statement->bindParam(':password', $newProd['password']);
            

                //change
            // $newProd['admin_power'] = $_POST['admin_power'];
            if(empty($_POST['admin_power']))
            {
                $_POST['admin_power'] = "";
            }
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

            // $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            // $imageProperties = getimageSize($_FILES['image']['tmp_name']);

            // $newProd['image'] = $imgData;


            $newProd['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
           
                //execute query
            $statement->execute();
            echo'
            <script type="text/javascript">
            $(document).ready(function(){
            swal({
                position: "top-end",
                type: "success",
                title: "Register Successfully",
                showConfirmButton: false,
                timer: 1500
            }, function(){
                window.location.href="../../user/user_index.php";
            })
            });
            </script>';
            return;
            exit();
        }
    }
?> 
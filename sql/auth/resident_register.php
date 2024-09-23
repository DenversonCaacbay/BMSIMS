<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<?php 
    $pdo = require '../config/connection.php';
    
    $email = '';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $imgData = addslashes(file_get_contents($_FILES['validation']['tmp_name']));
        $imageProperties = getimageSize($_FILES['validation']['tmp_name']);
        $imgData1 = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
        $imageProperties = getimageSize($_FILES['pic']['tmp_name']);

        //Checking if username is already taken
        $searchProduct = "SELECT * FROM resident_accounts WHERE email = '".$email."' ";
        $statement = $pdo->query($searchProduct);
        $productInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
        $countProd = $statement->rowCount(); 
        if($countProd > 0){
            echo "<script>alert('Email already existed!');
            window.location.href='../../user/user_register.php';
            </script>";
        }
        else{
            // insert resident
            $sql = 'INSERT INTO resident_accounts(access, pic, fname, mname, lname, gender, pob, bdate, age, status, street, purok, email, contact, validation, password) VALUES (:access, "'.$imgData1.'" ,:fname, :mname, :lname, :gender, :pob, :bdate, :age, :status, :street, :purok, :email, :contact, "'.$imgData.'", :password)';
            $statement = $pdo->prepare($sql);
            $newProd = [
                'access' => 'Not Yet Approve',
                'pic' => 'zzz',
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
                'phone' => 'zzz',
                'validation' => 'zzz',
                'password' => 999,
                
                
            ];
            $statement->bindParam(':access', $newProd['access']);
            // $statement->bindParam(':username', $newProd['username']);
            $statement->bindParam(':fname', $newProd['fname']);
            $statement->bindParam(':mname', $newProd['mname']);
            $statement->bindParam(':lname', $newProd['lname']);
            $statement->bindParam(':gender', $newProd['gender']);
            $statement->bindParam(':pob', $newProd['pob']);
            $statement->bindParam(':bdate', $newProd['bdate']);
            $statement->bindParam(':age', $newProd['age']);
            $statement->bindParam(':status', $newProd['status']);
            $statement->bindParam(':street', $newProd['street']);
            $statement->bindParam(':purok', $newProd['purok']);
            $statement->bindParam(':email', $newProd['email']);
            $statement->bindParam(':contact', $newProd['contact']);
            // $statement->bindParam(':image', $newProd['image']);
            $statement->bindParam(':password', $newProd['password']);
            

                //change
            // $newProd['admin_power'] = $_POST['admin_power'];
            if(empty($_POST['access']))
            {
                $_POST['access'] = "";
            }
            // $newProd['username'] = $_POST['username'];
            $newProd['fname'] = $_POST['fname'];
            $newProd['mname'] = $_POST['mname'];
            $newProd['lname'] = $_POST['lname'];
            $newProd['gender'] = $_POST['gender'];
            $newProd['pob'] = $_POST['pob'];
            $newProd['bdate'] = $_POST['bdate'];
            $newProd['age'] = $_POST['age'];
            $newProd['status'] = $_POST['status'];
            $newProd['street'] = $_POST['street'];
            $newProd['purok'] = $_POST['purok'];
            $newProd['email'] = $_POST['email'];
            $newProd['contact'] = $_POST['contact'];
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
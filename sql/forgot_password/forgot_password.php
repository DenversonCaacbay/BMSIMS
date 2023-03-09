<!DOCTYPE html> 
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMSIMS | Forgot Password</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "style.css">
    <scrip src="../../bootstrap/js/bootstrap.min.js"></script>

</head>
<style>


.logo{
    height: 320px;
    max-width: 320px;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    top:0;
    position: absolute;
}

h4{
    text-align: center;
}
</style>
<body style="background: #27329b">

        <div class="container hero">
            <div class="card">
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <img src="BarangayLogo.jpg" style="height:200px;width:200px;">

                </div>
                <div class="col-12 mt-3">
                    <h4>Forgot Password</h4>
                    <br>

                    <form action="forgot_password.php" method="POST">

                            <div class="mb-3">
                                <label class="form-label">Enter your Email</label>
                                <input type="text" name="usernameSearch" class="form-control" required>
                            </div>

                            <?php
                                $pdo = require '../../sql/connection.php';
                                session_start();

                                $userInput = '';

                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    $userInput = $_POST['usernameSearch'];

                                    $userSearch = "SELECT * FROM tbl_resident WHERE email = '".$userInput."' ";
                                    $statement = $pdo->query($userSearch);
                                    $userResult = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    $count = $statement->rowCount();

                                    // if exist
                                    if($count > 0){
                                        foreach($userResult as $result){
                                            $_SESSION['userID'] = $result['acc_id'];
                                        }

                                        echo "<script>
                                        window.location.href='email.php';
                                        </script>";
                                    }
                                    else{
                                        // no exist
                                        echo "<script>
                                        alert('Email Not Found');
                                        </script>";
                                    }
                                }
                            ?>
                            <input type="submit" name="insertdata" style="width:100%;padding:10px;float:right;border-radius:50px;" class="btn">
                            <a href="../../user_index.php" class="btn">BACK</a>
                            
                    </form>
                </div>
            </div>
            </div>
            


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>
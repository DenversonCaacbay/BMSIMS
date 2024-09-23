<?php
session_start(); // Start the session
// session_destroy();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to user_index.php
    header("Location: user_index.php");
    exit;
}                   
?>
<?php
                            $pdo = require '../sql/config/connection.php';
                            $displayform = false;
                            $displaylogin = false;

                            $sqlAdmin = "SELECT * FROM feedbacks";
                            $statement = $pdo->query($sqlAdmin);
                            $admin = $statement->fetchAll(PDO::FETCH_ASSOC);
                            $admin_count = $statement->rowCount();

                            if ($admin_count < 1) {
                                $displayform = true;
                            } else {
                                $displaylogin = true;
                            }

                            // Check if there is an email in the feedbacks table
                            foreach ($admin as $row) {
                                if (!empty($row['email'])) {
                                    $displayform = false;
                                    break;
                                }
                            }
                            ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | My Profile</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
</head>
<style>
  .myDiv{
  display:none;
}  
</style>


<body class="bg-light">
<nav class="navbar navbar-expand-lg py-3 sticky-top navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../images/barangaylogo.png" height="30" class="d-inline-block align-text-top" style="border-radius:30px;">
            Barangay Matain SIMS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link " href="request.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_request.php">My Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="user_profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logoutbtn" href = "../sql/auth/user_account_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
  </nav><!-- //NAVBAR -->

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="profilemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Profile </h5>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                </div>
                <form action="../sql/user_requests/resident_update.php" class="p-3" method="POST">
                    <?php 
                        // $pdo = require '../sql/config/connection.php';
                        $user = $_SESSION['user_id'];
                        $secret1 = '';
                        $secret2 = '';
                        $secret3 = '';
                        $recovery_code = '';
                        $userSearch = "SELECT * FROM resident_accounts WHERE res_id=".$user;
                        $statement = $pdo->query($userSearch);
                        $userInfo = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach($userInfo as $info){
                            echo "<div class='row'>";
                            echo "<div class='col-md-4'>";
                            echo "<h5 class='form-label'>First Name</h5>";
                            echo "<input type='text' value='".$info['fname']."' name='fname' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-4'>";
                            echo "<h5 class='form-label'>Middle Name</h5>";
                            echo "<input type='text' value='".$info['mname']."' name='mname' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-4'>";
                            echo "<h5 class='form-label'>Last Name</h5>";
                            echo "<input type='text' value='".$info['lname']."' name='lname' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-3 mt-3'>";
                            echo "<h5 class='form-label'>Sex</h5>";
                            echo "<input type='text' value='".$info['gender']."' name='gender' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-3 mt-3'>";
                            echo "<h5 class='form-label'>Place of Birth</h5>";
                            echo "<input type='text' value='".$info['pob']."' name='pob' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-3 mt-3'>";
                            echo "<h5 class='form-label'>Birthdate</h5>";
                            echo "<input type='text' value='".date("F d, Y", strtotime($info["bdate"]))."'  name='bdate' class='form-control' placeholder='' readonly>";
                            echo "</div>"; 
                            echo "<div class='col-md-3 mt-3'>";
                            echo "<h5 class='form-label'>Age</h5>";
                            echo "<input type='text' value='".$info['age']."' name='age' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-4 mt-3'>";
                            echo "<h5 class='form-label'>Civil Status</h5>";
                            echo "<input type='text' value='".$info['status']."' name='status' class='form-control' placeholder='' required>";
                            echo "</div>"; 
                            echo "<div class='col-md-4 mt-3'>";
                            echo "<h5 class='form-label'>Street</h5>";
                            echo "<input type='text' value='".$info['street']."' name='street' class='form-control' placeholder='' required>";
                            echo "</div>"; 
                            echo "<div class='col-md-4 mt-3'>";
                            echo "<h5 class='form-label'>Purok</h5>";
                            echo "<input type='text' value='".$info['purok']."' name='purok' class='form-control' placeholder='' required>";
                            echo "</div>";
                            echo "<div class='col-md-6 mt-3'>";
                            echo "<h5 class='form-label'>Email</h5>";
                            echo "<input type='text' value='".$info['email']."' name='email' class='form-control' placeholder='' readonly>";
                            echo "</div>";
                            echo "<div class='col-md-6 mt-3'>";
                            echo "<h5 class='form-label'>Contact Number</h5>";
                            echo "<input type='number' value='".$info['contact']."' name='contact' class='form-control' placeholder='' required>";
                            echo "</div>";
                            echo "</div>";
                            //echo br
                            echo "<br>";
                            ;
                    ?>
                    <div class="mt-2">
                      <label for="myCheckbox">Click Here to Read <a href="../general_policy.html" target="_blank">BMSIMS General Privacy Policy</a></label>
                      <input type="checkbox" id="myCheckbox">
                    </div>
                    <input type="submit" id="submitButton" style="width:100%;" class="btn btn-custom" value="Save Changes" disabled>
                </form>
            </div>
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="container mt-4">
                <h3 class="title text-lg-start">Profile</h3>
                <hr>
                <div class="row">
                    <div class="col-5 prof1">
                        <?php
                            echo"
                            <div class='row'>
                                <div class='col-3 pic'><img class='rounded-circle' src='data:image/jpeg;base64,".base64_encode($info['pic'])."'width=100px height=100px/></div>
                                <div class='col-9 user'><h5 class='mt-4'>".$info['fname']." ".$info['mname']." ".$info['lname']."</h5></div>
                            </div>
                            
                            
                            ";
                           
                        ?>
                        <button class="btn btn-custom" data-toggle="modal" data-target="#profilemodal">Edit Profile</button>
                        <button class="btn btn-custom" data-toggle="modal" data-target="#passmodal">Change Password</button>
                        
                        <?php if ($displayform): ?>
                            <button class="btn btn-custom" data-toggle="modal" data-target="#feedmodal">Feedback</button>
                        <?php endif; ?>
                        
                    </div>
                    
                   <div class="col-7 info">
                   <?php 
    
                    echo "<div class='row'>";
                    echo "<div class='col-md-12  mt-3'>";
                    echo "<h5 class='form-label'>First Name</h5>";
                    echo "<input type='text' value='".$info['fname']." ".$info['mname']." ".$info['lname']."' name='firstname' class='form-control' placeholder='' disabled>";
                    echo "</div>";
                    echo "<div class='col-md-12 mt-3'>";
                    echo "<h5 class='form-label'>Street</h5>";
                    echo "<input type='text' value='".$info['street']."' name='address' class='form-control' placeholder='' disabled>";
                    echo "</div>"; 
                    echo "<div class='col-md-12 mt-3'>";
                    echo "<h5 class='form-label'>Purok</h5>";
                    echo "<input type='text' value='".$info['purok']."' name='purok' class='form-control' placeholder='' disabled>";
                    echo "</div>";
                    echo "<div class='col-md-12 mt-3'>";
                    echo "<h5 class='form-label'>Email</h5>";
                    echo "<input type='text' value='".$info['email']."' name='email' class='form-control' placeholder='' disabled>";
                    echo "</div>";
                    echo "<div class='col-md-12 mt-3'>";
                    echo "<h5 class='form-label'>Contact Number</h5>";
                    echo "<input type='number' value='".$info['contact']."' name='phone' class='form-control' placeholder='' disabled>";
                    echo "</div>";

                    echo "</div>";
                    //echo br
                    echo "<br>";
                    ;
                }
                                       
                                    ?>

                   </div>
                </div>
            </div>
        </div>

<!-- Change Password Modal -->
        <div class="modal fade" id="passmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                    </div>
                    <?php
                        $user = $_SESSION['user_id'];
                        ?>
                        <form action="../sql/auth/user_account_change_password.php" class="p-3" method="POST">
                            <div class="col-md-12 mb-3 password-container">
                                <label>Enter Old Password</label>
                                <input type="password" name="oldPass" class="form-control" id="password1" placeholder="" required>
                                <i class="fas fa-eye" style="right: 1%;" id="eye1"></i>
                            </div>
                            <div class="col-md-12 mt-3 mb-3 password-container">
                                <label>Enter New Password</label>
                                <input type="password" name="newPass" class="form-control" id="password2" placeholder="" required>
                                <i class="fas fa-eye" style="right: 1%;" id="eye2"></i>
                            </div>
                            <div class="col-md-12 mt-3 mb-3 password-container">
                                <label>Confirm Password</label>
                                <input type="password" name="confirmPass" class="form-control" id="password3" placeholder=""  required>
                                <i class="fas fa-eye" style="right: 1%;" id="eye3"></i>
                            </div>
                            <input type="submit" style="width:100%;" class="btn btn-custom" value="Change Password">

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="feedmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                        <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                    </div>
                        <form action="../sql/post/feedback.php" class="p-3" method="POST">
                            <div class="col-md-12 mb-3 password-container">
                                <label>Your Feedback</label>
                                <textarea  type="text" name="feedback" class="form-control" id="feedback" placeholder="" required></textarea>
                            </div>
                            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']?>" placeholder="text" id="floatingInput" hidden>
                            <input type="submit" style="width:100%;" class="btn btn-custom" value="Submit">

                        </form>
                    </div>
                </div>
            </div>
        </div>

    
</div>


</div><!-- //HERO -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <script>
    $(document).ready(function(){
        $('#myselection').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script> 

<script>
    const passwordInput1 = document.querySelector("#password1")
    const eye1 = document.querySelector("#eye1")
    eye1.addEventListener("click", function(){
    this.classList.toggle("fa-eye-slash")
    const type = passwordInput1.getAttribute("type") === "password" ? "text" : "password"
    passwordInput1.setAttribute("type", type)
})
</script>
<script>
    const passwordInput2 = document.querySelector("#password2")
    const eye2 = document.querySelector("#eye2")
    eye2.addEventListener("click", function(){
    this.classList.toggle("fa-eye-slash")
    const type = passwordInput2.getAttribute("type") === "password" ? "text" : "password"
    passwordInput2.setAttribute("type", type)
})
</script>
<script>
    const passwordInput3 = document.querySelector("#password3")
    const eye3 = document.querySelector("#eye3")
    eye3.addEventListener("click", function(){
    this.classList.toggle("fa-eye-slash")
    const type = passwordInput3.getAttribute("type") === "password" ? "text" : "password"
    passwordInput3.setAttribute("type", type)
})
</script>
<script>
        $(document).ready(function () {

            $('.logoutbtn').on('click', function () {

                $('#logoutmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

            });
        });
  </script>
  <script>
    const checkbox = document.getElementById('myCheckbox');
    const submitButton = document.getElementById('submitButton');

    checkbox.addEventListener('change', function() {
      submitButton.disabled = !checkbox.checked;
    });
  </script>
</body>
</html>
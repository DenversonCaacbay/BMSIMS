<?php
// require '../sql/auth/account_check2.php';
// require '../sql/auth/account_user_check.php'; 
session_start(); // Start the session

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to user_index.php
    header("Location: ../ad_index.php");
    exit;
}                        
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | Approved Accounts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
 
<!-- Vertical navbar -->

<div class="vertical-nav" id="sidebar">
    <div class="card py-2 px-3 ">
        <div class="row">
            <div class="col-5">
                <img loading="lazy" src="../images/barangaylogo.png" alt="..." width="80" height="80" >
            </div>
            <div class="col-7 mt-3">
                Barangay Matain
            </div>
        </div>

    </div>
  <p class="text-light font-weight-bold text-uppercase px-3 small pb-4 mb-0"></p>

  <ul class="nav flex-column mb-0">
  <p class="text-light font-weight-bold">Menu</p>
    <li class="nav-item">
        <a href="dashboard.php" class="nav-link text-light">
        <i class="fas fa-home  mr-3 text-light fa-fw"></i>
          Dashboard
        </a>
    </li>
    <hr class="text-light">
  <p class="text-light font-weight-bold">Account Manager</p>
    <li class="nav-item">
      <a href="staff_accounts.php" class="nav-link text-light">
      <i class="fas fa-user  mr-3 text-light fa-fw"></i>
                Staff Account
            </a>
    </li>
    <li class="nav-item">
      <a href="barangayofficial.php" class="nav-link text-light">
      <i class="fas fa-user  mr-3 text-light fa-fw"></i>
                Barangay Official
            </a>
    </li>
    <li class="nav-item">
      <a href="pending_accounts.php" class="nav-link hover-dark text-light">
      <i class="fas fa-user  mr-3 text-light fa-fw"></i>
                Residents Account
            </a>
    </li>
    <li class="nav-item">
      <a href="manageprogram.php" class="nav-link text-light">
      <i class="fas fa-calendar mr-3 text-light fa-fw"></i>
                Manage Programs
            </a>
    </li>
    <hr class="text-light">
    <p class="text-light font-weight-bold">History</p>
    <li class="nav-item">
      <a href="payment_history.php" class="nav-link text-light">
      <i class="fas fa-file-invoice-dollar mr-3 text-light fa-fw"></i>
                Payment History
            </a>
    </li>
    <!--<li class="nav-item">-->
    <!--  <a href="logs.php" class="nav-link text-light">-->
    <!--  <i class="fas fa-history mr-3 text-light fa-fw"></i>-->
    <!--            Logs-->
    <!--        </a>-->
    <!--</li>-->



    <!---->

    <li class="nav-item p-5">
      <a href="../sql/auth/account_logout.php" class="nav-link nav-link1 text-center text-light">
      <!-- <i class="fas fa-sign-out-alt text-light fa-fw" style="font-size:30px;"></i> -->
      <!--<img width="30" height="30" src="../images/icons/logout_button.png" alt="logout-rounded-left"/>-->
       <img width="30" height="30" src="../images/icons/logout_button_white.png" alt="logout-rounded-left"/>
            
            </a>
    </li>
  </ul>

</div>
<!-- End vertical navbar -->

<!--Modal Add-->
<div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="font-weight:600; margin: 10px;"id="exampleModalLabel">Add Resident</h3>
        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">X</button>
      </div>

      <form action="../sql/post/resident_insert.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
          <input type="hidden" name="admin_power" class="form-control" id="floatingInput" value="Approved" style="height:50px;" hidden>
            <div class="col-md-12">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="col-md-4 mt-3">
              <label>First Name</label>
              <input type="text" name="firstname" class="form-control" required>
            </div>
            <div class="col-md-4 mt-3">
              <label>Middle Name</label>
              <input type="text" name="middlename" class="form-control" required>
            </div>
            <div class="col-md-4 mt-3">
              <label>Last Name</label>
              <input type="text" name="lastname" class="form-control" required>
            </div>
                             
            <div class="col-md-3 form-group mt-3">
              <label>Gender</label>
              <select style="padding:7px;" class="form-control form-select" name="gender" id="inputGroupSelect01">
                <option selected disabled> </option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="col-md-3 mt-3">
              <label>Place of Birth</label>
              <input type="text" name="place_of_birth" class="form-control" required>
            </div>

            <div class="col-md-3 form-group mt-3">
              <label>Birth Date</label>
              <input style="padding:7px;" class="form-control form-select" type="date" name="bdate">

            </div>

            <div class="col-md-3 form-group mt-3">
              <label>Status</label>
              <select style="padding:7px;" class="form-control form-select" name="civil_status" id="inputGroupSelect01">
                <option selected disabled value=""></option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
              </select>
            </div>

            <div class="col-md-6 mt-3">
              <label style="font-size: 13px;">Address (House No. / Barangay / Municipality / Region)</label>
              <input type="text" name="address" class="form-control" required>
            </div>
            <div class="col-md-6 form-group mt-3">
              <label>Purok</label>
              <select style="padding:7px;" class="form-control form-select" name="purok" id="inputGroupSelect01">
                <option selected> </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
            <div class="col-md-6 mt-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>    
            </div>
            <div class="col-md-6 mt-3">
              <label>Contact Number</label>
              <input type="text" name="phone" class="form-control" required>
            </div>
            <label class="mt-3">Password : pass123</label>
            <div class="col-md-6 mt-3" hidden>
              <label>Password : pass123</label>
              <input type="password" name="password" class="form-control" value="pass123" id="password1">
            </div>
            <div class="col-md-6 mt-3" hidden>
              <label>Confirm Password</label>
              <input type="password" name="confirmPass" class="form-control" value="pass123" id="password2">
            </div>

                        <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                        <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                        <input type="text" name="status" class="form-control" placeholder="" value="Added" hidden>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" style="width:100%" name="insertdata" class="btn btn-custom">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--End of Modal Add-->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h3 style="color: #27329b; font-weight:600; margin: 10px;"id="exampleModalLabel">Updating Password...</h3>
                    <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>

                <form action="../sql/account_admin/resident_forgot_password.php" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="acc_id" id="acc_id" required>
                  <div class="row">
                    <div class="mb-3 password-container">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" id="password" style="height:50px" required>
                      <i class="fas fa-eye" id="eye"></i>
                    </div>
                      
                      <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                      <input type="text" name="admin_power" value="Password Updated" class="form-control" hidden>
                      <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                      <input type="text" name="username" id="username" class="form-control" hidden>
                      <input type="text" name="fname" id="fname" class="form-control" hidden>
                      <input type="text" name="middlename" id="middlename" class="form-control" hidden>
                      <input type="text" name="lastname" id="lastname" class="form-control" hidden>
                      <input type="text" name="gender" id="gender" class="form-control" hidden>
                      <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" hidden>
                      <input type="text" name="bdate" id="bdate" class="form-control" hidden>
                      <input type="text" name="civil_status" id="civil_status" class="form-control" hidden>
                      <input type="text" name="address" id="address" class="form-control" hidden>
                      <input type="text" name="purok" id="purok" class="form-control" hidden>
                      <input type="text" name="email" id="email" class="form-control" hidden>
                      <input type="text" name="phone" id="phone" class="form-control" hidden>
                      <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                      <input type="text" name="status" class="form-control" placeholder="" value="Update" hidden>
                  </div>
                       
       
                        <script>
                            const passwordInput = document.querySelector("#password")
                            const eye = document.querySelector("#eye")

                            eye.addEventListener("click", function(){
                            this.classList.toggle("fa-eye-slash")
                            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
                            passwordInput.setAttribute("type", type)
                            })
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updatedata" style="background: #27329b; color:white;width:100%" class="btn successbtn">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--End of Edit Modal-->

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <form action="../sql/account_admin/resident_banned.php" method="POST">
                <div class="modal-body">
                  <input type="hidden" name="acc_id" id="acc_id9" required>
                  <div class="row">
                    <h5>Do you want to ban this account?</h5>
                    <div class="col-md-12 form-group">
                        <input type="text" name="access" value="Banned" class="form-control" hidden>
                      </select>
                    </div>
                     
                      <input type="text" name="fname" id="fname9" class="form-control" hidden>

                      <!-- <input type="text" name="created_at" hidden> -->
                      <!-- <input type="text" name="status" class="form-control" value="Update"> -->
                  </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" style="background: #27329b; color:white;" class="btn successbtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" name="updatedata" style="background: #27329b; color:white" class="btn successbtn">Yes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<!-- Page content holder -->
<div class="page-content p-0" id="content">
  <div class="row nav1 mb-1">
    <div class="col-9">
        <!-- <button id="sidebarCollapse" type="button" class="btn btn-menu shadow-sm"><i class="fa fa-bars"></i></button> -->
    </div>
    <div class="col-3 mt-2 align-items-right">
        <div class="d-flex top-header ">
            <img loading="lazy" src="../images/profile.png" alt="..." width="30" height="30">
            <div class="media-body">
                <a class="user-style"  href="#"><?php echo $_SESSION['fullname'] ?></a>
            </div>
        </div>
    </div>
  </div>
  <div class="separator"></div>
    <div class="header">
      <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-9" style="margin-top:8px">
            <b>Residents Account </b><i class="fas fa-user  mr-3 fa-fw"></i>
            </div>
            <div class="col-lg-3">
            <!-- <a href="../sql/generate_report/resident.php" class="btn btn-custom"  id="btnExport" value="Export" target="_blank">Generate PDF</a> -->
              <!-- <button type="button" class="btn btn-custom" style="float:right"  data-toggle="modal" data-target="#studentaddmodal">
                  Add Resident
              </button> -->
            </div>
          </div>
          <hr>
          <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a class="b-crumb" href="pending_accounts.php">Pending Accounts</a></li>
                <li class="breadcrumb-item"><a class="link-active b-crumb" href="approved_accounts.php">Approved Accounts</a></li>
                <li class="breadcrumb-item"><a class="b-crumb" href="disapproved_accounts.php">Disapproved Accounts</a></li>
                <li class="breadcrumb-item"><a class="b-crumb" href="banned_accounts.php">Banned Accounts</a></li>
            </ol>
        </nav>
        </div>
        <div class="container">
          <div class="card2">
            <div class="card-body">
              <div class="form-group">
                <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search" />
              </div>
              <div class="table-responsive mt-2" style="height:430px" id="dynamic_content">
                <!--Display table-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="../bootstrap/js/main.js"></script>
</body>
</html>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/account_admin/fetch_residents_approved_accounts.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>
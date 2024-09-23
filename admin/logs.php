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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    
    <title>Admin | Logs</title>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
      <link rel="stylesheet" href="style2.css">
</head>
<style>

/* Style the tab */
.tab {
  background: #27329b;
  overflow: hidden;
  
  padding: 5px;
  border-radius: 10px;
  width: 95%;
}

/* Style the buttons inside the tab */
.tab button {
  float: left;
  outline: none;
  cursor: pointer;
  margin-left:5px;
  padding: 5;
  transition: 0.3s;
  font-size: 17px;
  color: #fff;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #fff;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #fff;
  color:#27329b;
}

/* Style the tab content */
.tabcontent {
  display: none;

}
</style>
<body>

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
      <a href="pending_accounts.php" class="nav-link text-light">
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
    <!--  <a href="logs.php" class="nav-link hover-dark text-light">-->
    <!--  <i class="fas fa-history mr-3 text-light fa-fw"></i>-->
    <!--            Logs-->
    <!--        </a>-->
    <!--</li>-->



    <!---->

    <li class="nav-item p-5">
      <a href="../sql/auth/account_logout.php" class="nav-link nav-link1 text-center text-light">
      <!-- <i class="fas fa-sign-out-alt text-light fa-fw" style="font-size:30px;"></i> -->
      <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/logout-rounded-left.png" alt="logout-rounded-left"/>
            </a>
    </li>
  </ul>

</div>

</div>

<!-- Page content holder -->


<!-- Page content holder -->
<div class="page-content p-0" id="content">
  <!-- Toggle button -->
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
    

    
<!-- Retrieving Resident Record -->
<div class="modal fade" id="deletemodal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Retrieving Record... </h5>
                </div>

                <form action="../sql/post/logs_resident_insert.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete" id="log_id">

                        <h4> Do you want to retrieve this resident record?</h4>

                        <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>">
                        <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>" >
                        <input type="text" name="username" id="username1" class="form-control" >
                        <input type="text" name="firstname" id="firstname1" class="form-control" >
                        <input type="text" name="middlename" id="middlename1" class="form-control" >
                        <input type="text" name="lastname" id="lastname1" class="form-control" >
                        <input type="text" name="gender" id="gender1" class="form-control" >
                        <input type="text" name="place_of_birth" id="place_of_birth1" class="form-control" >
                        <input type="text" name="bdate" id="bdate1" class="form-control" >
                        <input type="text" name="civil_status" id="civil_status1" class="form-control" >
                        <input type="text" name="address" id="address1" class="form-control" >
                        <input type="text" name="purok" id="purok1" class="form-control" >
                        <input type="text" name="email" id="email1" class="form-control" >
                        <input type="text" name="phone" id="phone1" class="form-control" >
                        <input type="text" name="password" value="pass123" class="form-control" >
                        <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" >
                        <input type="text" name="status" class="form-control" placeholder="" value="Retrieved" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-custom"> YES</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
  </div>
  <div class="separator"></div>
  <div class="header">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7" style="margin-top:8px">
                    Logs <i class="fas fa-user  mr-3 fa-fw"></i>
                    </div>
                    <div class="col-lg-1">
                      
                    </div>

                </div>
            </div>
        </div>
    </div>
                <div class="container">
                    <div class="card2">
                        <div class="card-body">
                        <div class="form-group">
                            <!--<input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />-->

                           <!-- Type <select class="font-control">
                              <option>Time In</option>
                              <option>Time Out</option>
                            </select> -->
                            <!-- <a href="../sql/generate_report/transac_paid.php" class="btn btn-custom mt-2"  id="btnExport" value="Export">Export</a> -->
                        </div>
                        <div class="table-responsive mt-2" style="height:500px" id="dynamic_content">
                            <!--Sample-->
                                
                            <!--End of Sample-->
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
<!-- Staff -->
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/logs/staff_logs.php",
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


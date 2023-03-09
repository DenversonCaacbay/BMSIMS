<?php
require '../sql/auth/account_check.php';
                           
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../bootstrap/css/staff_style.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
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
  <p class="text-light font-weight-bold"></p>
  <li class="nav-item">
      <a href="dashboard.php" class="nav-link text-light">
      <i class="fas fa-home mr-3 text-light fa-fw" style="font-size:20px"></i>
                Dashboard
            </a>
    </li>

    <hr class="text-light">
    <p class="text-light font-weight-bold"></p>
    <!---->
    <li class="nav-item">
      <a href="menu.php" class="nav-link  hover-dark  text-light">
      <i class="fas fa-folder  mr-3 text-light fa-fw" style="font-size:20px"></i>
                List of Records
            </a>
</li>


    <!---->

    <li class="nav-item" style="margin-top:55vh">
    <a href="../sql/auth/staff_account_logout.php" class="nav-link nav-link1 text-light">
      <i class="fas fa-sign-out-alt mr-3 text-light fa-fw" style="font-size:20px"></i>
                Logout
            </a>
    </li>
  </ul>

</div>
<!-- End vertical navbar -->

<!-- Page content holder -->
<div class="page-content p-0" id="content">
  <!-- Toggle button -->
    <div class="row nav1 mb-1">
        <div class="col-9">
            <button id="sidebarCollapse" type="button" class="btn btn-menu shadow-sm"><i class="fa fa-bars"></i></button>
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
  <!-- Demo content -->
<div class="separator"></div>
  <div class="header">
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-sm-12" style="font-size:2rem">List of  Records <i class="fas fa-folder mr-3 fa-fw"></i></div>
        </div>
      </div>
      <hr class="mt-2" style="margin:10px">
    </div>
  </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card2 p-2 mb-3" style="height:100px">
                    <div class="row pt-4">
                        <div class="col-10">
                            <h4>Barangay Clearance</h4>
                        </div>
                        <div class="col-2">
                            <a href="barangay_clearance/barangay_clearance_pickup.php" class="btn btn-custom" style="width:100%;">See List</a>
                        </div>
                    </div>
                </div>
                <div class="card2 p-2 mb-3" style="height:100px">
                    <div class="row pt-4">
                        <div class="col-10">
                            <h4>Barangay ID</h4>
                        </div>
                        <div class="col-2">
                            <a href="barangay_id/barangay_id_pickup.php" class="btn btn-custom" style="width:100%;">See List</a>
                        </div>
                    </div>
                </div>
               
                <div class="card2 p-2 mb-3" style="height:100px">
                    <div class="row pt-4">
                        <div class="col-10">
                            <h4>Residency</h4>
                        </div>
                        <div class="col-2">
                            <a href="residency/residency_pickup.php" class="btn btn-custom" style="width:100%;">See List</a>
                        </div>
                    </div>
                </div>
               
                <div class="card2 p-2 mb-3" style="height:100px">
                    <div class="row pt-4">
                        <div class="col-10">
                            <h4>Indigency</h4>
                        </div>
                        <div class="col-2">
                            <a href="indigency/indigency_pickup.php" class="btn btn-custom" style="width:100%;">See List</a>
                        </div>
                    </div>
                </div>
               
                <div class="card2 p-2 mb-3" style="height:100px">
                    <div class="row pt-4">
                        <div class="col-10">
                            <h4>Business Permit</h4>
                        </div>
                        <div class="col-2">
                            <a href="business_permit/business_permit_pickup.php" class="btn btn-custom" style="width:100%;">See List</a>
                        </div>
                    </div>
                </div>
                <!-- <div class="card2 p-2 mb-3" style="height:100px">
                    <div class="row pt-4">
                        <div class="col-10">
                            <h4>Business Permit (Renewal)</h4>
                        </div>
                        <div class="col-2">
                            <a href="business_permit_renewal/business_permit_renewal_pickup.php" class="btn btn-custom" style="width:100%;">See List</a>
                        </div>
                    </div>
                </div> -->
               
       
            </div>
        </div>
    </div>





<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="../bootstrap/js/main.js"></script>
</body>
</html>

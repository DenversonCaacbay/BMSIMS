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
      <a href="dashboard.php" class="nav-link  hover-dark text-light">
      <i class="fas fa-home mr-3 text-light fa-fw" style="font-size:20px"></i>
                Dashboard
            </a>
    </li>
    <!---->
    <hr class="text-light">
    <p class="text-light font-weight-bold"></p>
    <!---->
    <li class="nav-item">
      <a href="menu.php" class="nav-link text-light">
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

    <div class="col-8">
        <button id="sidebarCollapse" type="button" class="btn btn-menu shadow-sm"><i class="fa fa-bars"></i></button>
    </div>
    <div class="col-4 mt-2 align-items-right">
        <div class="d-flex top-header ">
            <img loading="lazy" src="../images/profile.png" alt="..." width="30" height="30">
            <div class="media-body">
                <a class="user-style"  href="#"><?php echo $_SESSION['fullname'] ?></a>
                
            </div>
        </div>
    </div>
    
  </div>
  
  <?php 
    $pdo = require '../sql/config/connection.php';
    $totalQty = 0;

    $showQty = "SELECT * FROM tbl_officials";
    $statement = $pdo->query($showQty);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
  <!-- Demo content -->
<div class="separator"></div>
  <div class="header">
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-sm-12" style="font-size:2rem">Dashboard <i class="fas fa-home mr-3 fa-fw"></i></div>
        </div>
      </div>
      <hr class="mt-2" style="margin:10px">
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="container">
          <div class="row g-4 align-items-start">
            <div class="col-md-4">
              <div class="card card-dash">
                <div class="col-sm-12">
                  <div class="card-header"><h5>Total Request</h5></div>
                    <div class="card-body">
                      <?php 
                        $showProducts = "SELECT * FROM tbl_request ";
                        $statement = $pdo->query($showProducts);
                        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $all = $statement->rowCount();
                        echo "<h5 class='mb-2'>".$all."</h5>";
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-dash">
                  <div class="col-sm-12">
                    <div class="card-header"><h5>Total Resident</h5></div>
                    <div class="card-body">
                      <?php 
                        $showProducts = "SELECT * FROM tbl_resident";
                        $statement = $pdo->query($showProducts);
                        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $all = $statement->rowCount();
                        echo "<h5 class='mb-2'>".$all."</h5>";
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-dash ">
                  <div class="col-sm-12">
                    <div class="card-header"><h5>Total Earnings</h5></div>
                    <div class="card-body">
                      <?php 
                         $totalSales = 0;
                        $showProducts = "SELECT * FROM tbl_invoice";
                        $statement = $pdo->query($showProducts);
                        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $all = $statement->rowCount();
                        foreach($products as $invoice){
                        $totalSales = $totalSales + $invoice['amount'];
                        }
                        echo "<h5 class='mb-2'>₱".number_format($totalSales).".00"."</h5>";
                      ?>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="header">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12" style="font-size:2rem">
                        Barangay Official <i class="fas fa-user  mr-3 fa-fw"></i>
                        </div>
                    </div>
                </div>
                <hr class="mt-2" style="margin:10px">
            </div>
        </div>
        <div class="container mt-2">
            <div class="table-responsive" style="height:350px" id="dynamic_content">
                        <!--Sample-->
                            
                        <!--End of Sample-->
            </div>
        </div>




<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="../bootstrap/js/main.js"></script>
<!-- <script language="JavaScript">

      
      window.onload = function () {
          document.addEventListener("contextmenu", function (e) {
              e.preventDefault();
          }, false);
          document.addEventListener("keydown", function (e) {
              //document.onkeydown = function(e) {
              // "I" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                  disabledEvent(e);
              }
              // "J" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                  disabledEvent(e);
              }
              // "S" key + macOS
              if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                  disabledEvent(e);
              }
              // "U" key
              if (e.ctrlKey && e.keyCode == 85) {
                  disabledEvent(e);
              }
              // "F12" key
              if (event.keyCode == 123) {
                  disabledEvent(e);
              }
          }, false);
          function disabledEvent(e) {
              if (e.stopPropagation) {
                  e.stopPropagation();
              } else if (window.event) {
                  window.event.cancelBubble = true;
              }
              e.preventDefault();
              return false;
          }
      }
//edit: removed ";" from last "}" because of javascript error
</script> -->
</body>
</html>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/fetch/info/fetch_dashboard.php",
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
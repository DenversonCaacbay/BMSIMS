<?php
require '../sql/auth/account_check2.php';
$pdo = require '../sql/config/connection.php';
                           
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <title>Admin | Payment History</title>
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
  width: 93%;
}

/* Style the buttons inside the tab */
.tab button {
  float: left;
  outline: none;
  cursor: pointer;
  padding: 5;
  margin-left:10px;
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
      <a href="resident_accounts.php" class="nav-link text-light">
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
      <a href="payment_history.php" class="nav-link hover-dark text-light">
      <i class="fas fa-file-invoice-dollar mr-3 text-light fa-fw"></i>
                Payment History
            </a>
    </li>
    <li class="nav-item">
      <a href="logs.php" class="nav-link text-light">
      <i class="fas fa-history mr-3 text-light fa-fw"></i>
                Logs
            </a>
    </li>



    <!---->

    <li class="nav-item" style="margin-top:30.5vh">
      <a href="../sql/auth/account_logout.php" class="nav-link nav-link1 text-light">
      <i class="fas fa-sign-out-alt mr-3 text-light fa-fw"></i>
                Logout
            </a>
    </li>
  </ul>

</div>

<!-- Page content holder -->

<!-- Page content holder -->
<div class="page-content p-4" id="content">
  <!-- Toggle button -->
  <div class="row nav1 mb-3">

    <div class="col-8">
        <button id="sidebarCollapse" type="button" class="btn btn-menu shadow-sm"><i class="fa fa-bars"></i></button>
    </div>
    <div class="col-4">
        <div class="media d-flex align-items-center top-header">
            <img loading="lazy" src="../images/profile.png" alt="..." width="30" height="30">
            <div class="media-body">
                <a class="user-style"  href="#" ><?php echo $_SESSION['fullname'] ?></a>
            </div>
        </div>
    </div>

  </div>
  <div class="separator"></div>
  <div class="header">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" style="margin-top:8px">
                    Payment History <i class="fas fa-user  mr-3 fa-fw"></i>
                    </div>
                    <div class="col-lg-4"> 
                      <div class="tab1">
                        <!-- <button class="btn tablinks" id="defaultOpen" onclick="openCity(event, 'Staff')">Staff</button> -->
                        <!-- <button class="btn tablinks" onclick="openCity(event, 'Official')">Officials</button> -->
                        <!-- <button class="btn tablinks" onclick="openCity(event, 'Resident')">Residents</button>
                        <button class="btn tablinks" onclick="openCity(event, 'Programs')">Programs</button>
                        <button class="btn tablinks" onclick="openCity(event, 'Transaction')">Transaction</button> -->
                        <a class="btn tablinks btn-custom btn-active" href="payment_history.php">All</a>
                        <a class="btn tablinks btn-custom" href="payment_history_pickup.php">Pick Up</a>
                        <a class="btn tablinks btn-custom " href="payment_history_gcash.php">Gcash</a>
                      </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
                <div class="container">
                    <div class="card2">
                        <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
                            <a href="../sql/generate_report/generate_all.php" class="btn btn-custom mt-2"  id="btnExport" value="Export" target="_blank">Generate PDF</a>
                            
                            <!-- <a href='print_invoice_all.php?pdf=1' target='_blank'>PDF</a> -->
                        </div>
                        <div class="table-responsive mt-2" style="height:400px" id="dynamic_content">
                            <!--Sample-->
                                
                            <!--End of Sample-->
                        </div>
                        <?php 
                         $totalSales = 0;
                                $showProducts = "SELECT * FROM tbl_invoice";
                                $statement = $pdo->query($showProducts);
                                $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                                $all = $statement->rowCount();
                                foreach($products as $invoice){
                                  $totalSales = $totalSales + $invoice['amount'];
                              }
                                echo "<h5 class='total mb-2 mt-5'>Total: ₱".number_format($totalSales).".00"."</h5>";
                            ?>
                        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>-->
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
        url:"../sql/logs/transaction_all.php",
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
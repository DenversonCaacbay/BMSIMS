<?php
session_start(); // Start the session
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to user_index.php
    header("Location: ../../../ad_index.php");
    exit;
}                           
?>
<?php
$host = 'localhost';
$db = 'u622464203_bmsims';
$user = 'u622464203_bmsims';
$pass = 'Bmsims2023';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to database successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php
    $query = "SELECT * FROM tbl_request WHERE request_status = 'Pending'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | Barangay ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
      <link rel="stylesheet" href="../../../bootstrap/css/staff_style.css">
</head>

<body>
 
<!-- Vertical navbar -->

<div class="vertical-nav" id="sidebar">
    <div class="card py-2 px-3 ">
        <div class="row">
            <div class="col-5">
                <img loading="lazy" src="../../../images/barangaylogo.png" alt="..." width="80" height="80" >
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
      <a href="../../dashboard.php" class="nav-link text-light">
      <i class="fas fa-home mr-3 text-light fa-fw" style="font-size:20px"></i>
                Dashboard
            </a>
    </li>

    <hr class="text-light">
    <p class="text-light font-weight-bold"></p>
    <!---->
    <li class="nav-item">
      <a href="../../menu.php" class="nav-link  hover-dark  text-light">
      <i class="fas fa-folder  mr-3 text-light fa-fw" style="font-size:20px"></i>
                List of Request
                
<?php if (!empty($entries)): ?>
                <i class="fas fa-exclamation-circle" style="margin-left:50px;font-size:18px;color: #fff;"></i> <!-- Red dot or any other indicator -->
              <?php endif; ?>
            </a>
</li>


    <!---->

    <li class="nav-item text-center mb-4" style="position:fixed;bottom:0;margin-left:6%;">
    <a href="../../../sql/auth/staff_account_logout.php" class="nav-link nav-link1 text-center text-light">
    <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/logout-rounded-left.png" alt="logout-rounded-left"/>
               
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
        <!-- <button id="sidebarCollapse" type="button" class="btn btn-menu shadow-sm"><i class="fa fa-bars"></i></button> -->
    </div>
    <div class="col-4 mt-2 align-items-right">
        <div class="d-flex top-header ">
            <img loading="lazy" src="../../../images/profile.png" alt="..." width="30" height="30">
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
                        <div class="col-sm-10" style="font-size:2rem">
                        <b>Barangay ID | PICK UP</b>
                        </div>
                        <!-- <div class="col-sm-2">
                          <div class="tab">
                            <a href="../barangay_id_pickup.php" class="btn btn-custom btn-active tablinks">Pick Up</a>
                            <a href="../barangay_id_gcash.php" class="btn btn-custom tablinks">Gcash</a>
                        </div>
                        </div> -->
                    </div>
                </div>
                <hr class="mt-2" style="margin:10px">
            </div>
        </div>

        <div class="container">
        <nav style="margin-left:15px;--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="../barangay_id_pickup.php">Pending Request</a></li>
                <!-- <li class="breadcrumb-item"><a href="processed.php">Processed</a></li> -->
                <li class="breadcrumb-item"><a href="get_record.php">Get Record</a></li>
                <li class="breadcrumb-item"><a href="done.php" class="link-active">Done</a></li>
                <li class="breadcrumb-item"><a href="disapproved.php">Disapproved</a></li>
            </ol>
        </nav>
            <div class="card-req">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-6">
                          <!-- <input type="text" style="width: 100%; float:left;" name="search" class="form-control" placeholder="Search" id="myInput"> -->
                          <input type="text" style="width: 100%; float:left;" name="search_box" id="search_box" class="form-control" placeholder="Search">
                        </div>
                        <div class="col-3 mt-3">
                          <h5 style="font-size:1rem;float:right">View By Date: </h5>
                        </div>
                        <div class="col-3">
                        <a href="done.php" class="btn btn-custom" style="width: 50px; float:right;padding:12px"><i class="fas fa-redo-alt" style="color:white;font-size:20px"></i></a>
                          <input type="date" style="width: 76%;margin-right:10px; float:right;" name="search1" class="form-control" placeholder="Search" id="myInput1">
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive  mt-3" style="height:400px" id="dynamic_content">
                        <!--Sample-->
                                
                        <!--End of Sample-->
                       
                    </div>
                    <!-- <a href="barangay_clearance_pickup_get_record.php" class="btn btn-custom" style="width: 98%;margin:10px; float:right;padding:7px">Refresh</a> -->
                  </div>
                  
                    
                    
                        
                </div>
            </div>
        </div>

           
    </div>

        </div>
    </div>
</div>


<!-- End demo content -->



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../bootstrap/js/main.js"></script>
<script src="../script.js"></script>
</body>
</html>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../../../sql/fetch/request_record/done/pick_up_id_done.php",
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
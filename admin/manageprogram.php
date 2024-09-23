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
<link rel="icon" href="images/loginimage.png">
    <title>BMSIMS | Programs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
      <link rel="stylesheet" href="../bootstrap/css/admin_style.css">
      <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
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

  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0"></p>

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
      <a href="manageprogram.php" class="nav-link hover-dark text-light">
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
      <!--<img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/logout-rounded-left.png" alt="logout-rounded-left"/>-->
       <img width="30" height="30" src="../images/icons/logout_button_white.png" alt="logout-rounded-left"/>
            </a>
    </li>
  </ul>

</div>

</div>
<!-- End vertical navbar -->

 
<!--Modal Add-->
<div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="font-weight:600; margin: 10px;"id="exampleModalLabel">Add Event</h3>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>

                <form action="../sql/post/program_insert.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">

                        <div class="form-group" style="margin: 10px">
                        <label>Event Title</label>
                            <input type="text" name="event_title" class="form-control" placeholder="Event Title" required>
                        </div>

                        <div class="form-group" style="margin:10px;">
                        <label>Event Date Time</label>
                                <input class="form-control form-select" type="date" id="birthdaytime" name="event_datetime">
                        </div>

                        <div class="form-group" style="margin: 10px">
                        <label>Event Place</label>
                            <input type="text" name="place" step="any" class="form-control" placeholder="Place" required>
                        </div>

                        <div class="form-group" style="margin: 10px">
                        <label>Event Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Description" required>
                        </div>
                        <input type="text" name="remove" value="1" hidden>

                        <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        <input type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                        <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                        <input type="text" name="status" class="form-control" placeholder="" value="Added" hidden>

                    </div>



                    <div class="modal-footer">
                        <button type="submit" name="insertdata" style="width:100%" class="btn btn-custom">Add Event</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<!--End of Modal Add-->

    
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Removing...</h5>
                <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>

            <form action="../sql/fetch/removing/program_delete.php" method="POST">
                <div class="modal-body">
                    <h5>Do you want to remove this event?</h5>
                    <input type="hidden" name="delete" id="program_id">

                    <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                    <input type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                    <input type="text" name="event_title" id="event_title" class="form-control" hidden>
                    <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                    <input type="text" name="status" class="form-control" placeholder="" value="Deleted" hidden>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                    <button type="submit" name="updatedata" style="background: #27329b; color:white;" class="btn successbtn">Remove</button>
                    
                </div>
            </form>

        </div>
    </div>
</div>
<script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#program_id').val(data[0]);
                $('#event_title').val(data[1]);
                //$('#payment_status').val(data[6]);
                // $('#payment_status').val(data[3]);    
                // $('#payment_status').val(data[4]);
                // $('#payment_status').val(data[5]);
                // $('#payment_status').val(data[6]);
                // $('#payment_status').val(data[7]);
                // $('#payment_status').val(data[8]);
            });
        });
    </script>  
<script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
  </script>

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
  <!-- Demo content -->
  <div class="separator"></div>
  <div class="header">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9" style="margin-top:8px">
                    <b>Barangay Programs</b> <i class="fas fa-calendar  mr-3 fa-fw"></i>
                    </div>
                    <div class="col-lg-3">
                    <!-- <a href="../sql/generate_report/generate_program.php" class="btn btn-custom"  id="btnExport" value="Export" target="_blank">Generate PDF</a> -->
                    <button type="button" class="btn btn-custom" style="float:right" data-toggle="modal" data-target="#studentaddmodal">
                         Add Program
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="container">
          <div class="card2">
            <div class="card-body">
              <div class="form-group">
                <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Enter Event Name" />
              </div>
              <div class="table-responsive mt-2" style="height:450px" id="dynamic_content">
                <!--Sample-->
                    
                <!--End of Sample-->
              </div>

            <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>-->
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
<script src="bootstrap/js/main.js"></script>

<script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#product_code').val(data[0]);
                $('#image').val(data[1]);
                
                $('#product_name').val(data[2]);
                $('#category').val(data[3]);
                $('#size').val(data[4]);
                $('#price').val(data[5]);
                $('#product_qty').val(data[6]);
            });
        });
    </script>


</body>
</html>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/fetch/info/fetch_program.php",
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
      var queryS = $('#search_box').val();
      load_data(1, queryS);
    });

  });
</script>

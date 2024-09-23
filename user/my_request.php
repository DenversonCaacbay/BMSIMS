<?php
session_start(); // Start the session
// session_destroy();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to user_index.php
    header("Location: user_index.php");
    exit;
}
                           
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | My Request</title>
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
<body>
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
                    <a class="nav-link active" href="my_request.php">My Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_profile.php">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link logoutbtn" href = "../sql/auth/user_account_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
  </nav><!-- //NAVBAR -->

  <!-- HERO -->
  <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="container mt-4">
              <div class="row">
                <div class="col-10"><h3 class="title1 text-lg-start mt-2">My Requests</h3></div>
                <div class="col-2"><button class="btn btn-history" data-toggle="modal" data-target="#studentaddmodal">View History</button></div>
              </div>
                
                
                <hr>
            </div>
        </div>
    </div>
    
      <!-- Cancel Modal -->
      <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="../sql/user_requests/request_cancel.php" method="POST">
                  <div class="modal-body">
                      <input type="hidden" name="delete" id="delete_id">
                      <h4 style="text-align:left;">Do you want to Cancel Request?</h4>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-validation" data-dismiss="modal"> NO </button>
                      <button type="submit" name="deletedata" class="btn btn-validation"> YES</button>
                  </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Transaction -->
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight:300; margin: 10px;" id="exampleModalLabel">History</h5>
                    <button type="button" class="btn btn-cancel" style="width:50px;border-radius:10px;" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <div class="container">
                  <div class="p-2">
                      <div class="table-responsive" style="height:500px;" id="history_content">
                          <!--Sample-->
                          <!--End of Sample-->
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
<!--End of Modal Add-->

    <div class="container">
      <div class="p-0">
          <div class="table-responsive" style="height:500px;" id="dynamic_content">
              <!--Sample-->
              <!--End of Sample-->
          </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
</body>
</html>
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/user_requests/fetch_user_request.php",
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
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/user_requests/history_user_request.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#history_content').html(data);
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
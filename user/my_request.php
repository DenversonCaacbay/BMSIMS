<?php
require '../sql/auth/account_user_check.php';
                           
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
          <img src="../images/BarangayLogo.png" height="30" class="d-inline-block align-text-top" style="border-radius:30px;">
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
                <h3 class="title1 text-lg-start">My Requests</h3>
                <hr>
            </div>
        </div>
    </div>
    <div class="container">
                        <div class="card p-1">
                            <div class="card-body">
                            
                            <div class="table-responsive" style="height:500px;" id="dynamic_content">
                                <!--Sample-->
                                    
                                <!--End of Sample-->
                            </div>
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
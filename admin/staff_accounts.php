<?php
require '../sql/auth/account_check2.php';
                           
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | Admin Accounts Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="style2.css">
</head>
<style>
  .password-container{
  position: relative;
}
.password-container input[type="password"],
.password-container input[type="text"]{
  width: 100%;
  padding: 12px 36px 12px 12px;
  box-sizing: border-box;
}
.fa-eye{
  position: absolute;
  top: 53%;
  right: 10%;
  cursor: pointer;
  color: #27329b;
}
</style>
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
  <p class="text-light font-weight-bold">Account Manager</p>
    <li class="nav-item">
      <a href="staff_accounts.php" class="nav-link hover-dark text-light">
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
      <a href="payment_history.php" class="nav-link text-light">
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
<!-- End vertical navbar -->

<!--Modal Add-->
<div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="font-weight:600; margin: 10px;"id="exampleModalLabel">Add Account</h3>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <form  action="../sql/account_admin/account_insert.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="row">
                      <div class="col-md-6 mt-4">
                              <label>Username</label>
                                  <input type="text" name="username" class="form-control" id="floatingInput" style="height:50px;">       
                              </div>
                              <div class="col-md-6 mt-4">
                              <label>Full Name</label>
                                  <input type="text" name="fullname" class="form-control" id="floatingInput" style="height:50px;" required>
                              </div>
                              <div class="col-md-6 mb-3 password-container">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" id="password1" style="height:50px;" required>
                                <i class="fas fa-eye" style="right: 10%;" id="eye1"></i>
                            </div>
                            <div class="col-md-6 mb-3 password-container">
                                <label>Confirm Password</label>
                                <input type="password" name="confirmPass" class="form-control" id="password2" style="height:50px;" required>
                                <i class="fas fa-eye" style="right: 10%;" id="eye2"></i>
                            </div>
                            <!-- <input type="text" name="remove" value="1" hidden> -->

                            <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                            <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                            <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                            <input type="text" name="status" class="form-control" placeholder="" value="Added" hidden>
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
                      </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="submit" value="Add Account" style="width:100%" class="btn btn-custom">
                        <!--<button type="submit" name="insertdata" style="width:100%" class="btn btn-custom">Add</button>-->
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

                <form action="../sql/account_admin/staff_forgot_password.php" method="POST">
                <div class="modal-body">
                  <input type="text" name="update" id="update_id" required>
                  <div class="row">
                    <div class="mb-3 password-container">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control" id="password" style="height:50px" required>
                      <i class="fas fa-eye" id="eye"></i>
                    </div>
                    <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                        <input type="text" name="username" id="username2" class="form-control" hidden>
                        <input type="text" name="fullname" id="fullname2" class="form-control" hidden>
                        <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                        <input type="text" name="status" class="form-control" placeholder="" value="Updated" hidden>
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

 <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Deleting... </h5>
                </div>

                <form action="../sql/account_admin/account_delete.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete" id="delete_id">

                        <h4> Do you want to Delete this Account?</h4>
                        <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>" hidden>
                        <input type="text" name="username" id="username1" class="form-control" hidden>
                        <input type="text" name="fullname" id="fullname1" class="form-control" hidden>
                        <input type="text" name="password" id="password1" class="form-control" hidden>
                        <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>" hidden>
                        <input type="text" name="status" class="form-control" placeholder="" value="Deleted" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-custom"> YES</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<!-- Delete Modal
<div class="modal fade" id="removemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="font-weight:600; margin: 10px;"id="exampleModalLabel">Do you want to remove this staff?</h3>
                <button type="button" style="background: #27329b; color:white;" class="btn" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>

            <form action="../sql/account_admin/account_delete.php" method="POST">
                <div class="modal-body">
                    <input type="text" name="acc_id" id="acc_id" >
                    <input type="text" name="remove" id="remove" class="form-control">

                    <input type="text" name="acc_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="text" name="staff" value="<?php echo $_SESSION['fullname'] ?>">
                    <input type="text" name="fullname" id="fullname" class="form-control">
                    <input type="text" name="date_config" value="<?php echo date("Y-m-d"); ?>">
                    <input type="text" name="status" class="form-control" placeholder="" value="Deleted">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                    <button type="submit" name="updatedata" style="background: #27329b; color:white;" class="btn successbtn">Remove</button>
                    
                </div>
            </form>

        </div>
    </div>
</div> -->

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
                    <div class="col-lg-10" style="margin-top:8px">
                    Staff Account <i class="fas fa-user  mr-3 fa-fw"></i>
                    </div>
                    <div class="col-lg-2">
                    <button type="button" class="btn btn-custom" style="width:100%" data-toggle="modal" data-target="#studentaddmodal">
                         Add Account
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
                <!--<input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />-->
              </div>
              <div class="table-responsive" id="dynamic_content">
                <!--Sample-->
                    
                <!--End of Sample-->
              </div>
            
            <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>-->
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
<script src="../bootstrap/js/main.js"></script>
</body>
</html>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/account_admin/fetch_staff_accounts.php",
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
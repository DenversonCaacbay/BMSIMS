<?php
// require '../sql/auth/account_user_check.php'; 

session_start(); // Start the session
// session_destroy();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to user_index.php
    header("Location: user_index.php");
    exit;
}
// Check if user is not logged in, redirect to login.php
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header('Location: user_index.php');
//     exit;
// }                    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | Requests</title>
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
<style>
    .myDiv{
        display:N/A;
    }  
    .myDiv1{
        display:none;
    }  
    .row-eq-height .card {
      margin-bottom: 20px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
      transition: box-shadow 0.3s;
    }
    .row-eq-height .card-body {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .row-eq-height .card-content {
      flex-grow: 1;
    }
 
</style>


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
                    <a class="nav-link active" href="request.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_request.php">My Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logoutbtn" href="../sql/auth/user_account_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
  </nav><!-- //NAVBAR -->

  <!--MODALS-->
  <div class="modal fade" id="clearancemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Request Form | Barangay Clearance</h5>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                </div>
                <form action="../sql/post/insert_clearance.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 come">
                            <div class="col-md-12 form-group mt-3 mb-3" hidden>
                            <label>Date Requested</label>
                            <input style="padding:13px;" class="form-control form-select" type="date" name="req_date" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'] ?>" placeholder="text" id="floatingInput"   >
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Request</label>
                            <input type="text" name="request_type" class="form-control" value="Barangay Clearance" placeholder="text" id="floatingInput"  >
                        </div>
                        <div class="col-md-12 mb-3 form-group">
                            <label>Purpose</label>
                            <select style="padding:13px" class="form-control form-select" name="purpose" id="myselection6" required>
                                <option selected></option>
                                <option value="Getting A Job">Getting a Job</option>
                                <option value="Opening Bank Account">Opening Bank Account</option>
                                <option value="Applying for another ID">Applying for another ID</option>
                                <option value="For School">For School</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Name *Contact Incase of Emergency</label>
                            <input type="text" name="notify" class="form-control" placeholder="" value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mb-3" hidden>
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control"  value="N/A" required>
                        </div>
                        <div id="showOther" class="myDiv1">

                            <div class="col-md-12 mt-3 mb-3">
                                <input type="text" name="purpose1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_open" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_close" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12">
                            <label>Get Date</label>
                            <input type="date" name="get_date" class="form-control" value="" placeholder="text"  id="txtDate" required  >
                        </div>
                        <div class="col-md-12 form-group mt-3">
                            <label>Mode Of Payment</label>
                            <select style="padding:13px" class="form-control form-select" name="payment_method" id="paymentselection" required>
                                <option selected></option>
                                <option value="Pick Up">Pick Up</option>
                                <option value="Gcash">Gcash</option>
                                
                            </select>
                        </div>
                        <div id="showGcash" class="myDiv">
                            <div class="row">
                                <div class="col-7 mt-3">
                                    <h3 class="title2" style="text-align:left">GCASH Details :</h3>
                                    <h6>Denverson F. Caacbay</h6>
                                    <h6>09123456789</h6>
                                    <h6>₱ 50.00</h6>
                                </div>
                                <div class="col-4">
                                    <img class="qr" src="../images/gcash_qr.jpg" alt="gcash_qr" width="100">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12 mt-3 mb-3">
                                <label>Add Gcash Reference #</label>
                                <input type="number" name="reference_no" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3 mb-3" hidden>
                                    <label>Enter Amount:</label>
                                    <input type="number" name="amount" value="50" class="form-control" readonly>
                            </div>
                            <div class="col-md-12 form-group mb-3" hidden>
                                <label>Date Paid</label>
                                <input style="padding:13px;" class="form-control form-select" type="date" name="date_paid" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
 
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Payment Status</label>
                            <input type="text" name="payment_status" class="form-control" value="Pending">
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Request Status</label>
                            <input type="text" name="request_status" class="form-control" value="Pending">
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']?>" placeholder="text" id="floatingInput"   >
                        </div>
                            </div>
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="submit" name="insertdata" class="btn btn-custom">Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="idmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Form | Barangay ID</h5>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                </div>

                <form action="../sql/post/insert_id.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">

                    <div class="col-md-12 form-group mt-3 mb-3" hidden>
                            <label>Date Requested</label>
                            <input style="padding:13px;" class="form-control form-select" type="date" name="req_date" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'] ?>" placeholder="text" id="floatingInput"   >
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Request Type</label>
                            <input type="text" name="request_type" class="form-control" value="Barangay ID" placeholder="text" id="floatingInput"   >
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Purpose</label>
                            <input type="text" name="purpose" class="form-control" placeholder="" value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <label>Name *Contact Incase of Emergency</label>
                            <input type="text" name="notify" class="form-control" placeholder="" value="" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"  value="" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control"  value="" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_open" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_close" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12">
                            <label>Get Date</label>
                            <input type="date" name="get_date" class="form-control" value="" id="txtDate" required>
                        </div>
                        <div class="col-md-12 mt-3 form-group">
                            <label>Mode Of Payment</label>
                            <select style="padding:13px;" class="form-control form-select" name="payment_method" id="myselection1" required>
                                <option selected></option>
                                <option value="Pick Up">Pick Up</option>
                                <option value="Gcash1">Gcash</option>
                                
                            </select>
                        </div>
                        <div id="showGcash1" class="myDiv">
                            <div class="row">
                                <div class="col-7 mt-3">
                                    <h3 class="title2" style="text-align:left">GCASH Details :</h3>
                                    <h6>Leo Angelo Novo</h6>
                                    <h6>09123456789</h6>
                                    <h6>₱ 50.00</h6>
                                </div>
                                <div class="col-4">
                                    <img class="qr" src="../images/gcash_qr.jpg" alt="gcash_qr" width="100">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <label>Add Gcash Reference #</label>
                                <input type="text" name="reference_no" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3 mb-3" hidden>
                                    <label>Enter Amount:</label>
                                    <input type="number" name="amount" value="50" class="form-control">
                            </div>
                            <div class="col-md-12 form-group mb-3" hidden>
                                <label>Date Paid</label>
                                <input style="padding:13px;" class="form-control form-select" type="date" name="date_paid" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Payment Status</label>
                            <input type="text" name="payment_status" class="form-control" value="Pending">
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="request_status" class="form-control" value="Pending" required>
                        </div>
                        <div class="col-md-12" hidden >
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']?>" placeholder="text" id="floatingInput">
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="submit" name="insertdata" class="btn btn-custom">Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="indigencymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Form | Indigency</h5>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                </div>

                <form action="../sql/post/insert_indigency.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">

                        <div class="col-md-12 form-group mt-3 mb-3" hidden>
                            <label>Date Requested</label>
                            <input style="padding:13px;" class="form-control form-select" type="date" name="req_date" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'] ?>" placeholder="text" id="floatingInput"   >
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Request</label>
                            <input type="text" name="request_type" class="form-control" value="Indigency" placeholder="text" id="floatingInput"  >
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Purpose</label>
                            <select style="padding:13px;" class="form-control form-select" name="purpose" id="myselection" required>
                                <option selected></option>
                                <option value="Financial">Financial</option>
                                <option value="Educational">Educational</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Name *Contact Incase of Emergency</label>
                            <input type="text" name="notify" class="form-control" placeholder="" value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mb-3" hidden>
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_open" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_close" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Get Date</label>
                            <input type="date" name="get_date" class="form-control" value="" placeholder="text"  id="txtDate" required  >
                        </div>
                        <!-- <div class="col-md-12 mt-3 form-group">
                            <label>Get Request From Monday to Friday</label>
                            <select style="padding:13px" class="form-control form-select" name="get_date" required>
                                <option selected></option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div> -->
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="payment_method" class="form-control"  value="Pick Up" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="reference_no" class="form-control"  value="N/A">
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                                    <label>Enter Amount:</label>
                                    <input type="number" name="amount" value="0" class="form-control">
                            </div>
                            <div class="col-md-12 form-group mb-3" hidden>
                                <label>Date Paid</label>
                                <input style="padding:13px;" class="form-control form-select" type="date" name="date_paid" value="N/A">
                            </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="payment_status" class="form-control"  value="Pending" required>
                        </div>
                        
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="request_status" class="form-control" value="Pending" required>
                        </div>
                        <div class="col-md-12" hidden >
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']?>" placeholder="text" id="floatingInput"   >
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="submit" name="insertdata" class="btn btn-custom">Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="residencymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Form | Residency</h5>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                </div>

                <form action="../sql/post/insert_residency.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">

                    <div class="col-md-12 form-group mt-3 mb-3" hidden>
                            <label>Date Requested</label>
                            <input style="padding:13px;" class="form-control form-select" type="date" name="req_date" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-12" hidden >
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'] ?>" placeholder="text" id="floatingInput"   >
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Request</label>
                            <input type="text" name="request_type" class="form-control" value="Residency" placeholder="text" id="floatingInput">
                        </div>

                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Purpose</label>
                            <input type="text" name="purpose" class="form-control" placeholder="Purpose"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Name *Contact Incase of Emergency</label>
                            <input type="text" name="notify" class="form-control" placeholder="" value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mb-3" hidden>
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_open" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label></label>
                            <input type="text" name="date_close" class="form-control"  value="N/A" required>
                        </div>

                        <div class="col-md-12">
                            <label>Get Date</label>
                            <input type="date" name="get_date" class="form-control" value="" placeholder="text"  id="txtDate" required  >
                        </div>
                        <!-- <div class="col-md-12 form-group">
                            <label>Get Request From Monday to Friday</label>
                            <select style="padding:13px" class="form-control form-select" name="get_date" required>
                                <option selected></option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div> -->
                        <div class="col-md-12 mt-3 form-group">
                            <label>Mode Of Payment</label>
                            <select style="padding:13px" class="form-control form-select" name="payment_method" id="myselection2" required>
                                <option selected></option>
                                <option value="Pick Up">Pick Up</option>
                                <option value="Gcash2">Gcash</option>
                                
                            </select>
                        </div>
                        <div id="showGcash2" class="myDiv">
                            <div class="row">
                                <div class="col-7 mt-3">
                                    <h3 class="title2" style="text-align:left">GCASH Details :</h3>
                                    <h6>Leo Angelo Novo</h6>
                                    <h6>09123456789</h6>
                                    <h6>₱ 50.00</h6>
                                </div>
                                <div class="col-4">
                                    <img class="qr" src="../images/gcash_qr.jpg" alt="gcash_qr" width="100">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <label>Add Gcash Reference #</label>
                                <input type="text" name="reference_no" class="form-control" >
                            </div>
                            <div class="col-md-12 mt-3 mb-3" hidden>
                                    <label>Enter Amount:</label>
                                    <input type="number" name="amount" value="50"class="form-control">
                            </div>
                            <div class="col-md-12 form-group mb-3" hidden>
                                <label>Date Paid</label>
                                <input style="padding:13px;" class="form-control form-select" type="date" name="date_paid" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Payment Status</label>
                            <input type="text" name="payment_status" class="form-control" value="Pending">
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Request Status</label>
                            <input type="text" name="request_status" class="form-control" value="Pending">
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']?>" placeholder="text" id="floatingInput">
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="submit" name="insertdata" class="btn btn-custom">Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="closuremodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Request Form | Business Permit</h5>
                    <button type="button" class="btn btn-cancel" data-dismiss="modal"> X </button>
                </div>

                <form action="../sql/post/insert_permit.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">

                    <div class="col-md-12 form-group mt-3 mb-3" hidden>
                            <label>Date Requested</label>
                            <input style="padding:13px;" class="form-control form-select" type="date" name="req_date" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'] ?>" placeholder="text" id="floatingInput"   >
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Request</label>
                            <input type="text" name="request_type" class="form-control" value="Business Permit" placeholder="text" id="floatingInput"  >
                        </div>

                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Purpose</label>
                            <input type="text" name="purpose" class="form-control" placeholder="Purpose"  value="N/A"   required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Name *Contact Incase of Emergency</label>
                            <input type="text" name="notify" class="form-control" placeholder="" value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Address</label>
                            <input type="text" name="address" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mb-3" hidden>
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control"  value="N/A" required>
                        </div>
                        <div class="col-md-12 mt-3 mb-3">
                            <label>Store Name</label>
                            <input type="text" name="date_open" class="form-control" id="txtDate">
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Date Closing</label>
                            <input type="text" name="date_close" class="form-control" value="N/A"  required>
                        </div>
                        <div class="col-md-12">
                            <label>Get Date</label>
                            <input type="date" name="get_date" class="form-control" value="" placeholder="text"  id="txtDate" required  >
                        </div>
                        <!-- <div class="col-md-12 mt-3 form-group">
                            <label>Get Request From Monday to Friday</label>
                            <select style="padding:13px" class="form-control form-select" name="get_date" required>
                                <option selected></option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div> -->
                        <div class="col-md-12 mt-3 form-group">
                            <label>Mode Of Payment</label>
                            <input type="text" name="payment_method" class="form-control" value="Pick Up" id="txtDate">
                        </div>
                        <div id="showGcash3" class="myDiv">
                            <div class="row">
                                <div class="col-7 mt-3">
                                    <h3 class="title2" style="text-align:left">GCASH Details :</h3>
                                    <h6>Leo Angelo Novo</h6>
                                    <h6>09123456789</h6>
                                    <h6>₱ 50.00</h6>
                                </div>
                                <div class="col-4">
                                    <img class="qr" src="../images/gcash_qr.jpg" alt="gcash_qr" width="100">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <label>Add Gcash Reference #</label>
                                <input type="text" name="reference_no" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3 mb-3" hidden>
                                    <label>Enter Amount:</label>
                                    <input type="number" name="amount" value="50" class="form-control">
                            </div>
                            <div class="col-md-12 form-group mb-3" hidden>
                                <label>Date Paid</label>
                                <input style="padding:13px;" class="form-control form-select" type="date" name="date_paid" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Payment Status</label>
                            <input type="text" name="payment_status" class="form-control" value="Pending">
                        </div>
                        <div class="col-md-12 mt-3 mb-3" hidden>
                            <label>Request Status</label>
                            <input type="text" name="request_status" class="form-control" value="Pending"   required>
                        </div>
                        <div class="col-md-12" hidden>
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']?>" placeholder="text" id="floatingInput"   >
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="submit" name="insertdata" class="btn btn-custom">Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



   
<!--End of Modal Add-->

<div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight:600; margin: 10px;" id="exampleModalLabel">How to use</h5>
                    <button type="button" class="btn btn-cancel" style="width:50px;border-radius:10px;" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <div class="container">
                    <div class="row-12">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Requesting
                                </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p><code>1. </code>Fill Up the Form</p>
                                    <p><code>2. </code>After Request you can view your request in My Request section</p>
                                    <p><code>3. </code>Wait for it to be approved. or </p>
                                    <p><code>4. </code>You can cancel your request before getting approved</p>
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Paying with GCASH
                                </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p><code>1. </code>Input the number flash on screen when requesting record or Scan the Qr Code.</p>
                                        <p><code>2. </code>After Paying there is a reference No. included in gcash. Get it and put it in the form.</p>
                                        <p><code>3. </code>After requesting admin will check if the reference number is correct.</p>
                                        <p><code>4. </code>Then admin will check if your request will be approved or not.</p>
                                        <p><code>Note: </code>No refund if you did not get your request on time.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-5">
                                <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Getting Your Record
                                </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p><code>1. </code>Check Request status if its Get Record</p>
                                        <p><code>2. </code>If Request Status is Get Record you can pick the record you request on day you want to get your request.</p>
                                        <p><code>4. </code>You have to present an ID for identification to know if you are the one requesting the record.</p>
                                        <p><code>List of ID</code></p>
                                        <p>School ID</p>
                                        <p>SSS</p>
                                        <p>PAG-IBIG</p>
                                        <p>PHILsys</p>
                                        <p>Voters</p>
                                        <p>Tin</p>
                                        <p>Company ID</p>
                                        <p>Passport</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
<!--End of Modal Add-->

  <!--END OF MODALS-->

  <div class="container">
    <div class="card">
        <div class="row">
            <div class="col-10 ins">
                <h5 class="mt-2">Instruction</h5>
            </div>
            <div class="col-2 truc">
                <button class="btn btn-custom" style="margin:0;padding:5px;" data-toggle="modal" data-target="#studentaddmodal">View</button>
            </div>
        </div>
    </div>
  </div>



    <div class="container mt-5 mb-5">
    <h3 style="text-align:left">Request Forms</h3>
        <div class="row g-1 row-eq-height">
            <div class="col-md-3">
                <div class="card" id="card1">
                    <div class="card-body">
                        <div class="card-content">
                            <h5 class="card-title">Barangay Clearance</h5>
                            <p class="card-text">₱50.00</p>
                            <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#clearancemodal">Request Form</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" id="card2">
                    <div class="card-body">
                        <div class="card-content">
                            <h5 class="card-title">Barangay Id</h5>
                            <p class="card-text">₱50.00</p>
                            <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#idmodal">Request Form</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" id="card3">
                    <div class="card-body">
                        <div class="card-content">
                            <h5 class="card-title">Indigency</h5>
                            <p class="card-text">₱50.00</p>
                            <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#indigencymodal">Request Form</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" id="card4">
                    <div class="card-body">
                        <div class="card-content">
                            <h5 class="card-title">Residency</h5>
                            <p class="card-text">₱50.00</p>
                            <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#residencymodal">Request Form</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card" id="card5">
                    <div class="card-body">
                        <h5 class="card-title">Business Permit</h5>
                        <p class="card-text">₱50.00</p>
                        <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#closuremodal">Request Form</a>
                    </div>
                </div>
            </div>
            <!-- <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Business Permit Renewal</h5>
                        <p class="card-text">₱50.00</p>
                        <a href="#" class="btn btn-custom" data-toggle="modal" data-target="#permitmodal">Request Form</a>
                    </div>
                </div>
            </div>
             -->
            

        </div>
    </div>
    
    

</div><!-- //HERO -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../bootstrap/js/main.js"></script>

    <script>
        var dateControler = {
        	currentDate : null
        }

        $(document).on( "change", "#txtDate",function( event, ui ) {
        var now = new Date();
        var selectedDate = new Date($(this).val());
        		        
        if(selectedDate < now) {
            $(this).val(dateControler.currentDate)
        } else {
            dateControler.currentDate = $(this).val();
        }
        });   
    </script>
    <script>
    $(document).ready(function(){
        $('#paymentselection').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script> 
    <script>
    $(document).ready(function(){
        $('#myselection1').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script> 
    <script>
    $(document).ready(function(){
        $('#myselection2').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script> 
    <script>
    $(document).ready(function(){
        $('#myselection3').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script> 
    <script>
    $(document).ready(function(){
        $('#myselection4').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        $('#myselection5').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#show"+demovalue).show();
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        $('#myselection6').on('change', function(){
            var demovalue = $(this).val(); 
            $("div.myDiv1").hide();
            $("#show"+demovalue).show();
        });
    });
    </script>

    <!-- <script>
       setTimeout(function() {
        swal({
            title: "Hello",
            text: "Login Successfully",
            type: "success"
        });
    }, 1000);
</script> -->

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
</body>
</html>
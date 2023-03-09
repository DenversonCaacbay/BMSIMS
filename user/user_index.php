
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/loginimage.png">
    <title>BMSIMS - Resident</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
<!-- <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../images/BarangayLogo.png" height="30" class="d-inline-block align-text-top" style="border-radius:30px;">
            Barangay Matain SIMS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="mobile-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" style="cursor:pointer;" data-toggle="modal" data-target="#studentaddmodal">
                         How to Use
                    </a>
                </li>

            </ul>
        </div>
    </div>
  </nav>//NAVBAR -->

<div class="modal fade mt-5" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password | Instruction</h5>
                    <button type="button" class="btn btn-custom" style="width:50px;border-radius:10px;" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <div class="container">
                <div class="row-12">
                    <div class="col mb-3">
                        <div class="card-2">
                            <div class="card-body">
                                <h5 class="card-title">For password reset requests and other reports, kindly send an email, Using your email account or your registered alternate email account (personal) with the following format:</h5>
                                <p class="card-text">
                                    Subject: Password RESET Request (or the issue that you want to resolve)<br><br>
                                    Full Name (LN, FN MI): [lastname, firstname, middle initial]<br><br>
                                    Reason: [state your reason here]<br><br>
                                    Note: Attach a clear and verifiable screenshot/s of the reported issue.<br>

                                    <a class="btn btn-custom show" href="https://mail.google.com/mail/?view=cm&fs=1&to=barangaymatainsims@gmail.com&su=Password Reset Request&body=Fullname:
                                    Reason:
                                    " target="_blank">Send Us an EMail</a>
                                    <a class="btn btn-custom hide" href="mailto:barangaymatainsims@gmail.com?subject=Password Reset Request&body=Fullname:
                                    Reason:" target="_blank">Send Us an EMail</a>
</p>
                            </div>
                        </div>
                    </div>
                   
                    
                    
                </div>
                </div>
                

            </div>
        </div>
    </div>
<!--End of Modal forgot-->

  
<section id="hero">
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12 loginimage">
                <img class="loginimage1" src="../images/BarangayLogo.png">
                <h3 class="tag mt-3">Welcome Resident</h3>
            </div>
            <div class="col-lg-12">
                    <div class="card card3 col-lg-12">
                        <form action="../sql/auth/resident_login.php" class="signin" method="POST">
                            <div class="mb-3">
                               
                                <h3 class="mb-3">Login</h3>
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" id="floatingInput" required>
                                    
                                </div>
                               
                                <div class="mb-3 password-container">
                                    <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <i class="fas fa-eye" id="eye"></i>
                                </div>

                                <input type="submit" name="submit"  id="btnSubmit" value="Login" class="btn btn-custom">
                                <a href="user_register.php" class="btn btn-custom">Register</a>
                                <!-- <h5 class="mt-3" style="text-align:center;font-size:18px;"><a style="text-decoration:none;cursor:pointer;" href="sql/forgot_password/forgot_password.php">Forgot Password?</a></h5> -->
                                <h5 class="mt-3" style="text-align:center;font-size:18px;"><a style="text-decoration:none;cursor:pointer;" href="#" data-toggle="modal" data-target="#forgotModal">Forgot Password?</a></h5>
                                <h5 class="mt-3" style="text-align:center;font-size:18px;">BMSIMS v1.0</h5>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
  

  <!-- End Projects Section -->


  <!-- Contact Section -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <script>
        const passwordInput = document.querySelector("#password")
        const eye = document.querySelector("#eye")

        eye.addEventListener("click", function(){
        this.classList.toggle("fa-eye-slash")
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
        passwordInput.setAttribute("type", type)
        })
    </script>

</body>
</html>
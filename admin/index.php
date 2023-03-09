
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/barangaylogo.png">
    <title>BMSIMS</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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


<div class="container hero">
    <div class="row">
        <div class="col-lg-12 loginimage">
            <img class="loginimage1" src="../images/BarangayLogo.png" >
            <h3 class="tag mt-3">Barangay Matain</h3>
            <h4 class="tag mt-3">Staff Panel</h4>
        </div>
        <div class="col-lg-12">
            <div class="card card3 col-lg-12">
                <form action="../sql/auth/account_login.php" class="signin" method="POST">
                    <div class="mb-3">
                        
                        <span style="text-align:center" class="mb-3">Login</span>
                        <p class="error error-message"></p>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" id="floatingInput" required>
                                    
                        </div>
                        <div class="mb-3 password-container">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                            <i class="fas fa-eye" id="eye"></i>
                        </div>

                        <input type="submit" name="submit"  value="Login" class="btn btn-custom">
                        <h5 class="mt-3" style="text-align:center;font-size:18px;">BMSIMS v1.0</h5>
                    </div>
                </form>
  
            </div>

        </div>
    </div>
 
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
    
</div>
</body>
</html>


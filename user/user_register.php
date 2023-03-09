<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS - Resident</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <scrip src="../bootstrap/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
</head>
<body style="background: #27329b">
<div class="container">
    <div class="card col-lg-12 mx-auto mb-3" style="box-shadow:none;">
        <form action="../sql/auth/resident_register.php" enctype="multipart/form-data" class="row g-2" method="POST" id="showReg">
            <h3>Resident
                <span>Register</span>
            </h3> 
            <input type="hidden" name="admin_power" class="form-control" id="floatingInput" value="Not Approved" style="height:50px;" hidden>
            <div class="col-md-12">
                <label>Profile Picture</label>
                <input type="file" name="profile_pic" class="form-control"  id="floatingInput" style="height:50px;" require>
                                  
            </div>
            

            <div class="col-md-12">
                <label>Username</label>
                <input type="text" name="username" class="form-control"  id="floatingInput" style="height:50px;" required>
                                  
            </div>
            <div class="col-md-4">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" id="floatingInput"  style="height:50px;" required>    
            </div>
            <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" name="middlename" class="form-control" id="floatingInput" style="height:50px;" required>  
            </div>
            <div class="col-md-4">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" id="floatingInput"  style="height:50px;" required> 
            </div>
            <div class="col-md-4 form-group">
                <label>Gender</label>
                <select style="padding:13px;" class="form-control form-select" name="gender" id="inputGroupSelect01">
                    <option selected disabled> </option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Place of Birth</label>
                <input type="text" name="place_of_birth" class="form-control" required>
            </div>
            <div class="col-md-4 form-group">
                <label>Birthdate</label>
                    <input style="padding:13px;" class="form-control form-select" type="date" name="bdate">
            </div>
            <div class="col-md-4 form-group">
                <label>Status</label>
                <select style="padding:13px;" class="form-control form-select" name="civil_status" id="inputGroupSelect01">
                    <option selected disabled> </option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Address</label>
                <input type="text" name="address" class="form-control"id="floatingInput" style="height:50px;">
            </div>
            <div class="col-md-4 form-group">
                <label>Purok</label>
                <select style="padding:13px;" class="form-control form-select" name="purok" id="inputGroupSelect01">
                    <option selected disabled> </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="floatingInput" style="height:50px;" required>                                      
            </div>
            <div class="col-md-6">
                <label>Contact Number</label>
                <input type="text" name="phone" class="form-control" id="floatingInput"  style="height:50px;" required>                              
            </div>
            <div class="col-md-12">
                <label>Add ID or Billing paper with address for Checking if you are trully living in Barangay Matain</label>
                <input type="file" name="image" class="form-control"  id="floatingInput" style="height:50px;" require>
                                  
            </div>
            <div class="col-md-6 mb-3 password-container">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="password" style="height:50px;" required>
                <i class="fas fa-eye" id="eye"></i>
            </div>
            <div class="col-md-6 mb-3 password-container">
                <label>Confirm Password</label>
                <input type="password" name="confirmPass" class="form-control" id="password1" style="height:50px;" required>
                <i class="fas fa-eye" id="eye1"></i>
            </div>
            <input type="submit" name="submit" value="Register" class="btn btn-custom">
        </form>
                          

           
                          
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
    <script>
        const passwordInput1 = document.querySelector("#password1")
        const eye1 = document.querySelector("#eye1")

        eye1.addEventListener("click", function(){
        this.classList.toggle("fa-eye-slash")
        const type = passwordInput1.getAttribute("type") === "password" ? "text" : "password"
        passwordInput1.setAttribute("type", type)
        })
    </script>
</body>
</html>
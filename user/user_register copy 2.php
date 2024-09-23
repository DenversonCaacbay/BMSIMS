<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script src="registration.js" defer></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="registration.css" />
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <title>Registration Form</title>
  </head>
  <body class="bg-light">
    <div class="container mt-3">
      <div class="row">
        <div class="col-12">
        <form action="../sql/auth/resident_register.php" method="POST" id="showReg" enctype="multipart/form-data" >
      <h1 class="text-center">Registration Form</h1>
      <!-- Progress bar -->
      <div class="progressbar">
        <div class="progress" id="progress"></div>
        
        <div class="progress-step progress-step-active" data-title=""></div>
        <div class="progress-step" data-title=""></div>
        <div class="progress-step" data-title=""></div>
        <div class="progress-step" data-title=""></div>
        <div class="progress-step" data-title=""></div>
      </div>
 
      <!-- Steps -->
      <div class="form-step form-step-active">
      <input type="hidden" name="admin_power" class="form-control" id="floatingInput" style="height:50px;" hidden>
      <div class="">
          <label for="position">Profile Picture</label>
          <input type="file" name="profile_pic" class="form-control" id="position" />
        </div>
        <div class="mt-3">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" id="username" required/>
        </div>
        <div class="mt-3">
          <label for="position">First Name</label>
          <input type="text" name="firstname" class="form-control" id="position" />
        </div>
        <div class="mt-3">
          <label for="position">Middle Name</label>
          <input type="text" name="middlename" class="form-control" id="position" />
        </div>
        <div class="mt-3">
          <label for="position">Last Name</label>
          <input type="text" name="lastname" class="form-control" id="position" />
        </div>
        <div class="container mt-3 mb-3 sample">
          <div class="row">
            <div class="col-6"><a href="user_index.php" class="btn">Back to Login</a></div>
            <div class="col-6"><a href="#" class="btn btn-next">Next</a></div>
          </div>
          
        </div>
      </div>
      <div class="form-step">
        <div class="mt-3">
          <label for="phone">Gender</label>
          <select style="padding:13px;" class="form-control form-select" name="gender" id="inputGroupSelect01">
            <option selected disabled> </option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="mt-3">
          <label for="email">Place of Birth</label>
          <input type="text" name="place_of_birth" class="form-control" id="email" />
        </div>
        <div class="mt-3">
          <label for="email">Birth Date</label>
          <input type="date" name="bdate" class="form-control" id="email" />
        </div>
        <div class="mt-3 mb-3">
          <label for="email">Status</label>
          <select style="padding:13px;" class="form-control form-select" name="civil_status" id="inputGroupSelect01">
            <option selected disabled> </option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
          </select>
        </div>
        <div class="container mt-3 mb-3 sample">
          <div class="row">
            <div class="col-6"><a href="#" class="btn btn-prev">Previous</a></div>
            <div class="col-6"><a href="#" class="btn btn-next">Next</a></div>
          </div>
          
        </div>
      </div>
      <div class="form-step">
        <div class="mt-3">
          <label for="dob">Complete Addresss</label>
          <input type="text" name="address" class="form-control" id="dob" />
        </div>
        <div class="mt-3">
          <label for="dob">Purok</label>
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
        <div class="mt-3">
          <label for="dob">Email Address</label>
          <input type="email" class="form-control" name="email" id="dob" />
        </div>
        <div class="mt-3">
          <label for="ID">Contact Number</label>
          <input type="number" class="form-control" name="phone" id="ID" />
        </div>
        <div class="container mt-3 mb-3 sample">
          <div class="row">
            <div class="col-6"><a href="#" class="btn btn-prev">Previous</a></div>
            <div class="col-6"><a href="#" class="btn btn-next">Next</a></div>
          </div>
          
        </div>
      </div>
      <div class="form-step">
        <div class="mt-3">
          <label for="dob">Attach copy of Valid ID with Address or Billing Such as: Electric Bill or Water Bill</label>
          <input type="file" class="form-control" name="image" id="dob" />
        </div>
        <div class="container mt-3 mb-3 sample">
          <div class="row">
            <div class="col-6"><a href="#" class="btn btn-prev">Previous</a></div>
            <div class="col-6"><a href="#" class="btn btn-next">Next</a></div>
          </div>
          
        </div>
      </div>
      <div class="form-step">
        <div class="col-md-12 mb-3 password-container">
            <label>Password</label>
            <input type="password" name="password" class="form-control" id="password" style="height:50px;" required>
            <i class="fas fa-eye" id="eye"></i>
        </div>
        <div class="col-md-12 mb-3 password-container">
            <label>Confirm Password</label>
            <input type="password" name="confirmPass" class="form-control" id="password1" style="height:50px;" required>
            <i class="fas fa-eye" id="eye1"></i>
        </div>
        <div class="mt-3">
          <code>*</code>Please wait for an Email. The admin will confirm your registration. Thank you.
        </div>
        <div class="container mt-3 mb-3 sample">
          <div class="row">
            <div class="col-6"><a href="#" class="btn btn-prev">Previous</a></div>
            <div class="col-6"><input type="submit" value="Submit" class="btn" style="width:100%;"/></div>
          </div>
          
        </div>
      </div>
    </form>
        </div>
      </div>
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

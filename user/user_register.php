<?php include('../sql/auth/check_exist.php'); ?>
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
    <script>
    function calculateAge() {
      var dobInput = document.getElementById("bdate");
      var ageInput = document.getElementById("age");
      var errorMessage = document.getElementById("error-message");

      var dob = new Date(dobInput.value);
      var today = new Date();

      var age = today.getFullYear() - dob.getFullYear();

      // Check if the birthday has not occurred yet this year
      if (today.getMonth() < dob.getMonth() ||
          (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
        age--;
      }

      ageInput.value = age;

      if (age <= 17) {
        ageInput.value = "";
        errorMessage.style.display = "block";
        errorMessage.innerText = age + " is restricted to request a record.";
      } else {
        errorMessage.style.display = "none";
      }
    }
  </script>
</head>
<body style="background: #27329b">
<div class="container">
    <div class="card col-lg-12 mx-auto mb-3" style="box-shadow:none;">
        <form action="../sql/auth/resident_register.php" enctype="multipart/form-data" class="row g-2 form-style" method="POST" id="register_form">
            <div class="row">
                <div class="col-2">
                    <div>
                        <a href="user_index.php"><i class="fas fa-arrow-left fa-lg" style="color:#27329b"></i></a>
                    </div>
                </div>
                <div class="col-10">
                <h4 class="text-center">Resident Register</h4> 
                </div>
            </div>
            <div id="error_msg"></div>
            <input type="hidden" name="access" class="form-control" id="floatingInput" style="height:50px;">
            <div class="col-md-12">
                <label>Profile Picture (Limit of 1 MB)</label>
                <input type="file" name="pic" class="form-control"  id="pic" onchange="validateFileSize()" style="height:50px;">
                <div id="fileSizeError" style="color: red;"></div>
                                  
            </div>

            <div class="col-md-4">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" id="fname" style="height:50px;">    
            </div>
            <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" name="mname" class="form-control" id="mname" style="height:50px;">  
            </div>
            <div class="col-md-4">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" id="lname"  style="height:50px;"> 
            </div>
            <div class="col-md-3 form-group">
                <label>Sex</label>
                <select style="padding:13px;" class="form-control form-select" name="gender" id="gender">
                    <option selected disabled> </option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Place of Birth</label>
                <input type="text" name="pob" class="form-control" id="pob">
            </div>
            <div class="col-md-3 form-group">
                <label>Birthdate</label>
                    <input style="padding:13px;" class="form-control form-select" type="date" name="bdate" id="bdate" onchange="calculateAge()">
            </div>
            <div class="col-md-3 form-group">
                <label>Age</label>
                    <input style="padding:13px;" class="form-control" type="number" name="age" id="age" readonly>
                    <p id="error-message" style="display: none; color: red;"></p>
            </div>
            <div class="col-md-4 form-group">
                <label>Status</label>
                <select style="padding:13px;" class="form-control form-select" name="status" id="status">
                    <option selected disabled> </option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Street</label>
                <input type="text" name="street" class="form-control" id="street" style="height:50px;">
            </div>
            <div class="col-md-4 form-group">
                <label>Purok</label>
                <select style="padding:13px;" class="form-control form-select" name="purok" id="purok">
                    <option selected disabled> </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3-A</option>
                    <option value="3">3-B</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6-A</option>
                    <option value="6">6-B</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="email" style="height:50px;" readonly>   
                <span></span>                                   
            </div>
            <div class="col-md-6">
                <label>Contact Number</label>
                <input type="text" name="contact" class="form-control" id="contact"  style="height:50px;">    
                <div id="validationContact" style="color: red;"></div>                          
            </div>
            <div class="col-md-12">
                <label>Add ID or Billing paper with address for Checking if you are trully living in Barangay Matain</label>
                <input type="file" name="validation" class="form-control"  id="validation" style="height:50px;">
                                  
            </div>
            <div class="col-md-6 mb-3 password-container">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="password" oninput="checkPassword()">
                <i class="fas fa-eye" id="eye"></i>
            </div>
            <div class="col-md-6 mb-3 password-container">
                <label>Confirm Password</label>
                <input type="password" name="confirmPass" class="form-control" id="password1" oninput="checkPassword()">
                <i class="fas fa-eye" id="eye1"></i>
            </div>
            <div id="message" style="color: red;"></div>
            <input type="submit" name="submit" id="submit_btn" value="Register" class="btn btn-custom" disabled>
            <script>
                // Disable the submit button initially
                document.getElementById("submit_btn").disabled = true;
            </script>
        </form>
                          

           
                          
</div>
    <!-- Check form if Empty -->
    <script>
        //variable
        const nameInput = document.getElementById('pic');
        const nameInput1 = document.getElementById('fname');
        const nameInput2 = document.getElementById('mname');
        const nameInput3 = document.getElementById('lname');
        const nameInput4 = document.getElementById('gender');
        const nameInput5 = document.getElementById('pob');
        const nameInput6 = document.getElementById('bdate');
        const nameInput15 = document.getElementById('age');
        const nameInput7 = document.getElementById('status');
        const nameInput8 = document.getElementById('street');
        const nameInput9 = document.getElementById('purok');
        const nameInput10 = document.getElementById('email');
        const nameInput11 = document.getElementById('contact');
        const nameInput12 = document.getElementById('validation');
        const nameInput13 = document.getElementById('password');
        const nameInput14 = document.getElementById('password1');

        const submitBtn = document.getElementById('submit_btn');

        nameInput.addEventListener('input', toggleSubmitBtn);
        nameInput1.addEventListener('input', toggleSubmitBtn);
        nameInput2.addEventListener('input', toggleSubmitBtn);
        nameInput3.addEventListener('input', toggleSubmitBtn);
        nameInput4.addEventListener('input', toggleSubmitBtn);
        nameInput5.addEventListener('input', toggleSubmitBtn);
        nameInput6.addEventListener('input', toggleSubmitBtn);
        nameInput7.addEventListener('input', toggleSubmitBtn);
        nameInput8.addEventListener('input', toggleSubmitBtn);
        nameInput9.addEventListener('input', toggleSubmitBtn);
        nameInput10.addEventListener('input', toggleSubmitBtn);
        nameInput11.addEventListener('input', toggleSubmitBtn);
        nameInput12.addEventListener('input', toggleSubmitBtn);
        nameInput13.addEventListener('input', toggleSubmitBtn);
        nameInput14.addEventListener('input', toggleSubmitBtn);
        nameInput15.addEventListener('input', toggleSubmitBtn);

        function toggleSubmitBtn() {
        if (nameInput.value !== '' && nameInput1.value !== '' && nameInput2.value !== '' && nameInput3.value !== '' && nameInput4.value !== '' && nameInput5.value !== '' && nameInput6.value !== '' && nameInput7.value !== '' && nameInput8.value !== '' && nameInput9.value !== '' && nameInput10.value !== '' && nameInput11.value !== '' && nameInput12.value !== '' && nameInput13.value !== '' && nameInput14.value !== '' && nameInput15.value !== '') {
            submitBtn.removeAttribute('disabled');
        } else {
            submitBtn.setAttribute('disabled', '');
        }
        }
    </script>

    <!-- See password -->
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
    // Retrieve the values from the query parameters
        var params = new URLSearchParams(window.location.search);
        var email = params.get('email');
        // var lastName = params.get('lastName');

        // Set the values in the input fields
        document.getElementById('email').value = email;
        // document.getElementById('lastName').value = lastName;
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
    <script>
        function validateFileSize() {
            var fileInput = document.getElementById('pic');
            var file = fileInput.files[0];
            var fileSizeError = document.getElementById('fileSizeError');

            if (file.size > 5 * 1024 * 1024) {
            fileInput.value = ''; // Reset the file input
            fileSizeError.innerText = "Error: File size exceeds the limit of 1 MB.";
            } else {
            fileSizeError.innerText = ""; // Clear the error message if file size is within the limit
            }
        }
    </script>

    <script>
       const numberInput = document.getElementById('contact');
       const submitButton = document.getElementById('submit_btn');
        const validationMessage = document.getElementById('validationContact');

        numberInput.addEventListener('input', function() {
        const inputValue = this.value.trim();

        if (!/^\d{11}$/.test(inputValue)) {
            validationMessage.textContent = 'Please enter exactly 11 digits.';
            numberInput.classList.add('invalid');
            submitButton.disabled = true;
        } else {
            validationMessage.textContent = '';
            numberInput.classList.remove('invalid');
            submitButton.disabled = false;
        }
        });
    </script>

<script>
    function checkPassword() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("password1").value;
        const message = document.getElementById("message");
        const submitButton = document.getElementById("submit_btn");

        if (confirmPassword !== "") {
            if (password === confirmPassword) {
                message.textContent = "Passwords match!";
                submitButton.disabled = false;
            } else {
                message.textContent = "Passwords do not match.";
                submitButton.disabled = true;
            }
        } else {
            message.textContent = "";
            submitButton.disabled = true;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const passwordInputs = document.querySelectorAll("input[type='password']");
        passwordInputs.forEach(function(input) {
            input.addEventListener("input", checkPassword);
        });
    });
</script>
</body>
</html>
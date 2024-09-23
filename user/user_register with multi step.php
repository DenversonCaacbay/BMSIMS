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
        <script>
        function checkPassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password1").value;
        var message = document.getElementById("message");
        var submitButton = document.getElementById("submit_btn");

        if (confirmPassword !== "") {
            if (password === confirmPassword) {
            message.innerHTML = "Passwords match!";
            submitButton.disabled = true;
            } else {
            message.innerHTML = "Passwords do not match.";
            submitButton.disabled = false;
            }
        } else {
            message.innerHTML = "";
            submitButton.disabled = true;
        }
        }
    </script>
</head>
<style>
body {
    background: #fff;
}

#regForm {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 5px 10px rgb(34, 32, 32,0.2),
  0px 5px 10px rgba(0,0,0,0.1);
}

#register{

  color: #27329b;
}

h1 {
    text-align: center
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
    border-radius: 5px;
    -webkit-appearance: none;
}



.tab input:focus{

  border:1px solid #27329b !important;
  outline: none;
}

input.invalid {
 
    border:1px solid #e03a0666;
}

.tab {
    display: none
}

button {
    background-color: #27329b;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
}

button:hover {
    opacity: 0.8
}

button:focus{

  outline: none !important;
}

#prevBtn {
    background-color: #27329b;
}


.all-steps{
      text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
    width: 100%;
    display: inline-flex;
    justify-content: center;
}

.step {
       height: 40px;
    width: 40px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15px;
    color: #6a1b9a;
    opacity: 0.5;
}

.step.active {
    opacity: 1
}


.step.finish {
   color: #fff;
   background: #27329b;
   opacity: 1;

}



.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px
}

.thanks-message {
    display: none
}
</style>
<body>
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form id="regForm">
                <h1 id="register">Registration Form</h1>
                <div class="all-steps" id="all-steps"> 
                  <span class="step"></span> 
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                  <span class="step"></span>
                </div>

                <div class="tab">
                  <h6>Add Profile Picture (5 MB ONLY)</h6>
                    <p>
                      <input type="file" oninput="this.className = ''" name="pic"></p>
                      <h6>First Name</h6>
                    <p>
                      <input placeholder="First Name..." oninput="this.className = ''" name="fname"></p>
                      <h6>Middle Name</h6>
                    <p>
                      <input placeholder="Middle Name..." oninput="this.className = ''" name="mname"></p>
                      <h6>Last Name</h6>
                    <p>
                      <input placeholder="Last Name..." oninput="this.className = ''" name="lname"></p>
                    
                </div>
                <div class="tab">
                    <h6>Sex</h6>
                        <p>
                            <select style="padding:13px;" class="form-control form-select" name="gender" id="gender">
                                <option selected disabled> </option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </p>
                    <h6>Place of Birth</h6>
                    <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p>
                    
                    <div class="row">
                        <div class="col-6">
                            <h6>Birthdate</h6>
                            <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p> 
                        </div>
                        <div class="col-6">
                            <h6>Age</h6>
                            <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p>
                        </div>
                       
                    
                    </div>
                    
                    <h6>Status</h6>
                    <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p>
                    
                </div>
                <div class="tab">
                    <h6>Street</h6>
                    <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p>
                    <h6>Purok</h6>
                    <p>
                        <select style="padding:13px;" class="form-control form-select" name="purok" id="purok">
                            <option selected disabled> </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </p>
                    <h6>Email</h6>
                    <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p>    
                    <h6>Contact</h6>
                    <p><input placeholder="Favourite Shopping site" oninput="this.className = ''" name="email"></p>
                 
                </div>
                <div class="tab">
                    <h6>Add ID or Billing paper with address for Checking if you are trully living in Barangay Matain</h6>
                    <p>
                      <input type="file" oninput="this.className = ''" name="validation"></p>
                </div>

                <div class="tab">
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
                </div>
                <div class="thanks-message text-center" id="text-message"> <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                    <h3>Thankyou for your feedback!</h3> <span>Thanks for your valuable information. It helps us to improve our services!</span>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Prev</button> 
                      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Check form if Empty -->
    <script>
        var currentTab = 0;
              document.addEventListener("DOMContentLoaded", function(event) {


              showTab(currentTab);

              });

              function showTab(n) {
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              if (n == 0) {
              document.getElementById("prevBtn").style.display = "none";
              } else {
              document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
              document.getElementById("nextBtn").innerHTML = 'Next';
              } else {
              document.getElementById("nextBtn").innerHTML = 'Next';
              }
              fixStepIndicator(n)
              }

              function nextPrev(n) {
              var x = document.getElementsByClassName("tab");
              if (n == 1 && !validateForm()) return false;
              x[currentTab].style.display = "none";
              currentTab = currentTab + n;
              if (currentTab >= x.length) {
            
              document.getElementById("nextprevious").style.display = "none";
              document.getElementById("all-steps").style.display = "none";
              document.getElementById("register").style.display = "none";
              document.getElementById("text-message").style.display = "block";




              }
              showTab(currentTab);
              }

              function validateForm() {
                   var x, y, i, valid = true;
                   x = document.getElementsByClassName("tab");
                   y = x[currentTab].getElementsByTagName("input");
                   for (i = 0; i < y.length; i++) {
                       if (y[i].value == "") {
                           y[i].className += " invalid";
                           valid = false;
                       }


                   }
                   if (valid) {
                       document.getElementsByClassName("step")[currentTab].className += " finish";
                   }
                   return valid;
               }

               function fixStepIndicator(n) {
                   var i, x = document.getElementsByClassName("step");
                   for (i = 0; i < x.length; i++) {
                       x[i].className = x[i].className.replace(" active", "");
                   }
                   x[n].className += " active";
               }
    </script>
    <script>
        //variable
        const nameInput = document.getElementById('pic');
        const nameInput1 = document.getElementById('fname');
        const nameInput2 = document.getElementById('mname');
        const nameInput3 = document.getElementById('lname');
        const nameInput4 = document.getElementById('gender');
        const nameInput5 = document.getElementById('pob');
        const nameInput6 = document.getElementById('bdate');
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

        function toggleSubmitBtn() {
        if (nameInput.value !== '' && nameInput1.value !== '' && nameInput2.value !== '' && nameInput3.value !== '' && nameInput4.value !== '' && nameInput5.value !== '' && nameInput6.value !== '' && nameInput7.value !== '' && nameInput8.value !== '' && nameInput9.value !== '' && nameInput10.value !== '' && nameInput11.value !== '' && nameInput12.value !== '' && nameInput13.value !== '' && nameInput14.value !== '') {
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
            fileSizeError.innerText = "Error: File size exceeds the limit of 5MB.";
            } else {
            fileSizeError.innerText = ""; // Clear the error message if file size is within the limit
            }
        }
    </script>

    <script>
       const numberInput = document.getElementById('contact');
        const validationMessage = document.getElementById('validationContact');

        numberInput.addEventListener('input', function() {
        const inputValue = this.value.trim();

        if (!/^\d{11}$/.test(inputValue)) {
            validationMessage.textContent = 'Please enter exactly 11 digits.';
            numberInput.classList.add('invalid');
        } else {
            validationMessage.textContent = '';
            numberInput.classList.remove('invalid');
        }
        });
    </script>
</body>
</html>
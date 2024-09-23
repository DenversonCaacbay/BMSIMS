<?php
session_start(); // Start the session

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // Redirect the user to ad_index.php
  header("Location: user_index.php");
  session_destroy(); // Clear the session
  exit;
}
?>
<?php
    $pdo = require '../sql/config/connection.php';

    $email = '';
    $password = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $response = "Username/Password is empty.";
        } else {
            $sql = "SELECT * FROM resident_accounts WHERE email = :email";
            $statement = $pdo->prepare($sql);
            $statement->execute(array('email' => $email));

            $logins = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();

            $password_result = '';

            foreach ($logins as $login) {
                $password_result = $login['password'];
                $_SESSION['user_id'] = $login['res_id'];
                $_SESSION['fname'] = $login['fname'];
                $_SESSION['mname'] = $login['mname'];
                $_SESSION['lname'] = $login['lname'];
                $_SESSION['email'] = $login['email'];
                $_SESSION['access'] = $login['access'];
            }

            if ($count > 0) {
              if (password_verify($password, $password_result)) {
                  if ($_SESSION['access'] == 'Not Yet Approve') {
                    $response = "Not Yet Approve";
                  } else if ($_SESSION['access'] == 'Banned') {
                    $response = "Banned";
                  } else if ($_SESSION['access'] == 'Approved') {
                      $_SESSION['loggedin'] = true;
                      $response = "success"; // Set response to 'success' for successful login
                  } else {
                      $_SESSION['loggedin'] = true;
                      $response = "success"; // Set response to 'success' for successful login
                  }
              } else {
                  $response = "Wrong username or password.";
              }
          } else {
              $response = "No user found with that email.";
          }
          
          // Send the response back to the client as JSON
          echo json_encode(array('response' => $response));
          exit();
        }
    }
?>

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
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
    <link rel="manifest" href="manifest.json">
    <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('service-worker.js')
        .then(function(registration) {
            console.log('Service Worker registered with scope:', registration.scope);
        }).catch(function(error) {
            console.log('Service Worker registration failed:', error);
        });
    }
    </script>
<style>
  #response {
    opacity: 1;
    transition: opacity 3s;
    text-align:center;
    background:#fff;
    color:#dc3545;
    padding:10px;
    
  }
  
  .hide {
    display:none;
  }
</style>
<script>
  function handleLogin(event) {
    event.preventDefault(); // Prevent the default form submission

    // Obtain the login form data
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

    // Perform the login request
    fetch('user_index.php', {
      method: 'POST',
      body: formData
    })
      .then(response => {
        if (response.ok) {
          return response.json(); // Parse the response as JSON
        } else {
          throw new Error('Network response was not ok.');
        }
      })
      .then(data => {
        if (data.response === 'success') {
          // Successful login, redirect to request.php
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Login Successfully',
            showConfirmButton: false,
            timer: 2000
          }).then(() => {
            window.location.href = 'request.php';
          });
        } else if (data.response === 'Not Yet Approve') {
          // Account not yet approved, show the response in the form
          var responseElement = document.getElementById('response');
          if (responseElement) {
            responseElement.textContent = 'Account not yet approved. Please check your email.';
            responseElement.classList.remove('hide'); // Make sure it's visible before hiding
            setTimeout(function() {
              responseElement.classList.add('hide');
            }, 3000); // Hide the response after 3 seconds
          }
        } else if (data.response === 'Banned') {
          // Account is banned, show the response in the form
          var responseElement = document.getElementById('response');
          if (responseElement) {
            responseElement.textContent = 'Your account has been banned.';
            responseElement.classList.remove('hide'); // Make sure it's visible before hiding
            setTimeout(function() {
              responseElement.classList.add('hide');
            }, 3000); // Hide the response after 3 seconds
          }
        } else {
          // Other error response
          var contentElement = document.getElementById('response');
          if (contentElement) {
            contentElement.innerHTML = data.response;
            contentElement.classList.remove('hide'); // Make sure it's visible before hiding
            setTimeout(function() {
              contentElement.classList.add('hide');
            }, 3000); // Hide the response after 3 seconds
          }
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
</script>
</head>
<body>

<div class="modal fade mt-5" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <img class="loginimage1 d-block m-auto" src="../images/barangaylogo.png">
                <br>
                <h3 class="">Welcome Resident</h3>

            </div>
            <div class="col-lg-12">
                    <div class="card card3 col-lg-12 d-block m-auto">
                        <!-- <form action="../sql/auth/resident_login.php" class="signin" method="POST"> -->
                        <form  class="signin" id="loginForm" onsubmit="handleLogin(event)">
                            <div class="mb-3">
                                <h3 class="mb-3">Login</h3>
                                <div id="response" class="hide"></div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" id="floatingInput" required>
                                    
                                </div>
                               
                                <div class="mb-3 password-container">
                                    <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                        <i class="fas fa-eye" id="eye"></i>
                                </div>

                                <input type="submit" name="submit"  id="btnSubmit" value="Login" class="btn btn-custom">
                                <a href="email_check.php" class="btn btn-custom">Register</a>
                                <h5 class="mt-3" style="text-align:center;font-size:18px;"><a style="text-decoration:none;cursor:pointer;" href="#" data-toggle="modal" data-target="#forgotModal">Forgot Password?</a></h5>
                                <h5 class="mt-3" style="text-align:center;font-size:18px;">BMSIMS v1.0</h5>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <!-- <button id="installButton" class="btn btn-custom" style="float:right;width:auto;isplay: none;margin-right:10px;">
        <i class="fas fa-download"></i> Install
    </button> -->
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
    <script>
      // Add a class to the element after a delay to trigger the animation
     // Show the response when there is a response
      function showResponse() {
        var responseDiv = document.getElementById('response');
        responseDiv.classList.remove('hide');
      }

      // Simulate receiving a response after a delay
      setTimeout(function() {
        showResponse();
      }, 3000);
    </script>
    

<!-- <script>
let deferredPrompt;

// Listen for the beforeinstallprompt event
window.addEventListener('beforeinstallprompt', (event) => {
  event.preventDefault();
  deferredPrompt = event;

  // Check if the PWA is already installed or running in standalone mode
  if (isPwaInstalled() || isRunningInStandaloneMode()) {
    hideInstallButton();
  } else {
    showInstallButton();
  }
});

// Function to check if the PWA is already installed
function isPwaInstalled() {
  return window.matchMedia('(display-mode: standalone)').matches ||
    window.navigator.standalone;
}

// Function to check if the PWA is running in standalone mode (iOS)
function isRunningInStandaloneMode() {
  return window.navigator.standalone;
}

// Function to show the install button
function showInstallButton() {
  const installButton = document.getElementById('installButton');
  installButton.style.display = 'block';
}

// Function to hide the install button
function hideInstallButton() {
  const installButton = document.getElementById('installButton');
  installButton.style.display = 'none';
}

// Show the install button when the event is supported
if ('onbeforeinstallprompt' in window) {
  showInstallButton();
}

// Add a click event listener to the install button
const installButton = document.getElementById('installButton');
installButton.addEventListener('click', () => {
  if (deferredPrompt) {
    deferredPrompt.prompt();

    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('PWA installation accepted');
      } else {
        console.log('PWA installation dismissed');
      }
      deferredPrompt = null;
    });
  }
});
  </script> -->

</body>
</html>
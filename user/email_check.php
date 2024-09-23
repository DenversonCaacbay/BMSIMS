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
<style>
  /* Modal Styles */
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    /* CSS animation */
    @keyframes fadeOut {
      0% { opacity: 1; }
      100% { opacity: 0; }
    }

    /* CSS styling */
    #response {
      animation: fadeOut 2s ease-in-out forwards;
    }
    
  </style>
<body style="background: #27329b">
<div class="container container-checker">
    <div class="card col-lg-12 mx-auto mb-3" style="box-shadow:none;">
        <form action="../sql/auth/checker.php" enctype="multipart/form-data" method="POST" id="check_form">
            <div>
                <a href="user_index.php"><i class="fas fa-arrow-left fa-lg" style="color:#27329b"></i></a>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">Check Email</h4> 
                    <?php
                        // Display the response from checker.php, if any
                        if (isset($_GET['response'])) {
                            echo "<p id='response' class='error-message'>" . $_GET['response'] . "</p>";
                        }
                    ?>
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>

                    <div class="mt-2">
                      <label for="myCheckbox">Click Here to Read <a href="../general_policy.html" target="_blank">BMSIMS General Privacy Policy</a></label>
                      <input type="checkbox" id="myCheckbox">
                    </div>
                    
                    <input type="submit" id="submitButton" class="btn btn-custom" value="Check" disabled>
                    <!-- <button onclick="submitForm()">Submit</button> -->

                    
                </div>
            </div>    
        </form>     
    </div>  
</div>

<!--End of Modal Add-->
<!-- <script>
    // Function to hide the response message after 5 seconds
    function hideResponse() {
      var responseElement = document.getElementById("response");
      responseElement.style.display = "none";
    }

    // Call the hideResponse function after 5 seconds
    setTimeout(hideResponse, 5000);
  </script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script>
    // Function to remove the response element after animation completes
    function removeResponse() {
      var responseElement = document.getElementById("response");
      responseElement.parentNode.removeChild(responseElement);
    }

    // Call the removeResponse function after 1.5 seconds (animation duration + a small delay)
    setTimeout(removeResponse, 1500);
  </script>

<script>
    const checkbox = document.getElementById('myCheckbox');
    const submitButton = document.getElementById('submitButton');

    checkbox.addEventListener('change', function() {
      submitButton.disabled = !checkbox.checked;
    });
  </script>

<script>
    // Get the modal and link elements
    const modal = document.getElementById('myModal');
    const link = document.getElementById('privacyLink');
    const closeBtn = document.querySelector('.close');

    // Open the modal when the link is clicked
    link.addEventListener('click', function(event) {
      event.preventDefault();
      modal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeBtn.addEventListener('click', function() {
      modal.style.display = 'none';
    });

    // Close the modal when the user clicks outside the modal content
    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>

<!-- <script>
    function submitForm() {
      var email = document.getElementById('email').value;

      // Construct the URL with query parameters
    }
  </script> -->

  <!-- <script>
    // No need for the submitForm() function

    // Retrieve the form element
    var form = document.getElementById('myForm');

    // Add a submit event listener to the form
    form.addEventListener('submit', function(event) {
      // Prevent the default form submission
      event.preventDefault();

      // Redirect to another.html with the form data as query parameters
      var url = 'another.html?' + new URLSearchParams(new FormData(form)).toString();
      window.location.href = url;
    });
  </script> -->

</body>
</html>
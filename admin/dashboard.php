<?php
require '../sql/auth/account_check2.php';
// require '../sql/auth/account_user_check.php'; 
// session_start(); // Start the session

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     // Redirect the user to user_index.php
//     header("Location: ../ad_index.php");
//     exit;
// }   
                     
?>
<?php
// require '../sql/auth/account_staff_check.php';

// Database connection details
$servername = "localhost";
$username = "u622464203_bmsims";
$password = "Bmsims2023";
$dbname = "u622464203_bmsims";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT request_type, amount FROM tbl_invoice";
$result = $conn->query($sql);

// Prepare data for the pie chart
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'request_type' => $row['request_type'],
        'amount' => $row['amount']
    );
}

// Close the database connection
$conn->close();
?>

<?php
$servername = "localhost";
$username = "u622464203_bmsims";
$password = "Bmsims2023";
$dbname = "u622464203_bmsims";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch data from tbl_invoice
$sql = "SELECT request_type, payment_method, amount FROM tbl_invoice";
$result = $conn->query($sql);

// Create an empty array to store the data
$data = array();

// Iterate through the result and store the data
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
// Create an empty array to store the total amounts
$totalAmounts = array();

// Calculate the total amounts for each request type
foreach ($data as $row) {
    $requestType = $row['request_type'];
    $amount = $row['amount'];

    if (!isset($totalAmounts[$requestType])) {
        $totalAmounts[$requestType] = 0;
    }

    $totalAmounts[$requestType] += $amount;
}

// For Pie Chart
$totalAmountsMethod = array();

// Calculate the total amounts for each payment method
foreach ($data as $row) {
    $paymentMethod = $row['payment_method'];
    $amount = $row['amount'];

    if (!isset($totalAmountsMethod[$paymentMethod])) {
        $totalAmountsMethod[$paymentMethod] = 0;
    }

    $totalAmountsMethod[$paymentMethod] += $amount;
}


?>

<?php
$host = 'localhost';
$db = 'u622464203_bmsims';
$user = 'u622464203_bmsims';
$pass = 'Bmsims2023';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to database successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<?php
    $query = "SELECT * FROM tbl_request WHERE request_status = 'Pending'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="../images/loginimage.png">
    <title>BMSIMS | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"/>
      <link rel="stylesheet" href="../bootstrap/css/staff_style.css">
      <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
      <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> -->
</head>
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
  <p class="text-light font-weight-bold">Menu</p>
  <li class="nav-item">
      <a href="dashboard.php" class="nav-link hover-dark text-light">
      <i class="fas fa-home mr-3 text-light fa-fw" style="font-size:20px"></i>
               Dashboard
            </a>
    </li>
    <hr class="text-light">
  <p class="text-light font-weight-bold">Account Manager</p>
    <li class="nav-item">
      <a href="staff_accounts.php" class="nav-link text-light">
      <i class="fas fa-user  mr-3 text-light fa-fw" style="font-size:20px"></i>
                Staff Account
            </a>
    </li>
    <li class="nav-item">
      <a href="barangayofficial.php" class="nav-link text-light">
      <i class="fas fa-user  mr-3 text-light fa-fw" style="font-size:20px"></i>
                Barangay Official
            </a>
    </li>
    <li class="nav-item">
      <a href="pending_accounts.php" class="nav-link text-light">
      <i class="fas fa-user  mr-3 text-light fa-fw" style="font-size:20px"></i>
                Residents Account
            </a>
    </li>
    <li class="nav-item">
      <a href="manageprogram.php" class="nav-link text-light">
      <i class="fas fa-calendar mr-3 text-light fa-fw" style="font-size:20px"></i>
                Manage Programs
            </a>
    </li>
    <hr class="text-light">
    <p class="text-light font-weight-bold">History</p>
    <li class="nav-item">
      <a href="payment_history.php" class="nav-link text-light">
      <i class="fas fa-file-invoice-dollar mr-3 text-light fa-fw" style="font-size:20px"></i>
                Payment History
            </a>
    </li>
    <!-- <li class="nav-item">
      <a href="logs.php" class="nav-link text-light">
      <i class="fas fa-history mr-3 text-light fa-fw"></i>
                Logs
            </a>
    </li> -->



    <!---->

    <li class="nav-item p-5">
      <a href="../sql/auth/account_logout.php" class="nav-link nav-link1 text-center text-light">
      <!-- <i class="fas fa-sign-out-alt text-light fa-fw" style="font-size:30px;"></i> -->
      <img width="30" height="30" src="../images/icons/logout_button_white.png" alt="logout-rounded-left"/>
            </a>
    </li>
  </ul>



</div>
<!-- End vertical navbar -->

<!-- Page content holder -->
<div class="page-content p-0" id="content">
  <!-- Toggle button -->
  <div class="row nav1 mb-1">

    <div class="col-8">
        <!-- <button id="sidebarCollapse" type="button" class="btn btn-menu shadow-sm"><i class="fa fa-bars"></i></button> -->
    </div>
    <div class="col-4 mt-2 align-items-right">
        <div class="d-flex top-header ">
            <img loading="lazy" src="../images/profile.png" alt="..." width="30" height="30">
            <div class="media-body">
                <a class="user-style"  href="#"><?php echo $_SESSION['fullname'] ?></a>
                
            </div>
        </div>
    </div>
    
  </div>
  
  <?php 
    $pdo = require '../sql/config/connection.php';
    $totalQty = 0;

    $showQty = "SELECT * FROM tbl_officials";
    $statement = $pdo->query($showQty);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
  <!-- Demo content -->
<div class="separator"></div>
  <div class="header">
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-sm-12" style="font-size:2rem">Dashboard <i class="fas fa-home mr-3 fa-fw"></i></div>
        </div>
      </div>
      <hr class="mt-2" style="margin:10px">
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="container">
          <div class="row g-4 align-items-start">
            <div class="col-md-3">
                <div class="card card-dash">
                  <div class="col-sm-12">
                    <div class="card-header"><h5>All Pending Request</h5></div>
                      <div class="card-body">
                        <?php 
                          $showProducts = "SELECT * FROM tbl_request WHERE request_status='Pending'";
                          $statement = $pdo->query($showProducts);
                          $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                          $all = $statement->rowCount();
                          echo "<h5 class='mb-2'>".$all."</h5>";
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card card-dash">
                    <div class="col-sm-12">
                      <div class="card-header"><h5>Total Released Request</h5></div>
                        <div class="card-body">
                          <?php 
                            $showProducts = "SELECT * FROM tbl_invoice WHERE request_status='Get Record'";
                            $statement = $pdo->query($showProducts);
                            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                            $all = $statement->rowCount();
                            echo "<h5 class='mb-2'>".$all."</h5>";
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
              <div class="col-md-3">
                <div class="card card-dash">
                  <div class="col-sm-12">
                    <div class="card-header"><h5>Total Resident</h5></div>
                    <div class="card-body">
                      <?php 
                        $showProducts = "SELECT * FROM resident_accounts WHERE access='Approved'";
                        $statement = $pdo->query($showProducts);
                        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $all = $statement->rowCount();
                        echo "<h5 class='mb-2'>".$all."</h5>";
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card card-dash ">
                  <div class="col-sm-12">
                    <div class="card-header"><h5>Total Earnings</h5></div>
                    <div class="card-body">
                      <?php 
                         $totalSales = 0;
                        $showProducts = "SELECT * FROM tbl_invoice";
                        $statement = $pdo->query($showProducts);
                        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $all = $statement->rowCount();
                        foreach($products as $invoice){
                        $totalSales = $totalSales + $invoice['amount'];
                        }
                        echo "<h5 class='mb-2'>₱".number_format($totalSales).".00"."</h5>";
                      ?>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="header">
            <div class="card-body">
                <hr class="mt-0" style="margin:10px">
            </div>
        </div>
        <div class="container mt-0">
          <div class="row">
            <div class="col-8">
              <div class="card p-2" style="height:460px">
              <h5>Total Income Per Record</h5>
              <canvas id="wholeTotal"></canvas>
                <!-- <canvas id="barChart"></canvas> -->
              </div>
            </div>
            <div class="col-4">
              <div class="card center p-2" style="height:460px;width:400px">
              <h5>Total Income Per Payment Method</h5>
              <canvas id="methodTotal"></canvas>
                <!-- <canvas id="myChart"></canvas> -->
              </div>
            </div>
          </div>
          
          
            
            
                        
        </div>

        <!-- <canvas id="wholeTotal"></canvas>
        <canvas id="methodTotal"></canvas> -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>

<!-- <canvas id="wholeTotal"></canvas> -->

<script>
    // Get the total amounts data
    var totalAmounts = <?php echo json_encode(array_values($totalAmounts)); ?>;
    var requestTypes = <?php echo json_encode(array_keys($totalAmounts)); ?>;

    // Create the chart
    var ctx = document.getElementById('wholeTotal').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: requestTypes,
            datasets: [{
                label: 'Total Amount Per Record',
                data: totalAmounts,
                backgroundColor: 'rgba(68, 96, 216, 1)',
                borderColor: 'rgba(39, 50, 155, 1)',
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


        <script>
    // Get the total amounts data
    var totalAmounts = <?php echo json_encode(array_values($totalAmounts)); ?>;
    var requestTypes = <?php echo json_encode(array_keys($totalAmounts)); ?>;

    // Create the chart
    var ctx = document.getElementById('wholeTotal').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: requestTypes,
            datasets: [{
                label: 'Total Amount Per Record',
                data: totalAmounts,
                backgroundColor: 'rgba(68, 96, 216, 1)',
                borderColor: 'rgba(39, 50, 155, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 4,
                    color: 'black',
                    font: {
                        weight: 'bold'
                    }
                }
            }
        }
    });
</script>
</body>
</html>


<!-- pie chart -->
<!-- <script>
        // Get the total amounts data
        var totalAmountsMethod = <?php echo json_encode(array_values($totalAmountsMethod)); ?>;
        var paymentMethods = <?php echo json_encode(array_keys($totalAmountsMethod)); ?>;

        // Create the chart
        var ctx = document.getElementById('methodTotal').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: paymentMethods,
                datasets: [{
                    label: 'Total Amount',
                    data: totalAmountsMethod,
                    backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(68, 96, 216, 1)', 'rgba(75, 192, 192, 0.5)'],
                    borderColor: ['rgba(39, 50, 155, 1)', 'rgba(39, 50, 155, 1)', 'rgba(39, 50, 155, 1)'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
            }
        });
    </script> -->
    <script>
    // Get the total amounts data
    var totalAmountsMethod = <?php echo json_encode(array_values($totalAmountsMethod)); ?>;
    var paymentMethods = <?php echo json_encode(array_keys($totalAmountsMethod)); ?>;

    // Create the chart
    var ctx = document.getElementById('methodTotal').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: paymentMethods,
            datasets: [{
                label: 'Total Amount',
                data: totalAmountsMethod,
                backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(68, 96, 216, 1)', 'rgba(75, 192, 192, 0.5)'],
                borderColor: ['rgba(39, 50, 155, 1)', 'rgba(39, 50, 155, 1)', 'rgba(39, 50, 155, 1)'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    generateLabels: function (chart) {
                        var data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function (label, i) {
                                var dataset = data.datasets[0];
                                var percentage = ((dataset.data[i] / dataset._meta[0].total) * 100).toFixed(2) + '%';
                                return {
                                    text: label + ' - ' + percentage,
                                    fillStyle: dataset.backgroundColor[i],
                                    strokeStyle: dataset.borderColor[i],
                                    lineWidth: dataset.borderWidth
                                };
                            });
                        }
                        return [];
                    }
                }
            }
        }
    });

    // Add percentages to legend manually
    var legendItems = myChart.legend.legendItems;
    for (var i = 0; i < legendItems.length; i++) {
        var legendItem = legendItems[i];
        legendItem.text += ' - ' + ((myChart.data.datasets[0].data[i] / myChart.data.datasets[0]._meta[0].total) * 100).toFixed(2) + '%';
    }
    myChart.legend.update();
</script>


<!-- End demo content -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="../bootstrap/js/main.js"></script>
<!-- <script language="JavaScript">

      
      window.onload = function () {
          document.addEventListener("contextmenu", function (e) {
              e.preventDefault();
          }, false);
          document.addEventListener("keydown", function (e) {
              //document.onkeydown = function(e) {
              // "I" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                  disabledEvent(e);
              }
              // "J" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                  disabledEvent(e);
              }
              // "S" key + macOS
              if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                  disabledEvent(e);
              }
              // "U" key
              if (e.ctrlKey && e.keyCode == 85) {
                  disabledEvent(e);
              }
              // "F12" key
              if (event.keyCode == 123) {
                  disabledEvent(e);
              }
          }, false);
          function disabledEvent(e) {
              if (e.stopPropagation) {
                  e.stopPropagation();
              } else if (window.event) {
                  window.event.cancelBubble = true;
              }
              e.preventDefault();
              return false;
          }
      }
//edit: removed ";" from last "}" because of javascript error
</script> -->
</body>
</html>

<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../sql/fetch/info/fetch_dashboard.php",
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
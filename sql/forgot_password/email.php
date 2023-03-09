<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Request</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "style.css">
    <scrip src="../../bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background: #27329b">
  <div class="container hero">
    <div class="card">
      <div class="row">
        <div class="col-12" style="text-align:center;">
            <img src="BarangayLogo.jpg" style="height:200px;width:200px;">
        </div>
        <div class="col-12 mt-4">
          <form action="send.php" method="POST" >
            <div class="col">
              <label>Barangay Email</label>
              <input type="email" name="email" class="form-control" value=""><br>
            </div>
            <div class="col-12">
              <label>Full Name (LN, FN MI): [Firstname, Middle initial, Lastname]</label>
              <input type="text" name="subject" class="form-control" value=""><br>
            </div>
            <div class="col-12">
              <label>State Your Reason</label>
              <input type="text" name="message" class="form-control" value=""><br>
            </div>
            
            <button type="submit" class="btn" name="send">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>



</body>
</html>
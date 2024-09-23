<?php

$imagePath = '../images/profile.png';
$imagePath1 = '../images/BarangayLogo.png';
$imagePath2 = '../images/dilg.png';

// Read the image data
$imageData = file_get_contents($imagePath);
$imageData1 = file_get_contents($imagePath1);
$imageData2 = file_get_contents($imagePath2);

$imageBase64_1 = base64_encode($imageData);
$imageBase64_2 = base64_encode($imageData1);
$imageBase64_3 = base64_encode($imageData2);
$today = date('Y-m-d');
//print_invoice.php
if(isset($_GET["pdf"]) && isset($_GET["id"]))
{
 require_once 'pdf.php';
 include('database_connection.php');
 $output = '';
 $statement = $connect->prepare("
  SELECT * FROM tbl_request  WHERE req_id = :req_id
  LIMIT 1
 ");
 $statement->execute(
  array(
   ':req_id'       =>  $_GET["id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '
  <!doctype html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <title>Print Indigency</title>
  
  <style type="text/css">
    * {
      font-family: "Times New Roman", Times, serif;
    }
    .page-border{
      border:0px #000 solid;
    }
    table{
        font-size: 14px;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: 18px;
    }
    .gray {
        background-color: #27329b
    }
    .container{
      padding:5px;
    }
    .col-4{
      border-radius: 5px;
      width:15%;
      float:left;
    }
    .col-12{
      width:100%;
      
    }
    .col-8{
      width:80%;
      float:right;
    }
    .card{
      height:50px;
      background:blue;
      margin-top:0;
    }
    .logo {
      width: 100px;
    }
    .line{
      width: 90%;
      height:10px;
      color: #000;
    }
  </style>
  </head>';
// $admin_details = $connect->query("SELECT * FROM account LIMIT 1")->fetch();
$output .= '
<body class="page-border">
  <div class="col-4">
    <div style="height:90%;position: absolute; top: 90%;transform: rotate(-90deg); transform-origin: left center;">
      <p style="font-size: 50px;letter-spacing: 13px;"><u>BARANGAY MATAIN</u></p>
    </div>

  </div>
  <div class="col-8">
    <table class="header" width="100%">
      <tr>
        <td style="text-align:center"><div style="height:50px;width:70px;background:transparent;"></div></td>
          <td align="center">
              <h5 class="header-text">Republic of the Philippines</h5>
              <h5 class="header-text">Province of Zambales</h5>
              <h5 class="header-text">Municipality of Subic</h5>
              <h3 class="header-text">BARANGAY MATAIN</h3>
              <h3 class="header-text">OFFICE OF THE PUNONG BARANGAY</h3>
          </td>
          
          <td style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64_2 . '" alt="Image" width="50"/></td>
      </tr>

    </table>
    <h3 style="text-align:right;font-size:15px;">'.date("F d, Y", strtotime($today)).'</h3>
 
 
 ';
  
 }
 //get all order items
 $statement = $connect->prepare(
    "SELECT tbl_request.*, resident_accounts.age, resident_accounts.street
    FROM tbl_request
    JOIN resident_accounts ON tbl_request.email = resident_accounts.email
    WHERE tbl_request.req_id = :req_id;"
   );


//FETCH TBL OFFICIALS
$stmt = $connect->prepare("SELECT * FROM tbl_officials;");
$stmt->execute();
$officials = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output .= '
<div class="container">
  <div class="row">';            

  $statement->execute
  (
    array(
     ':req_id'       =>  $_GET["id"]
    )
  );

  $item_result = $statement->fetchAll();
  $count = 0;
  foreach($item_result as $sub_row)
  {
    $count++;
    $output .= '
        <div class="col-12">
        <br>
        <h3 style="text-align:center;font-size:20px;">BARANGAY BUSINESS CLEARANCE</h3>
        <br>
        <h5 style="font-size:20px;text-align:center">Is hereby granted <br>TO:<br><b style="font-size:30px;">'.$sub_row["fullname"].'</b><br>the owner representative</h5>
          <table>
            <tr>
              <td style="font-size:14px;">This Operating business of Sari-Sari Store located at Matain, Subic, Zambales, Within the jurisdiction of <b>Barangay Matain, Subic, Zambales under the business name:</b></td>
            </tr>
            <br>
            <tr>
            <td style="font-size:30px;text-align:center">``<b>'.$sub_row["date_open"].'</b>``</td>
            </tr>
            <tr>
              <td style="font-size:14px;text-indent: 50px;">Above business establishment have complied with the operation rules and regulations of the Sangguniang Barangay,Hereby Granted this Barangay Clearance. Which will expire on/or sooner upon revocation for violation of law and good cause, Should puclic interest welfare and or demand.</td>
            </tr>
            <br>
            <tr>
              <td style="font-size:18px;">REQUIREMENT: This clearance must be posted conspiciously within the business establishment.</td>
            </tr>
          </table>
  
          <div style="margin-top:20%;float:right;">
            <h5>_____________<br>Hon. Mario G. Balboa<br>Punong Barangay</h5>
          </div>

          <div style="margin-top:30%;float:left;margin-left:10%;">
            <h5 style="color:red;text-align:center;margin-top:50px;"><i>Note: NOT VALID without the official seal of Barangay Matain.</i></h5>
          </div>
        

       
        
        </div>
      </div>
    </div>
    </div>
   </body> ';
   }
   
 $pdf = new Pdf();
// $dompdf->loadHtml(html_entity_decode($html));
//landscape orientation
 $file_name = 'Invoice-'.$row["req_id"].'.pdf';
 $pdf->loadHtml($output);
 $pdf->setPaper('A4', 'portrait');
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>

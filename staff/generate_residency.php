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
      padding-left:5px;
      border: 1px #000 solid;
      border-radius: 5px;
      width:40%;
      float:left;
    }
    .col-12{
      width:100%;
      
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
  <table class="header" width="100%">
    <tr>
      <td style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64_2 . '" alt="Image" width="50"/></td>
        <td align="center">
            <h5 class="header-text">Republic of the Philippines</h5>
            <h5 class="header-text">Province of Zambales</h5>
            <h5 class="header-text">Municipality of Subic</h5>
            <h3 class="header-text">BARANGAY MATAIN</h3>
            <h3 class="header-text">OFFICE OF THE PUNONG BARANGAY</h3>
        </td>
        <td style="text-align:center"><div style="height:50px;width:70px;background:transparent;"></div></td>
    </tr>

  </table>
  <h3 style="color:#32CD32;text-align:center;font-size:15px; word-spacing: 20px;">BARANGAY MATAIN BARANGAY MATAIN BARANGAY MATAIN BARANGAY</h3>
  <hr style="text-align:center;margin:5px;height:2px;">
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
        <h3 style="text-align:center;font-size:20px;">CERTIFICATE OF INDIGENCY</h3>
        <br>
        <br>
        <h5 style="font-size:20px;">To Whom It May Concern:</h5>
          <table>
            <tr>
              <td style="font-size:18px;text-indent: 50px;">This is to certify that <b>'.$sub_row["fullname"].'</b> , <b>'.$sub_row["age"].'</b> years of age,with residence and postal address at <b>'.$sub_row["street"].'</b> Matain, Subic, Zambales, is personally known  to be a bonifide resident of Barangay Matain. He/She stays here since birth up present.</td>
            </tr>
            <br>
            <tr>
              <td style="font-size:18px;text-indent: 50px;">This certification is being issued upon the request of the subject person for whatever legal purposes it may serve.</td>
            </tr>
            <br>
            <tr>
              <td style="font-size:18px;text-indent: 50px;">Given this <b> '.date("F d, Y", strtotime($today)).' </b>  at Barangay Hall of Matain, Subic, Zambales.</td>
            </tr>
          </table>
  
          <div style="margin-top:20%;float:right;">
            <h5>_____________<br>Hon. Mario G. Balboa<br>Punong Barangay</h5>
          </div>

          <div style="margin-top:30%;float:right;">
            <h5 style="color:red;text-align:center;margin-top:50px;"><i>Note: NOT VALID without the official seal of Barangay Matain.</i></h5>
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

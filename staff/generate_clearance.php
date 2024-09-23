<?php

$imagePath = '../images/profile.png';
$imagePath1 = '../images/barangaylogo.png';
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
  <title>Print Clearance</title>
  
  <style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    .page-border{
      border:1px #000 solid;
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
    .col-8{
      width:55%;
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
  <table class="header" width="100%">
    <tr>
      <td style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64_2 . '" alt="Image" width="50"/></td>
        <td align="center">
            <h5 class="header-text">Republic of the Philippines</h5>
            <h5 class="header-text">Municipality of Subic</h5>
            <h3 class="header-text">BARANGAY MATAIN</h3>
            <h3 class="header-text">OFFICE OF THE PUNONG BARANGAY</h3>
            <h3 class="header-text">BARANGAY CLEARANCE</h3>
        </td>
      <td style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64_3 . '" alt="Image" /></td>
    </tr>

  </table>
  <hr style="text-align:center;margin:5px;height:5px;">
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
  <div class="row">
    <div class="col-4">
      <h5 style="text-align:center">SANGUNIANG BARANGAY OFFICIALS</h5>
      <table>';
        foreach ($officials as $official)
        {
          $position = explode(' ', $official['position']);
          $firstTwoWords = implode(' ', array_slice($position, 0, 2));
          $output .= '
          <tr>
            
            <td style="height:60px;"><u>'  . $official['firstname'] .' '. $official['middlename'] .' '. $official['lastname'] .'</u><br>' . $firstTwoWords .  '<br><br></td>
          </tr>
            ';
        }
        $output .= '
      </table>
    </div>';            

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
        <div class="col-8">
        <h3>TO WHOM IT MAY CONCERN</h3>
        <h5>This certifies that:</h5>
          <table>
            <tr>
              <td><b>Name:</b> '.$sub_row["fullname"].'</td>
            </tr>
            <tr>
              <td><b>Age:</b> '.$sub_row["age"].'</td>
            </tr>
            <tr>
              <td><b>Address:</b> '.$sub_row["street"].' Matain, Subic, Zambales</td>
            </tr>
            <tr>
              <td><b>Purpose:</b> '.$sub_row["purpose"].'</td>
            </tr>
          </table>
        <h5>This Barangay Clearance is issued as per record kept in this office and upon request of the subject person for the above mentioned purpose.</h5>  
        <h5 style="margin-top:70px;margin-left:70%">_________<br> Signature</br></h5>
        <h5 style="margin-top:20px">Approved By:</h5>
        <h5>_____________<br>Hon. Mario G. Balboa<br>Punong Barangay</h5>

        <table style="margin-top:100px;">
          <tr>
            <td>Date issue: '.date("F d, Y", strtotime($today)).'</td>
            
          </tr>
          <tr>
            <td>Place issue: BARANGAY MATAIN, SUBIC, ZAMBALES</td>
          </tr>
        </table>
        <h5 style="margin-top:50px;"><i>Note: NOT VALID without the official seal of Barangay Matain. 90 Days Valid only from the date issued.</i></h5>
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

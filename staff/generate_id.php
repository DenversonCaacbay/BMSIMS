<?php
$imagePath = '../images/BarangayLogo.png';
// Read the image data
$imageData = file_get_contents($imagePath);
$imageBase64 = base64_encode($imageData);
$today = date('Y-m-d');

$today_1 = new DateTime();

$today_1->modify('+10 months');

// Format the modified date as desired
$modifiedDate = $today_1->format('Y-m-d');
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
  <title>Print ID</title>
  
  <style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    .container{
      
    }
    .col-4{
      padding-left:5px;
      border: 1px #000 solid;
      height:400px;
      width:60%;
      float:left;
    }
    .left{
      border: 1px #000 solid;
      width:49%;
      float:left;
    }
    .right{
      float:right;
      display-block:none;
      border: 1px #000 solid;
      width:49.5%;
    }
    
  </style>
  </head>';
// $admin_details = $connect->query("SELECT * FROM account LIMIT 1")->fetch();
$output .= '
<body>

 ';
  
 }
 //get all order items
 $statement = $connect->prepare(
    "SELECT tbl_request.*, resident_accounts.age, resident_accounts.street, resident_accounts.bdate
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
      <div class="left">
        <table class="header" width="100%">
          <tr>
          <td>
            <td style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image" width="30"/></td>
          </td>
              <td align="center">
                  <h5 class="header-text">Republic of the Philippines<br>Municipality of Subic<br>BARANGAY MATAIN<br>BARANGAY CLEARANCE</h5>
              </td>
              <td>
              <td style="text-align:center"><img class="logo" src="data:image/jpeg;base64,' . $imageBase64 . '" alt="Image" width="30"/></td>
            </td>
          </tr>
        </table>    
      

     ';
        $output .= '
        
    ';            

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
          <div style="margin-top:130px;padding:3px;">
            <table width="100%">
              <tr>
                <td><b>Name:</b> '.$sub_row["fullname"].'</td>
              </tr>
              <tr>
                <td><b>Age:</b> '.date("F d, Y", strtotime($sub_row["req_date"])).'</td>
              </tr>
              <tr>
                <td><b>Address:</b> Matain,Subic, Zambales</td>
              </tr>
              <tr>
                <td style="font-size:14px;padding-top:30px;text-align:center"><u>MARIO G. BALBOA</u></td>
              </tr>
              <tr>
                <td style="font-size:14px;text-align:center">BARANGAY CAPTAIN</td>
              </tr>
            </table>  
          </div>
        </div>
      <div class="right">
        <table>
          <tr>
            <td style="font-size:20px;text-align:center"><h5>In Case of Emergency</h5></td>
          </tr>
          <tr>
            <td>Notify: '.$sub_row["notify"].'</td>
          </tr>
          <tr>
            <td>Address: '.$sub_row["address"].'</td>
          </tr>
          <tr>
            <td>Contact: '.$sub_row["contact"].'</td>
          </tr>
          <tr>
            <td style="padding-top:70px;text-align:center">____________</td>
          </tr>
          <tr>
            <td style="text-align:center">Signature</td>
          </tr>
          <tr>
            <td style="padding-top:41px;">Date Issued: '.date("F d, Y", strtotime($today)).'</td>
          </tr>
          <tr>
            <td>Valid Until: '.date("F d, Y", strtotime($modifiedDate)).'</td>
          </tr>
          <tr>
            <td><p style="font-size:11px;"> FOUND PLEASE RETURN TO MATAIN BARANGAY HALL</p></td>
          </tr>
        </table>

      </div>
    </div>
   </body> ';
   }
 $pdf = new Pdf();
// $dompdf->loadHtml(html_entity_decode($html));
//landscape orientation
 $file_name = 'Invoice-'.$row["req_id"].'.pdf';
 $pdf->loadHtml($output);
 $pdf->setPaper('A4', 'landscape');
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>

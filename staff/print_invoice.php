<?php
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
<title>Payment History</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: small;
    }
    .gray {
        background-color: #27329b
    }
</style>

</head>';
$output .= '<body>';
// $admin_details = $connect->query("SELECT * FROM account LIMIT 1")->fetch();
$output .= '
<body>

  <table width="100%">
    <tr>
        <td align="right">
            <h1 style="color: #27329b">Barangay Matain Service and Information Management System</h1>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td align="right"><strong style="color: #27329b">Date:</strong> '.date("F j, Y", strtotime($row["date_paid"])).'</td>
    </tr>

  </table>
  <br/>

  <table width="100%">
    <thead style="background-color: #27329b; color: #fff;">
      <tr>
        <th>Tracking Number</th>
        <th>Request</th>
        <th>Amount</th>
      </tr>
    </thead>';
 }
 //get all order items
 $statement = $connect->prepare(
    "SELECT * FROM tbl_request 
    WHERE req_id = :req_id"
   );
   $statement->execute(
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
    <tr>
     <td align="center" width="20%">'.$sub_row["tracking_id"].'</td>
     <td align="left" width="60%">'.$sub_row["request_type"].'</td>
     <td align="center" width="10%">'.$sub_row["amount"].'</td>
    </tr>
    ';
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

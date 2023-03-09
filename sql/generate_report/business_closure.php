<?php 

require_once "../conn.php";

$filename = 'Business Closure Records as of-' .date('Y-m-d').'.csv';

$sql = "SELECT *FROM tbl_request WHERE request_type='Business Closure'";
$result = mysqli_query($conn,$sql);

$array = array();

$file =fopen($filename,'w');
$array = array("Fullname","Date Closed","Payment Method","Payment Status","Request Status");
fputcsv($file,$array);

while($row = mysqli_fetch_array($result))
{
    $fullname = $row['fullname'];
    $date_close = $row['date_close'];
    $payment_method = $row['payment_method'];
    $payment_status = $row['payment_status'];
    $request_status = $row['request_status'];


    $array = array($fullname,$date_close,$payment_method,$payment_status,$request_status);
    fputcsv($file,$array);
}
fclose($file);
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/csv");
readfile($filename);
unlink($filename);
exit();
//  require_once 'conn.php';
//  require_once '../library/fpdf/fpdf.php';

//  $result ="SELECT * FROM tbl_officials ORDER BY official_id";
//  $sql = $conn->query($result);

//  $pdf = new FPDF();
//  $pdf ->AddPage();
//  $pdf->SetFont('Arial','B',12);
//  while($row = $sql->fetch_object())
//  {
//     $official_id = $row->official_id;
//     $position = $row->position;
//     $firstname = $row->firstname;
//     $middlename = $row->middlename;
//     $lastname = $row->lastname;
//     $phone = $row->phone;
//     $purok = $row->purok;
//     $start_term = $row->start_term;
//     $end_term = $row->end_term;

//     $pdf->Cell(10,10,$official_id,1);
//     $pdf->Cell(10,10,$position,1);
//     $pdf->Cell(10,10,$firstname,1);
//     $pdf->Cell(10,10,$middlename,1);
//     $pdf->Cell(10,10,$lastname,1);
//     $pdf->Cell(10,10,$phone,1);
//     $pdf->Cell(10,10,$purok,1);
//     $pdf->Cell(10,10,$start_term,1);
//     $pdf->Cell(10,10,$end_term,1);
//     $pdf->Ln();

//  }
//  $pdf->Output();

// require_once 'connection_export.php';
// function filterData($str)
// {
//     $str = preg_replace ("/\t/","\\t", $str);
//     $str = preg_replace ("/\r?\n/","\\n", $str);
//     if(strstr($str,'"')) $str ='"' . str_replace('"', '""', $str) .'"';
// }

// $filename = "members_export_data-" . date('Ymd') . ".csv";
// $fields = array ('Official Id','Position','Firstname','Middlename','Lastname','Contact No','Start Term','End Term');
// $excelData = implode("\t", array_values($fields)). "\n";

// $query = $db->query ("SELECT * FROM tbl_officials ORDER BY official_id ASC");

// if($query->num_rows >0)
// {
//     $i=0;
//     while($row= $query->fetch_assoc())
//     {
//         $i++;
//         $rowData = array($i, $row['position'],$row['firstname'],$row['middlename'],$row['lastname'],$row['phone'],$row['purok'],$row['start_term'],$row['end_term']);
//         array_walk($rowData,'filterData');
//         $excelData .= implode("\t", array_values($rowData)) . "\n";
//     }
// }else{
//     $excelData .= 'No records Found ..'. "\n";
// }



// header("Content-Disposition: attachment; filename=\"$filename\"");
// header("Content-Type: application/vnd.ms-excel");
//export.php  
// $connect = mysqli_connect("localhost", "root", "", "bmsims");
// session_start();
// $name = "Denver";


// $filename = "".date('Y/m/d') . ".xlsx";    

// $output = '';
// if(isset($_POST["export"]))
// {
//  $query = "SELECT * FROM tbl_officials";
//  $result = mysqli_query($connect, $query);
//  if(mysqli_num_rows($result) > 0)
//  {
//   $output .= '
//    <table class="table" bordered="1">  
//     <tr>  
//         <th>Official ID</th>  
//         <th>Position</th>  
//         <th>First Name</th>  
//         <th>Middle Name</th>
//         <th>Last Name</th>
//         <th>Contact Number</th>  
//         <th>Purok</th>  
//         <th>Start Term</th>  
//         <th>End Term</th>
//     </tr>
//   ';
//   while($row = mysqli_fetch_array($result))
//   {
//    $output .= '
//     <tr>  
//         <td>'.$row["official_id"].'</td>  
//         <td>'.$row["position"].'</td>  
//         <td>'.$row["firstname"].'</td>  
//         <td>'.$row["middlename"].'</td>  
//         <td>'.$row["lastname"].'</td>
//         <td>'.$row["phone"].'</td>  
//         <td>'.$row["purok"].'</td>  
//         <td>'.$row["start_term"].'</td>  
//         <td>'.$row["end_term"].'</td>  
//     </tr>
//    ';
//   }
//   $output .= '</table>';
//   header('Content-Type: application/xlsx');
//   header("Content-Disposition: attachment; filename= \"$filename\"");
//   echo $output;
//  }
// }
?>

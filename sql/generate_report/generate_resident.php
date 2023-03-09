<?php 
require_once '../config/conn.php';
require_once '../../fpdf/fpdf.php';

 $result ="SELECT * FROM tbl_resident ORDER BY acc_id";
 $sql = $conn->query($result);

 $pdf = new FPDF('L','mm','A4');
 $pdf ->AddPage();
 $pdf->SetFont('Arial','',22);
 $pdf->SetFillColor(976,245,458);
 $pdf_date= "Date is " . date("Y-m-d") . "";
 
$pdf->Cell(120);
$pdf->SetTextColor(39,50,155,255);
// $pdf->Image('images/BarangayLogo.png',0,0);
$pdf->Cell(245, 20, 'Resident Lists', 0, 1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(500, 10,  $pdf_date , 0, 0, 'C');


$pdf->SetFont('Arial','',9);

// $pdf->SetFillColor(16,16,16,255);
$pdf->SetTextColor(16,16,16,255);
$pdf->Cell(25,10,'Firstname',1);
$pdf->Cell(25,10,'Middlename',1);
$pdf->Cell(25,10,"Lastname",1);
$pdf->Cell(20,10,'Gender',1);
// $pdf->Cell(35,10,'Place of Birth',1);
// $pdf->Cell(25,10,'Birthdate',1);
$pdf->Cell(25,10,'Civil Status',1);
$pdf->Cell(100,10,"Address",1);
$pdf->Cell(20,10,'Purok',1);
$pdf->Cell(30,10,'Phone',1);
	$pdf->Ln();


 while($row = $sql->fetch_object())
 {

    $firstname = $row->firstname;
    $middlename = $row->middlename;
    $lastname = $row->lastname;
    $gender = $row->gender;
   //  $place_of_birth = $row->place_of_birth;
   //  $bdate = $row->bdate;
    $civil_status = $row->civil_status;
    $address = $row->address;
    $purok = $row->purok;
    $phone = $row->phone;

   

    $pdf->Cell(25,10,$firstname,1,);
    $pdf->Cell(25,10,$middlename,1);
    $pdf->Cell(25,10,$lastname,1);
    $pdf->Cell(20,10,$gender,1);
   //  $pdf->Cell(35,10,$place_of_birth,1);
   //  $pdf->Cell(25,10,$bdate,1,);
    $pdf->Cell(25,10,$civil_status,1);
    $pdf->Cell(100,10,$address,1);
    $pdf->Cell(20,10,$purok,1);
    $pdf->Cell(30,10,$phone,1);
    $pdf->Ln();

 }
 $pdf->Output();
// require_once "../conn.php";

// $filename = 'Barangay Officials Records as of-' .date('Y-m-d').'.csv';

// $sql = "SELECT *FROM tbl_officials";
// $result = mysqli_query($conn,$sql);

// $array = array();
 
// $file =fopen($filename,'w');
// $array = array("Official Id","Position","Firstname","Middlename","Lastname","Contact No","Purok","Start Term","End Term");
// fputcsv($file,$array);

// while($row = mysqli_fetch_array($result))
// {
//     $official_id = $row['official_id'];
//     $position = $row['position'];
//     $firstname = $row['firstname'];
//     $middlename = $row['middlename'];
//     $lastname = $row['lastname'];
//     $phone = $row['phone'];
//     $purok = $row['purok'];
//     $start_term = $row['start_term'];
//     $end_term = $row['end_term'];

//     $array = array($official_id,$position,$firstname,$middlename,$lastname,$phone,$purok, $start_term,$end_term);
//     fputcsv($file,$array);
// }
// fclose($file);
// header("Content-Description: File Transfer");
// header("Content-Disposition: attachment; filename=$filename");
// header("Content-Type: application/csv");
// readfile($filename);
// unlink($filename);
// exit();


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

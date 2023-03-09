<?php
require_once '../conn.php';
require_once '../../fpdf/fpdf.php';

 $result ="SELECT * FROM tbl_request WHERE payment_method='Gcash' AND payment_status='Paid' ORDER BY req_id";
 $sql = $conn->query($result);

//  $pdf = new FPDF('L','mm','A4');
 $pdf = new FPDF();
 $pdf ->AddPage();
 $pdf->SetFont('Arial','',10);


$pdf->Cell(80);
$pdf->Cell(30, 10, 'Payment History', 1, 0, 'C');
$pdf->Ln(20);

 	$pdf->Cell(10,10,'ID',1);
    $pdf->Cell(30,10,'Tracking ID',1);
    $pdf->Cell(50,10,'Name',1);
    $pdf->Cell(40,10,"Type",1);
    // $pdf->Cell(20,10,'Get Date',1);
    $pdf->Cell(20,10,'Payment',1);
    $pdf->Cell(20,10,'Amount',1);
    $pdf->Cell(17,10,'Status',1);
	$pdf->Ln();

 while($row = $sql->fetch_object())
 {
    $req_id = $row->req_id;
    $tracking_id = $row->tracking_id;
    $fullname = $row->fullname;
    $request_type = $row->request_type;
    $get_date = $row->get_date;
    $payment_method = $row->payment_method;
    $amount = $row->amount;
    $payment_status = $row->payment_status;

    $pdf->Cell(10,10,$req_id,1);
    $pdf->Cell(30,10,$tracking_id,1);
    $pdf->Cell(50,10,$fullname,1);
    $pdf->Cell(40,10,$request_type,1);
    // $pdf->Cell(20,10,$get_date,1);
    $pdf->Cell(20,10,$payment_method,1);
    $pdf->Cell(20,10,$amount,1);
    $pdf->Cell(17,10,$payment_status,1);
    $pdf->Ln();

 }
 $pdf->Output();
<?php
require_once '../config/conn.php';
require_once '../../fpdf/fpdf.php';
// import('actions/pdf.php');

 $result ="SELECT * FROM tbl_invoice ";
 $sql = $conn->query($result);

//  $totalSales = 0;
//  $showProducts = "SELECT * FROM tbl_invoice";
//  $statement = $pdo->query($showProducts);
//  $products = $statement->fetchAll(PDO::FETCH_ASSOC);
//  $all = $statement->rowCount();
//  foreach($products as $invoice){
//  $totalSales = $totalSales + $invoice['amount'];
//  }

 $pdf_date= "Date is " . date("Y-m-d") . "";

//  $pdf = new FPDF('L','mm','A4');
 $pdf = new FPDF();
 $pdf ->AddPage();
 $pdf->SetFont('Arial','',15);


$pdf->Cell(80);
$pdf->SetTextColor(39,50,155,255);
// $pdf->Image('images/BarangayLogo.png',0,0);
$pdf->Cell(75, 20, 'Barangay Matain Service and Information Management System', 0, 1, 'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(355, 10,  $pdf_date , 0, 0, 'C');

$pdf->Ln(20);

$pdf->SetFont('Arial','',9);

// $pdf->SetFillColor(16,16,16,255);
$pdf->SetTextColor(16,16,16,255);
 	$pdf->Cell(8,10,'ID',1);
    $pdf->Cell(25,10,'Tracking ID',1);
    $pdf->Cell(45,10,'Name',1);
    $pdf->Cell(40,10,"Type",1);
    $pdf->Cell(20,10,'Date Paid',1);
    $pdf->Cell(15,10,'Payment',1);
    $pdf->Cell(15,10,'Amount',1);
    $pdf->Cell(25,10,'Status',1);
	$pdf->Ln();

 while($row = $sql->fetch_object())
 {
    $invoice_id = $row->invoice_id;
    $tracking_id = $row->tracking_id;
    $fullname = $row->fullname;
    $request_type = $row->request_type;
    $date_paid = $row->date_paid;
    $payment_method = $row->payment_method;
    $amount = $row->amount;
    $request_status = $row->request_status;

    $pdf->Cell(8,10,$invoice_id,1);
    $pdf->Cell(25,10,$tracking_id,1);
    $pdf->Cell(45,10,$fullname,1);
    $pdf->Cell(40,10,$request_type,1);
    $pdf->Cell(20,10,$date_paid,1);
    $pdf->Cell(15,10,$payment_method,1);
    $pdf->Cell(15,10,$amount,1);
    $pdf->Cell(25,10,$request_status,1);
    $pdf->Ln();

 }
 $pdf->Output();
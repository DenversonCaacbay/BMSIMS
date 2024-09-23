<?php
require_once '../conn.php';
require_once '../../fpdf/fpdf.php';
// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch details from resident_accounts joined with requests using email
$email = "example@example.com"; // Replace with the specific email you want to use
$sql = "SELECT ra.age, ra.fname, ra.mname, ra.lname, ra.address
        FROM resident_accounts ra
        INNER JOIN requests r ON ra.id = r.resident_id
        WHERE r.email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each row of data in the PDF
    while ($row = $result->fetch_assoc()) {
        $age = $row["age"];
        $fname = $row["fname"];
        $mname = $row["mname"];
        $lname = $row["lname"];
        $address = $row["address"];

        // Display the details in the PDF
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Age: ' . $age, 0, 1);
        $pdf->Cell(0, 10, 'First Name: ' . $fname, 0, 1);
        $pdf->Cell(0, 10, 'Middle Name: ' . $mname, 0, 1);
        $pdf->Cell(0, 10, 'Last Name: ' . $lname, 0, 1);
        $pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
    }
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();

// Output the PDF
$pdf->Output();
?>
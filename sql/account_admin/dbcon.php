
<?php
$conn = new mysqli('localhost','u622464203_bmsims','Bmsims2023','u622464203_bmsims');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>
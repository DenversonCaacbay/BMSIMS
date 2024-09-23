<?php
// Assuming you have a PDO database connection established
$pdo = require '../config/connection.php';
// Retrieve the email from the POST request
$email = $_POST['email'];

// Prepare the SQL statement
$stmt = $pdo->prepare("SELECT COUNT(*) FROM resident_accounts WHERE email = :email");
$stmt->bindValue(':email', $email);
$stmt->execute();

// Fetch the result
$count = $stmt->fetchColumn();

// Check if the email exists in the database
if ($count > 0) {
  // Email already exists
  $response = "Email already exists.";
  header("Location: ../../user/email_check.php?response=" . urlencode($response));
} else {
  // Email does not exist
  $response = "Email is available.";
  header("Location: ../../user/user_register.php?email=" . urlencode($email) . "&response=" . urlencode($response));
}

// Redirect back to check_email.php with the response
exit();
?>
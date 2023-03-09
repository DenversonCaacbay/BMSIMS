<?php 
class Database {
	private $host = "localhost";
	private $user = "";
	private $password = "root";
	private $database = "bmsims";
	
	function runQuery($sql) {
		$conn = new mysqli($this->host,$this->user,$this->password,$this->database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $resultset[] = $row;
      }
    }
    $conn->close();

		if(!empty($resultset))
			return $resultset;
	}
}
?>
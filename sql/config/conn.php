<?php
    $server ="localhost";
    $username="u622464203_bmsims";
    $password="Bmsims2023";
    $dbname="u622464203_bmsims";

    $conn = new mysqli($server, $username, $password, $dbname);

    if($conn->connect_error)
    {
        die("Connection failed" .$conn->connect_error);
    }
?>
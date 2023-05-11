<?php
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "user";
    $database = "document_request_system";

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $database);
    
    if(!$conn){
        die("Connection failed ". mysqli_connect_error());
    }

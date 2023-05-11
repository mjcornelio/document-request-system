<?php 
include_once "../connections/connection.php";


if(isset($_GET['done'])){
    $reference_ID = $_GET['done'];

    $sql ="UPDATE `document_request` SET `status`='Accomplished' WHERE `reference_ID`= '$reference_ID'";
    $result = mysqli_query($conn, $sql);

    if($result){
        
        header('location:../pending-request.php?done=4');
    }else{
        die(mysqli_error($conn));
    }

}

if(isset($_GET['working'])){
    $reference_ID = $_GET['working'];

    $sql ="UPDATE `document_request` SET `status`='Working' WHERE `reference_ID`= '$reference_ID'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header('location:../pending-request.php?work=5');
        
    }else{
        die(mysqli_error($conn));
    }

}

if(isset($_GET['reject'])){
    $reference_ID = $_GET['reject'];

    $sql ="UPDATE `document_request` SET `status`='Rejected' WHERE `reference_ID`= '$reference_ID'";
    $result = mysqli_query($conn, $sql);

    if($result){
        header('location:../pending-request.php?reject=6');
        
    }else{
        die(mysqli_error($conn));
    }

}

?>
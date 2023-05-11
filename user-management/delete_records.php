<?php 
include_once '../connections/connection.php';

if(isset($_GET['student'])){

    

    if(isset($_GET['delete'])){
        $studentID = $_GET['delete'];

        $sql = "DELETE FROM `student_records` WHERE student_number= '$studentID'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location:../user-management.php?student=1&del=1');
            
        }else{
            die(mysqli_error($conn));
        }
    }

}elseif(isset($_GET['admin'])){
    if(isset($_GET['delete'])){
        $employee_id = $_GET['delete'];

        $sql = "DELETE FROM `admin_records` WHERE employee_id= '$employee_id'";
        $result = mysqli_query($conn, $sql);

        if($result){
            header('location:../user-management.php?admin=1&del=1');
            
        }else{
            die(mysqli_error($conn));
        }
    }
}
?>
<?php

    include_once "connection.php";

    if(isset($_POST['student-number']) && isset($_POST['email-address'])){
        function validate($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Getting values passes from form in student-verification.php file
        $studentnumber = validate($_POST['student-number']);
        $email = validate($_POST['email-address']);

        if(empty($studentnumber)){
            header("location: ../student-verification.php?error=Student Number is Required");
            exit();
        }else if(empty($email)){
            header("location: ../student-verification.php?error=Email Address is Required");
            exit();
        }else{
            $sql =  "SELECT * FROM student_records WHERE student_number = '$studentnumber' AND email_address ='$email'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)==1){
                $row = mysqli_fetch_assoc($result);
                
                if($row['student_number']==$studentnumber && $row['email_address'] == $email){
                    header("location: ../request-form-1.php?verify=1");
                    session_start();
                    $_SESSION['nID'] = true;
                } else{
                    header("location: ../student-verification.php?error=Incorrect Student Number or Email Address");
                    exit();
                }
            }
            else{
                header("location: ../student-verification.php?error=Incorrect Student Number or Email Address");
                exit();
            }
        }
    }else{
        header("location: ../student-verification.php");
        exit();
    }

?>
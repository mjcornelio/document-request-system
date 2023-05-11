<?php

    include_once "connection.php";

    if(isset($_POST['username']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Getting values passes from form in student-verification.php file
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        if(empty($username)){
            header("location: ../admin-login.php?error=Please input username");
            exit();
        }else if(empty($password)){
            header("location: ../admin-login.php?error=Please input password");
            exit();
        }else{
            $sql =  "SELECT * FROM admin_records WHERE username = '$username' AND password ='$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)==1){
                $row = mysqli_fetch_assoc($result);
                
                if($row['username']==$username && $row['password'] == $password){
                    header("location: ../pending-request.php?login=1");
                    session_start();
                    $_SESSION['login'] = true;
                } else{
                    header("location: ../admin-login.php?error=Incorrect Username or Password");
                    exit();
                }
            }
            else{
                header("location: ../admin-login.php?error=Incorrect Username or Password");
                exit();
            }
        }
    }else{
        header("location: ../admin-login.php");
        exit();
    }

?>
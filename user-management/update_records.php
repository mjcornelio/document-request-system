
<?php 
include_once "../connections/connection.php";


if(isset($_GET['student'])){

    $studentID = $_GET['update'];
    $sql = "SELECT * FROM student_records WHERE student_number='$studentID'";
    $result = mysqli_query($conn, $sql)or die($conn->error);
    $row=mysqli_fetch_assoc($result);
    $student_number = $row['student_number'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $middle_name = $row['middle_name'];
    $email_address = $row['email_address'];
    $gender = $row['gender'];
    $course = $row['program_course'];

    if(isset($_POST['submit'])){
        $student_number = $_POST['student-number'];
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $middle_name = $_POST['middle-name'];
        $email_address = $_POST['email-address'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];

        $sql ="UPDATE `student_records` SET student_number='$student_number', first_name='$first_name', last_name='$last_name',
        middle_name='$middle_name', email_address='$email_address', gender='$gender', program_course='$course' WHERE student_number='$studentID'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('location:../user-management.php?student=1&update=2');
        }else{
            die(mysqli_error($conn));
        }
    }elseif(isset($_POST['cancel'])){
        header('location:../user-management.php?student=1');
    }


} elseif(isset($_GET['admin'])){


    $employee_id = $_GET['update'];
    $sql = "SELECT * FROM `admin_records` WHERE `employee_id`='$employee_id'";
    $result = mysqli_query($conn, $sql)or die($conn->error);
    $row=mysqli_fetch_assoc($result);

    $employee_id = $row['employee_id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $middle_name = $row['middle_name'];
    $email_address = $row['email_address'];
    $gender = $row['gender'];
    $address = $row['address'];
    $username=$row['username'];
    $password=$row['password'];

    if(isset($_POST['submit'])){
        $employee_ID = $_POST['employee-id'];
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $middle_name = $_POST['middle-name'];
        $email_address = $_POST['email-address'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql ="UPDATE `admin_records` SET `employee_id`='$employee_ID', `first_name`='$first_name', `last_name`='$last_name',
        `middle_name`='$middle_name', `email_address`='$email_address', `gender`='$gender', `address`='$address', `username`='$username', `password`='$password' WHERE employee_id='$employee_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('location:../user-management.php?admin=1&update=2');
        }else{
            die(mysqli_error($conn));
        }
    }elseif(isset($_POST['cancel'])){
        header('location:../user-management.php?admin=1');
    }

}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a0806a35f6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/request-form.css">
    <link rel="stylesheet" href="css/admin-portal.css">
    <title>Online Document Request | Sarmiento Campus</title>
    <link rel="icon" href="../img/logo.png" type="image/png">
</head>
<body>
    <main>
        <nav>   
            <div class="container">
                <div class="logo">
                    <img src="../img/logo.png" alt="logo">
                    <div class="logo-content">
                        <h2>BULACAN STATE UNIVERSITY</h2>
                        <h3>Sarmiento Campus</h3>
                    </div>
                </div>
                <div class="nav-right">
                    <ul>
                        <li><a href="../admin-login.php" id="admin">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- --------------STUDENT-------------- -->

        <?php if(isset($_GET['student'])){?>
            <div class="form-container">
                <h1>UPDATE STUDENT RECORD</h1>
                <form method="POST">
                    <h3>OFFICE OF THE REGISTRAR</h3>
                    <label for="student-number" >Student Number</label>
                    <input type="text" name="student-number" required class="input-field" autocomplete="off" value ="<?php echo $student_number?>">

                    <label for="first-name">First Name</label>
                    <input type="text" name="first-name" required class="input-field" autocomplete="off" value ="<?php echo $first_name?>">

                    <label for="last-name">Last Name</label>
                    <input type="text" name="last-name" required class="input-field" autocomplete="off" value ="<?php echo $last_name?>">

                    <label for="middle-name">Middle Name</label>
                    <input type="text" name="middle-name" required class="input-field" autocomplete="off" value ="<?php echo $middle_name?>">

                    <label for="email-address">Email Address</label>
                    <input type="email" name="email-address" required class="input-field" autocomplete="off" value ="<?php echo $email_address?>">

                    <label for="gender">Gender</label>
                    <input type="text" name="gender" required class="input-field" autocomplete="off" value ="<?php echo $gender?>">

                    <label for="course">Course Name</label>
                    <select class="input-field" name="course" id="course" value ="<?php echo $course?>">
                        <option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
                        <option value="BIT-Comp">Bachelor in Industrial Technology (BIT) Major in Computer</option>
                        <option value="BIT-Elec">Bachelor in Industrial Technology (BIT) Major in Electronics</option>
                        <option value="BIT-Draft">Bachelor in Industrial Technology (BIT) Major in Drafting</option>
                        <option value="BIT-Foods">Bachelor in Industrial Technology (BIT) Major in Foods</option>
                        <option value="BSEd-Eng">Bachelor of Secondary Education (BSEd) Major in English</option>
                        <option value="BSEd-Math">Bachelor of Secondary Education (BSEd) Major in Math</option>
                        <option value="BSEd-PSci">Bachelor of Secondary Education (BSEd) Major in Physical Science</option>
                        <option value="BEEd">Bachelor in Elementary Education (BEEd Generalist)</option>
                        <option value="BSEd-Sci">Bachelor of Secondary Education (BSEd) Major in Science</option>
                        <option value="BSEd-Fil">Bachelor of Secondary Education (BSEd) Major in Filipino</option>
                        <option value="BSEd-SS">Bachelor of Secondary Education (BSEd) Major in Social Studies</option>
                        <option value="BSBA-FM">BS in Business Administration (BSBA) Major in Financial Management</option>
                        <option value="BSBA-MM">BS in Business Administration (BSBA) Major in Marketing Management</option>
                        <option value="BSE">BS in Entrepreneurship (BSE)</option>
                        <option value="BSBA Business Economics">BS in Business Administration (BSBA) Major in Business Economics</option>
                        <option value="BSHM">BS in Hospitality Management (BSHM)</option>
                        <option value="BSHRM">BS in Hotel and Restaurant Management (BS HRM)</option>
                        <option value="BSTM">BS in Tourism Managment (BSTM)</option>
                    </select>
                    <div class="button">
                        
                        <input type="submit" id="cancel" value="CANCEL" name="cancel">
                        <input type="submit" value="UPDATE" name="submit" class="submit">
                        
                    
                    </div>
                </form>
            </div>
        <?php }elseif(isset($_GET['admin'])) {?>

            <!-- -----------------ADMIN-------------- -->
            <div class="form-container">
                <h1>UPDATE ADMIN RECORD</h1>
                <form method="POST">
                    <h3>OFFICE OF THE REGISTRAR</h3>
                    <label for="employee-id" >Employee ID</label>
                    <input type="text" name="employee-id" required class="input-field" autocomplete="off" value ="<?php echo $employee_id?>">

                    <label for="first-name">First Name</label>
                    <input type="text" name="first-name" required class="input-field" autocomplete="off" value ="<?php echo $first_name?>">

                    <label for="last-name">Last Name</label>
                    <input type="text" name="last-name" required class="input-field" autocomplete="off" value ="<?php echo $last_name?>">

                    <label for="middle-name">Middle Name</label>
                    <input type="text" name="middle-name" required class="input-field" autocomplete="off" value ="<?php echo $middle_name?>">

                    <label for="email-address">Email Address</label>
                    <input type="email" name="email-address" required class="input-field" autocomplete="off" value ="<?php echo $email_address?>">

                    <label for="gender">Gender</label>
                    <input type="text" name="gender" required class="input-field" autocomplete="off" value ="<?php echo $gender?>">
                    
                    <label for="address">Address</label>
                    <input type="text" name="address" required class="input-field" autocomplete="off" value ="<?php echo $address?>">

                    <label for="username">Username</label>
                    <input type="text" name="username" required class="input-field" autocomplete="off" value ="<?php echo $username?>">

                    <label for="password">Password</label>
                    <input type="text" name="password" required class="input-field" autocomplete="off" value ="<?php echo $password?>">
                    
                    <div class="button">
                        
                        <input type="submit" id="cancel" value="CANCEL" name="cancel">
                        <input type="submit" value="UPDATE" name="submit" class="submit">
                        
                    </div>
                </form>
            </div>
            <?php }?>
    </main>
    <footer>
        <div class="inner-footer">
            <h5>&copy; Coyright 2021| Bulacan State University</h5>
            <h5>Need Help? Contact the <a href="mailto:registrar.sarmiento@bulsu.edu.ph">
                Registrar's Office </a></h5>
        </div>
    </footer>

    <script>
      
    </script>

</body>
</html>
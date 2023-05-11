
<?php 
include_once "../connections/connection.php";
session_start();
if (!isset($_SESSION['login'])){
    header('Location: ../admin-login.php'); 
}

if(isset($_GET['student'])){
    
        
        if(isset($_POST['submit'])){
            $student_number = $_POST['student-number'];
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $middle_name = $_POST['middle-name'];
            $email_address = $_POST['email-address'];
            $gender = $_POST['gender'];
            $course = $_POST['course'];

            $sql ="INSERT INTO `student_records`(`student_number`, `first_name`, `last_name`, `middle_name`, `email_address`, `gender`, `program_course`) 
            VALUES ('$student_number','$first_name','$last_name','$middle_name','$email_address','$gender','$course')";
            $result = mysqli_query($conn, $sql);
            if($result){
                header('location:../user-management.php?student=1&add=3');
            }else{
                header('location:../user-management/add_records.php?student=1&error=1');
            }
        }elseif(isset($_POST['cancel'])){
            header('location:../user-management.php?student=1');
        } 
} elseif(isset($_GET['admin'])){

    if(isset($_POST['submit'])){
        $employee_id = $_POST['employee-id'];
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $middle_name = $_POST['middle-name'];
        $email_address = $_POST['email-address'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql ="INSERT INTO `admin_records`(`employee_id`, `first_name`, `last_name`, `middle_name`, `password`, `username`, `email_address`, `gender`, `address`) 
        VALUES ('$employee_id','$first_name','$last_name','$middle_name','$password','$username','$email_address','$gender','$address')";
        $result = mysqli_query($conn, $sql);
        if($result){
            header('location:../user-management.php?admin=1&add=3');
        }else{
            header('location:../user-management/add_records.php?student=1&error=2');
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
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <?php if(isset($_GET['student'])){?>

            <!-- -----------STUDENT------------- -->

        <div class="form-container">
            <h1>ADD STUDENT RECORD</h1>
            <form method="POST">
            <a href="../user-management.php?student=1"><img class="back-btn"src="../img/back.png" alt="back"></a>
                <h3>OFFICE OF THE REGISTRAR</h3>
                <label for="student-number" >Student Number</label>
                <input type="text" name="student-number"  class="input-field" autocomplete="off">

                <label for="first-name">First Name</label>
                <input type="text" name="first-name" class="input-field" autocomplete="off">

                <label for="last-name">Last Name</label>
                <input type="text" name="last-name"  class="input-field" autocomplete="off">

                <label for="middle-name">Middle Name</label>
                <input type="text" name="middle-name"  class="input-field" autocomplete="off">

                <label for="email-address">Email Address</label>
                <input type="email" name="email-address"  class="input-field" autocomplete="off">

                <label for="gender">Gender</label>
                <select class="input-field" name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>


                <label for="course">Course Name</label>
                <select class="input-field" name="course" id="course" >
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
                        
                            <button class="cancel-btn"id="cancel"><a href="../user-management.php?student=1">CANCEL</a></button>
                        <input type="submit" value="ADD" name="submit" class="submit">

                    </div>
            </form>
        </div>

        <?php }elseif(isset($_GET['admin'])){?>

            <!-- -----------ADMIN------------- --> 
            
            <div class="form-container">
            <h1>ADD ADMIN RECORD</h1>
            <form method="POST">
                <h3>OFFICE OF THE REGISTRAR</h3>
                <a href="../user-management.php?admin=1"><img class="back-btn"src="../img/back.png" alt="back"></a>
                <label for="employee-id" >Employee ID</label>
                    <input type="text" name="employee-id" required class="input-field" autocomplete="off" >

                    <label for="first-name">First Name</label>
                    <input type="text" name="first-name" required class="input-field" autocomplete="off" >

                    <label for="last-name">Last Name</label>
                    <input type="text" name="last-name" required class="input-field" autocomplete="off" >

                    <label for="middle-name">Middle Name</label>
                    <input type="text" name="middle-name" required class="input-field" autocomplete="off" >

                    <label for="email-address">Email Address</label>
                    <input type="email" name="email-address" required class="input-field" autocomplete="off" >

                    <label for="gender">Gender</label>
                    <select class="input-field" name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
                    
                    <label for="address">Address</label>
                    <input type="text" name="address" required class="input-field" autocomplete="off" >

                    <label for="username">Username</label>
                    <input type="text" name="username" required class="input-field" autocomplete="off" >

                    <label for="password">Password</label>
                    <input type="text" name="password" required class="input-field" autocomplete="off" >
                    

                    <div class="button">
                        
                        <button class="cancel-btn"id="cancel"><a href="../user-management.php?admin=1">CANCEL</a></button>
                        <input type="submit" value="ADD" name="submit" class="submit">
                        
                    
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
            <?php
                if(isset($_GET['error'])){
                    $message = $_GET['error'];
                }
            ?>
        <script>
            message = "<?php echo $message?>";
            if(message == 1){
                Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "The Student Number is Already Existed!",
                showConfirmButton: true,
                }).then((result) => {
                if (result.value) {
                    document.location.href = "add_records.php?student=1";
                }
                })

            } else if(message == 2){
                Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "The Employee ID is Already Existed!",
                showConfirmButton: true,
                }).then((result) => {
                if (result.value) {
                    document.location.href = "add_records.php?student=1";
                }
                })

            }
        </script>

</body>
</html>
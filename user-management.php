<?php
include_once "connections/connection.php";
session_start();
if (!isset($_SESSION['login'])){
     header('Location: admin-login.php'); 
 }



if(isset($_GET['student'])){


    $sql = "SELECT * FROM student_records";
    $pending = mysqli_query($conn,$sql) or die($conn->error);
}elseif(isset($_GET['admin'])){
    $sql = "SELECT * FROM admin_records";
    $pending = mysqli_query($conn,$sql) or die($conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="js/activepage.js"></script>
    <link rel="stylesheet" href="css/admin-portal.css">
    <link rel="stylesheet" href="css/admin-user-management.css">
    <script src="https://kit.fontawesome.com/85b07c1155.js" crossorigin="anonymous"></script>
    <title>Online Document Request | Sarmiento Campus</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body>
    <main>
        <!----------HEADER-NAV-------->
        <?php include "html-parts/nav.php"?>
       
        <!----------ADMIN-NAVIGATION-------->
        <div class="admin-navigation">
            <ul>
                <li><a href="pending-request.php">Pending Request</a></li>
                <li><a href="accomplished-request.php">Accomplished Request</a></li>
                <li><a href="user-management.php?student=1">User Management</a></li>
            </ul>
        </div>


        <!--------------STUDENT-RECORDS----------->

        <?php if(isset($_GET['student'])){?>
        <!----------RECORDS-NAV-------->
        <div class="table-container">
            <div class="user-management-nav">
                <ul>
                    <li><a class ="active" href="user-management.php?student=1">Student Records</a></li>
                    <li><a href="<?php echo 'user-management.php?admin=1'?>">Registrar Personnel</a></li>
                </ul>
            </div>
        <!----------TABLE-------->
            <div class="table-group" id="user-mng-table">
               <table class="user-management">
                   <div id="theader">
                        <form class="example" method = "POST">
                            <div class="search">
                            <input type = "search" name = "search" placeholder="Student Number" >
                            <button type="submit"><img class = "icon"src="img/search-white.png" alt="search"></button>
                            </div>
                            
                        </form>
                        <button title="Refresh-Page"class="refresh-btn"><a href="user-management.php?student=1"><img class="refresh" src="img/refresh.jpg" alt="refresh"></a></button>
                        <button class="action-button add"><a href="user-management/add_records.php?student=1"><i class="fas fa-user-plus"></i>Add Record</a></button>
                    </div>
                <thead>
                        <tr class="heading">
                            <th>Date Admitted</th>
                            <th>Student Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Middle Name</th>
                            <th>Email Address</th>
                            <th>Gender</th>
                            <th>Program Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($_POST['search'])){

                            $filtervalues = $_POST['search'];
                            $sql = "SELECT * FROM student_records WHERE student_number='$filtervalues'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result)>0){
                                $row = mysqli_fetch_assoc($result);
                                $studentID = $row['student_number'];
                                ?>

                                <tr>
                                <td><?php echo $row['date_admitted']; ?></td>
                                <td><?php echo $row['student_number']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['middle_name']; ?></td>
                                <td ><a class="mail" href="<?php echo 'mailto:'.$row['email_address']?>"?>
                                        <?php echo $row['email_address']; ?></a></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['program_course']; ?></td>
                                <td>
                                    <a class="action-button update" href="<?php echo 'user-management/update_records.php?student=1&update='.$row['student_number']?>">Update</a>
                                    <a class="action-button delete" id="delete"href="<?php echo 'user-management/delete_records.php?student=1&delete='.$row['student_number']?>">Delete</a>
                                    
                                </td>
                                </tr>


                            <?php
                            }else{
                                echo "<p class ='no_result'>No Existing Records</p>";
                            }
                            }
                            elseif($pending->num_rows>0){?>
                        <?php while ($row = mysqli_fetch_assoc($pending)){
                            
                            
                            ?>
                             <tr>
                                <td><?php echo $row['date_admitted']; ?></td>
                                <td><?php echo $row['student_number']; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['middle_name']; ?></td>
                                <td ><a class="mail" href="<?php echo 'mailto:'.$row['email_address']?>"?>
                                        <?php echo $row['email_address']; ?></a></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['program_course']; ?></td>
                                <td>
                                    <a class="action-button update"href="<?php echo 'user-management/update_records.php?student=1&update='.$row['student_number']?>">Update</a>
                                    <a class="action-button delete"href="<?php echo 'user-management/delete_records.php?student=1&delete='.$row['student_number']?>">Delete</a>
                                    
                                </td>
                                </tr>
                                
                            <?php } ?> 
                            <?php }else{echo "<p class ='no_result'>No Records</p>";}?>  
                    </tbody>
                </table>
               
                 <!-- ------POP-UP-MESSAGE-------->
                <?php 
                    $message ="";
                    if(isset($_GET['del'])){ 
                            $message = $_GET['del'];
                        }elseif(isset($_GET['update'])){
                            $message = $_GET['update'];
                        }elseif(isset($_GET['add'])){
                            $message = $_GET['add'];
                        }
                ?>
            </div>
        </div> 
        <?php }elseif(isset($_GET['admin'])){?>
        
        <!--------------ADMIN-RECORDS----------->


        <!----------RECORDS-NAV-------->
            <div class="table-container">
                <div class="user-management-nav">
                <ul>
                    <li><a  href="user-management.php?student=1">Student Records</a></li>
                    <li><a class ="active" href="<?php echo 'user-management.php?admin=1'?>">Registrar Personnel</a></li>
                </ul>
            </div>
            <!----------TABLE-------->
                <div class="table-group">
                  <table class="user-management">
                        <div id="theader">
                        <form class="example" method = "POST">
                            <div class="search">
                            <input type = "search" name = "search" placeholder="Student Number" >
                            <button type="submit"><img class = "icon"src="img/search-white.png" alt="search"></button>
                            </div>
                            
                        </form>
                        <button title="Refresh-Page"class="refresh-btn"><a href="user-management.php?admin=1"><img class="refresh" src="img/refresh.jpg" alt="refresh"></a></button>
                        <button class="action-button add"><a href="user-management/add_records.php?admin=1"><i class="fas fa-user-plus"></i>Add Record</a></button>
                    </div>
                    <thead>
                            <tr class="heading">
                                <th>Date Admitted</th>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Middle Name</th>
                                <th>Email Address</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($_POST['search'])){

                                $filtervalues = $_POST['search'];
                                $sql = "SELECT * FROM  `admin_records` WHERE employee_id='$filtervalues'";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result)>0){
                                    $row = mysqli_fetch_assoc($result);
                                    $employee_id = $row['employee_id'];
                                    ?>

                                    <tr>
                                    <td><?php echo $row['date_admitted']; ?></td>
                                    <td><?php echo $row['employee_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['middle_name']; ?></td>
                                    <td ><a class="mail" href="<?php echo 'mailto:'.$row['email_address']?>"?>
                                            <?php echo $row['email_address']; ?></a></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        <a class="action-button update" href="<?php echo 'user-management/update_records.php?admin=1&update='.$row['employee_id']?>">Update</a>
                                        <a class="action-button delete" id="delete"href="<?php echo 'user-management/delete_records.php?admin=1&delete='.$row['employee_id']?>">Delete</a>
                                        
                                    </td>
                                    </tr>


                                <?php
                                }else{
                                    echo "<p class ='no_result'>No Existing Records</p>";
                                }
                                }
                                elseif($pending->num_rows>0){?>
                            <?php while ($row = mysqli_fetch_assoc($pending)){
                                
                                
                                ?>
                                 <tr>
                                    <td><?php echo $row['date_admitted']; ?></td>
                                    <td><?php echo $row['employee_id']; ?></td>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['middle_name']; ?></td>
                                    <td ><a class="mail" href="<?php echo 'mailto:'.$row['email_address']?>"?>
                                            <?php echo $row['email_address']; ?></a></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        <a class="action-button update" href="<?php echo 'user-management/update_records.php?admin=1&update='.$row['employee_id']?>">Update</a>
                                        <a class="action-button delete" id="delete"href="<?php echo 'user-management/delete_records.php?admin=1&delete='.$row['employee_id']?>">Delete</a>
                                        
                                    </td>
                                    </tr>
                                    
                                <?php } ?> 
                                <?php }else{echo "<p class ='no_result'>No Records</p>";}?>  
                        </tbody>
                    </table>
                
                    <!-- ------POP-UP-MESSAGE-------->
                    <?php 
                        $message ="";
                        if(isset($_GET['del'])){ 
                                $message = $_GET['del'];
                            }elseif(isset($_GET['update'])){
                                $message = $_GET['update'];
                            }elseif(isset($_GET['add'])){
                                $message = $_GET['add'];
                            }
                    ?>
                </div>
            </div>
    <?php }?>                  
    </main>
    <!---------FOOTER-------->
    <?php include "html-parts/footer.php"?>


    <script>
        var x = document.querySelectorAll(".delete");
        var i;
        var y = document.querySelectorAll(".update");
        var j;

        for (i=0; i<x.length;i++){
       x[i].onclick = function(e){ 
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    document.location.href = ahref;
                }
                })
                }

            }
            for (j=0; j<x.length;j++){
       y[j].onclick = function(e){ 
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Update Data',
                text: "Do you want to make a change?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Proceed!'
                }).then((result) => {
                if (result.value) {
                    document.location.href = ahref;
                }
                })
                }

            }
    </script>
    <script>
      
        var message = "<?php echo $message?>";
        <?php if(isset($_GET['student'])){?>
        if(message==1){
            Swal.fire({
                title: 'Deleted!',
                text: "Record has been deleted.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.value) {
                    document.location.href = "user-management.php?student=1"
                }
                })
        }else if(message==2){
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: "Record has been Updated.",
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(() => {
                    document.location.href = "user-management.php?student=1"
                 }, 1600);
                    
                
        }else if(message==3){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "Record has been Added.",
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(() => {
                    document.location.href = "user-management.php?student=1"
                 }, 1600);
        }
        <?php }elseif(isset($_GET['admin'])){?>

            if(message==1){
            Swal.fire({
                title: 'Deleted!',
                text: "Record has been deleted.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
                }).then((result) => {
                if (result.value) {
                    document.location.href = "user-management.php?admin=1"
                }
                })
        }else if(message==2){
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: "Record has been Updated.",
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(() => {
                    document.location.href = "user-management.php?admin=1"
                 }, 1600);
                    
                
        }else if(message==3){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "Record has been Added.",
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(() => {
                    document.location.href = "user-management.php?admin=1"
                 }, 1600);
        }

        <?php } ?>

    </script>
</body>
</html>

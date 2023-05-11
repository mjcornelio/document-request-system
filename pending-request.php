<?php

include_once "connections/connection.php";

   session_start();
   if (!isset($_SESSION['login'])){
        header('Location: admin-login.php'); 
    }
  

    $sql = "SELECT * FROM document_request WHERE (`status` = 'Pending') OR (`status` = 'Working')";
    $pending = mysqli_query($conn,$sql) or die($conn->error);

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
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Online Document Request | Sarmiento Campus</title>
    <link rel="icon" href="img/logo.png" type="image/png">
</head>
<body>
    <main>
       <!----------HEADER-NAV-------->
       <?php include "html-parts/nav.php"?>
       

        <div class="admin-navigation">
            <ul>
                <li><a class="active" href="pending-request.php">Pending Request</a></li>
                <li><a href="accomplished-request.php">Accomplished Request</a></li>
                <li><a href="user-management.php?student=1">User Management</a></li>
            </ul>
        </div>
        
        <div class="table-container">
        <h1 class="title">ONLINE DOCUMENT REQUEST</h1>
            <div class="table-group" id = "request-table">
                
                <table id = "request">
                <div id="theader">
                        <form class="example" method = "POST">
                            <div class="search">
                            <input type = "search" name = "search" placeholder="Reference ID" >
                            <button type="submit"><img class = "icon"src="img/search-white.png" alt="search"></button>
                            </div>
                            
                        </form>
                        <button title="Refresh-Page"class="refresh-btn"><a href="pending-request.php"><img class="refresh" src="img/refresh.jpg" alt="refresh"></a></button>
                  </div>
                    <thead>
                        <tr class="heading">
                            <th>Date Requested</th>
                            <th>Reference ID</th>
                            <th>Student Number</th>
                            <th>Student Name</th>
                            <th>Email Address</th>
                            <th>Type of Document & Yr-Sem</th>
                            <th>Course & Section</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Birthdate</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php if(isset($_POST['search'])){
                            
                            $filtervalues = $_POST['search'];
                            $sql = "SELECT * FROM document_request WHERE reference_id='$filtervalues'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result)>0){
                                $row = mysqli_fetch_assoc($result);
                            ?>
                            <tr>
                                <td><?php echo $row['date_requested']; ?></td>
                                <td><?php echo $row['reference_ID']; ?></td>
                                <td><?php echo $row['student_number']; ?></td>
                                <td><?php echo $row['first_name']; echo ' ';
                                        echo $row['m_initial']; echo ' ';echo $row['last_name']; ?></td>
                                <td ><a class="mail" href="<?php echo 'mailto:'.$row['email_address']?>"?>
                                        <?php echo $row['email_address'];?></a></td>
                                <td><?php echo $row['type_of_document'];echo ' ';echo $row['yr_sem']; ?></td>
                                <td><?php echo $row['college_course'];echo ' ';echo $row['yr_section']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['birthdate']; ?></td>
                                <td ><?php echo $row['purpose']; ?></td>
                                <td class="status"><?php echo $row['status']; ?>...</td>
                                <td>
                                    <?php if($row['status']=='Working'){?>
                                        <a class="action-button update" id ="working"href="<?php echo 'user-management/update_request.php?working='.$row['reference_ID']?>">Work</a>
                                    <?php }else{?>
                                    <a class="action-button update" href="<?php echo 'user-management/update_request.php?working='.$row['reference_ID']?>">Work</a>
                                    <?php }?>
                                    <a class="action-button delete" id="delete"href="<?php echo 'user-management/update_request.php?done='.$row['reference_ID']?>">Done</a>
                                    
                                </td>
                          
                            </tr>
                            
                            <?php } else{ echo "<p  style='min-width:1850px' class ='no_result'>No Existing Request</p>";}
                                }

                         elseif($pending-> num_rows>0){?>
                        <?php while ($row = mysqli_fetch_assoc($pending)){?>
                            <tr>
                                <td><?php echo $row['date_requested']; ?></td>
                                <td><?php echo $row['reference_ID']; ?></td>
                                <td><?php echo $row['student_number']; ?></td>
                                <td><?php echo $row['first_name']; echo ' ';
                                        echo $row['m_initial']; echo ' ';echo $row['last_name']; ?></td>
                                <td ><a class="mail" href="<?php echo 'mailto:'.$row['email_address']?>"?>
                                        <?php echo $row['email_address'];?></a></td>
                                <td><?php echo $row['type_of_document'];echo ' ';echo $row['yr_sem']; ?></td>
                                <td><?php echo $row['college_course'];echo ' ';echo $row['yr_section']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['birthdate']; ?></td>
                                <td ><?php echo $row['purpose']; ?></td>
                                <td class="status"><?php echo $row['status']; ?>...</td>
                                <td>
                                    <?php if($row['status']=='Working'){?>
                                        <a class="action-button update" id ="working"href="<?php echo 'user-management/update_request.php?working='.$row['reference_ID']?>">Work</a>
                                    <?php }else{?>
                                    <a class="action-button update" href="<?php echo 'user-management/update_request.php?working='.$row['reference_ID']?>">Work</a>
                                    <?php }?>
                                    <a class="action-button delete" id="done"href="<?php echo 'user-management/update_request.php?done='.$row['reference_ID']?>">Done</a>
                                    <a class="action-button reject" href="<?php echo 'user-management/update_request.php?reject='.$row['reference_ID']?>">Reject</a>
                                    
                                </td>
                          
                            </tr>
                            <?php }?> 
                            <?php }else{
                                echo "<p style='min-width:1850px' class ='no_result'>No Current Request</p>";
                            }?>  
                    </tbody>
                        
                </table>
            </div>
        </div>
        <?php 
                    $message ="";
                    if(isset($_GET['login'])){ 
                            $message = $_GET['login'];
                        }elseif(isset($_GET['done'])){
                            $message = $_GET['done'];
                        }elseif(isset($_GET['reject'])){
                            $message = $_GET['reject'];
                        }
                ?>

    </main>
    
    <!---------FOOTER-------->
    <?php include "html-parts/footer.php"?>

    
     <script type="text/javascript">
        var message = "<?php echo $message?>";
        if(message==1){
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            }) 

            Toast.fire({
            icon: 'success',
            title: 'Log in successfully'
            })
            setTimeout(() => {
            document.location.href = "pending-request.php"
        }, 4000);
        }

        
            else if(message==4){
                Swal.fire({
                icon: 'success',
                title: 'Well done!',
                text: "Document request has been accomplished.",
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(() => {
                    document.location.href = "pending-request.php"
                 }, 1800);
            } else if(message==6){
                Swal.fire({
                icon: 'success',
                title: 'Rejected!',
                text: "Document request has been rejected!",
                showConfirmButton: false,
                timer: 1500
                })
                setTimeout(() => {
                    document.location.href = "pending-request.php"
                 }, 1800);
            }

       

        
        
        var x = document.querySelectorAll(".delete");
        var i;
        var y = document.querySelectorAll(".update");
        var j;
        var z = document.querySelectorAll(".reject");
        var k;

        for (i=0; i<x.length;i++){
       x[i].onclick = function(e){ 
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Done!',
                text: "Are you done working with this request?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    document.location.href = ahref;
                }
                })
                }

            }
            for (j=0; j<y.length;j++){
       y[j].onclick = function(e){ 
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Work',
                text: "Do you want to work with this request?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    document.location.href = ahref;
                }
                })
                }

            }
            for (k=0; k<z.length;k++){
       z[k].onclick = function(e){ 
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Rejected!',
                text: "Do you want to reject this request?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.value) {
                    document.location.href = ahref;
                }
                })
                }

            }




    
     </script>  
     
                   
</body>
</html>
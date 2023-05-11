<?php

include_once "connections/connection.php";
session_start();
if (!isset($_SESSION['login'])){
     header('Location: admin-login.php'); 
 }

    $sql = "SELECT * FROM document_request WHERE `status`='Accomplished'";
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
    <title>Online Document Request | Sarmiento Campus</title>
    <link rel="icon" href="img/logo.png" type="image/png">
</head>
<body>
    <main>

       <!----------HEADER-NAV-------->
       <?php include "html-parts/nav.php"?>
       

        <div class="admin-navigation">
            <ul>
                <li><a href="pending-request.php">Pending Request</a></li>
                <li><a href="accomplished-request.php">Accomplished Request</a></li>
                <li><a href="user-management.php?student=1">User Management</a></li>
            </ul>
        </div>
        
        <div class="table-container">
        <h1 class="title">ONLINE DOCUMENT REQUEST</h1>
            <div class="table-group" id = "request-table">
                
                <table id = "accomplished">
                <div id="theader">
                        <form class="example" method = "POST">
                            <div class="search">
                            <input type = "search" name = "search" placeholder="Reference ID" >
                            <button type="submit"><img class = "icon"src="img/search-white.png" alt="search"></button>
                            </div>
                            
                        </form>
                        <button title="Refresh-Page"class="refresh-btn"><a href="accomplished-request.php"><img class="refresh" src="img/refresh.jpg" alt="refresh"></a></button>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($_POST['search'])){

                             $filtervalues = $_POST['search'];
                             $sql = "SELECT * FROM document_request WHERE reference_id='$filtervalues'";
                             $result = mysqli_query($conn, $sql);
                             if(mysqli_num_rows($result)>0){
                                 $row = mysqli_fetch_assoc($result);
                                 $studentID = $row['student_number'];
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
                          
                            </tr>
                                <?php }else{echo "<p style='min-width:1850px' class ='no_result'>No Existing Request</p>";}?>
                        
                        <?php }elseif($pending-> num_rows>0){?>

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
                          
                            </tr>
                            <?php }?> 
                            <?php }else
                                echo "<p style='min-width:1850px'class ='no_result'>No Current Accomplished Request</p>";
                            ?>  
                    </tbody>
                        
                </table>
            </div>
        </div>




    </main>
   <!---------FOOTER-------->
    <?php include "html-parts/footer.php"?>

</body>
</html>
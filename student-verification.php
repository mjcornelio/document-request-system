<?php
session_start();
unset($_SESSION['nID']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a0806a35f6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Online Document Request | Sarmiento Campus</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
</head>
<body>
    <main>
        <nav>   
            <div class="container">
                <div class="logo">
                    <img src="img/logo.png" alt="logo">
                    <div class="logo-content">
                        <h2>BULACAN STATE UNIVERSITY</h2>
                        <h3>Sarmiento Campus</h3>
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="navigation" id="navigation">
                        <li id="exit"><a href="index.html" class="exit">Home</a></li>
                        <li><a href="student-verification.php">Request Form</a></li>
                        <li><a href="status-request.php">Request Status</a></li>
                        <li><a href="admin-login.php" id="admin">Admin Log in</a></li>
                    </ul>
                    <img src="img/menu.png" alt="menu" id="menu" onclick="dropdown()">
                </div>
            </div>
        </nav>
        <div class="form-container">
            <h1>ONLINE DOCUMENT REQUEST</h1>
            <div class="progresscontainer">
                <ul class="progressbar">
                    <li class="active">Verify</li>
                    <li>Fill up Information</li>
                    <li>Review your request</li>
                    <li>Finish</li>
                </ul>
            </div>
            <h3>VERIFY STUDENT</h3>
            <p id= "note">Note you need to verify first to process the request.</p>
            
            <form action="connections/verify.php" method="POST">
                <?php if(isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php }?>
                <label for="student-number">Student Number</label>
                <input type="text" name="student-number"  class="input-field" autocomplete="off">

                <label for="email-address">Email Address</label>
                <input type="email" name="email-address" class="input-field">

                <input type="submit" value="VERIFY" href="request-form-1.php">
                
            </form>
        </div>
    </main>
    
    <!---------FOOTER-------->
    <?php include "html-parts/footer.php"?>

    <script>
        function dropdown(){
            document.getElementById("navigation").classList.toggle("show");
        }
        sessionStorage.clear();

    </script>
    
</body>
</html>

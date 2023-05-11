<?php
  include_once "connection.php";
  if(isset($_POST['reference'])){
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Getting values passes from form in student-verification.php file
    $reference = validate($_POST['reference']);
   
 
    if(empty($reference)){
        header("location: ../status-request.php?error=Input Reference No.");
        exit();
    }else{
        $sql =  "SELECT * FROM `document_request` WHERE reference_ID = '$reference'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
            echo $row['status'];

            if($row['status'] ==="Pending"){
                header("location: status.php?pending=1");
            }elseif($row['status'] ==="Working"){
                header("location: status.php?working=1");
            }elseif($row['status'] ==="Accomplished"){
                header("location: status.php?accomplished=1");
            }elseif($row['status'] ==="Rejected"){
                header("location: status.php?rejected=1");
            }
            
             
        }else{
            header("location: ../status-request.php?error=Reference Number Doesn't match");
            exit();
        }
    }
}

if(isset($_GET['ok'])){
    header("location: ../index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a0806a35f6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">

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
                    <ul class="navigation" id="navigation">
                        <li id="exit"><a href="../index.html" class="exit">Home</a></li>
                        <li><a href="../student-verification.php">Request Form</a></li>
                        <li><a href="../status-request.php">Request Status</a></li>
                        <li><a href="../admin-login.php" id="admin">Admin Log in</a></li>
                    </ul>
                    <img src="../img/menu.png" alt="menu" id="menu" onclick="dropdown()">
                </div>
            </div>
        </nav>
        <div class="form-container status" style="margin-bottom: 80px;">
            <h1>ONLINE DOCUMENT REQUEST</h1>
            <h3>Request Status</h3>
            <form id="status-form">

                <?php if(isset($_GET['pending'])){
                    ?>
                    <img src="../img/pending.gif" class="gifs">
                    <?php
                    echo'<h3>Pending...</h3>
                    <p>Wait until one of the Registrar Personnel process your request.</p>';
                }elseif(isset($_GET['working'])){
                    ?>
                    <img src="../img/process.gif" class="gifs">
                    <?php
                    echo'<h3>Processing...</h3>
                    <p>Your request is currently on process. The document will be send through your provided email account.</p>';
                }elseif(isset($_GET['accomplished'])){
                    ?>
                        <img src="../img/send-icon.gif" class="gifs">
                    <?php
                    echo'<h3> Document Sent!</h3>
                    <p>Your document has been sent to you, Check your email account!</p>';
                }elseif(isset($_GET['rejected'])){
                    ?>
                    <img src="../img/reject.gif" class="gifs">
                    <?php
                    echo"<h3>Rejected!</h3>
                    <p>We're sorry, your request has been rejected</p>";
                }?>
                <input type="submit" name="ok"value="OK">
                </form>
            
        </div>
    </main>
    <footer>
        <div class="inner-footer">
            <h5>&copy; Coyright 2021| Bulacan State University</h5>
            <h5>Need Help? Contact the <a href="mailto:registrar.sarmiento@bulsu.edu.ph">
                Registrar's Office </a></h5>
        </div>
    </footer>

    <script>
        function dropdown(){
            document.getElementById("navigation").classList.toggle("show");
        }
    
    </script>
</body>
</html>
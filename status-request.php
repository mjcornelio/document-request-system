
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
        <div class="form-container" style="margin-bottom: 80px;">
            <h1>ONLINE DOCUMENT REQUEST</h1>
            <h3>Track Status</h3>
            <form action="connections/status.php"method="POST">
            <?php if(isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php }?>
                <label for="reference">Reference Number</label>
                <input type="text" name="reference"  class="input-field" autocomplete="off">
                
                <input type="submit" name="submit"value="TRACK">
                
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
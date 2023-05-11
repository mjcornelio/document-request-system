
<?php
session_start();
if (!isset($_SESSION['nID'])){
     header('Location: ../student-verification.php'); 
 }



error_reporting(0);
    include_once "connection.php";
    if(!empty($_POST["document"])){          
			$studentnumber = $_POST['student-number'];
			$fname = $_POST['first-name'];
			$lname = $_POST['last-name'];
			$mname = $_POST['middle-name'];
			$email = $_POST['email-address'];

			$yr_sem = $_POST['cor-rog'];
			$course = $_POST['course'];
			$yr_section = $_POST['yr-section'];
			$contact = $_POST['contact'];
			$address = $_POST['address'];
			$birthdate = $_POST['birthdate'];
			$convertdate = date("Y-m-d", strtotime($birthdate));
			$purpose = $_POST['purpose'];
           
            $documents = $_POST['document'];
			if(isset($_POST['submit'])){
                
                foreach($documents as $request){
                    $query = "SELECT * FROM `document_request` ORDER BY  `reference_ID` DESC limit 1";
                    $results = mysqli_query($conn,$query);
                    $rows = mysqli_fetch_array($results);
                    
                    
                    $lastid = $rows['reference_ID'];
                 
                    $ref_id = $lastid;
                    if($lastid == null){
                        $ref_id = 20222011;
                        
                    }else{
                        $ref_id = ($ref_id+1);
                    }
                    
                    if($request == 'COR' || $request == 'ROG' ||$request == 'COG'){ 
                        $sql =  "INSERT INTO document_request(`reference_id`,student_number, last_name, first_name, m_initial, email_address, `type_of_document`,`yr_sem`, `college_course`, `yr_section`,`contact`,`address`,`birthdate`, `purpose`, `status`) 
                        VALUES ('$ref_id','$studentnumber', '$lname', '$fname', '$mname', '$email', '$request','$yr_sem', '$course', '$yr_section','$contact', '$address', '$convertdate',  '$purpose', 'Pending')";
                    }else{
                        $sql =  "INSERT INTO document_request(`reference_id`,student_number, last_name, first_name, m_initial, email_address, `type_of_document`, `college_course`, `yr_section`,`contact`,`address`,`birthdate`, `purpose`, `status`) 
                        VALUES ('$ref_id','$studentnumber', '$lname', '$fname', '$mname', '$email', '$request', '$course', '$yr_section','$contact', '$address', '$convertdate',  '$purpose', 'Pending')";
                    }
                $run = mysqli_query($conn,$sql);
                
                }
                
			header("location: ../end-request.html");
			exit();
		}
    }elseif(isset($_POST['cancel'])){
            header("location: ../request-form-1.php");
        }

         $a=array();
         $query = "SELECT * FROM `document_request` ORDER BY  `reference_ID` DESC limit 1";
         $results = mysqli_query($conn,$query);
         $rows = mysqli_fetch_array($results);
            $lastid = $rows['reference_ID'];
            $ref_id = $lastid; 
            foreach($documents as $requests){
                if($ref_id == null){
                    $ref_id = 20222011;
                }else{
                    $ref_id = ($ref_id+1);
                }
                array_push($a, $ref_id); 
                    
            }
	    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a0806a35f6.js" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/request-form.css">

    <title>Online Document Request | Sarmiento Campus</title>
    <link rel="icon" href="../img/logo.png" type="image/png">
    <script defer type = "text/javascript">

        function preventBack() { window.history.forward(); }  
    setTimeout("preventBack()", 0);  
    window.onunload = function () { null };  
    </script>
    <script>
        var passedArray = <?php echo json_encode($a); ?>;
        sessionStorage.setItem("jsArray", JSON.stringify(passedArray));
  
    </script>
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
                        <li id="exit"><a href="index.html" class="exit" id="out">Home</a></li>
                        <li><a href="../student-verification.php" id="verify">Request Form</a></li>
                        <li><a href="../status-request.html" id="status">Request Status</a></li>
                        <li><a href="../admin-login.php" id="admin">Admin Log in</a></li>
                    </ul>
                    <img src="../img/menu.png" alt="menu" id="menu" onclick="dropdown()">
                </div>
            </div>
        </nav>
                <div class="form-container">
            <h1>ONLINE DOCUMENT REQUEST</h1>
            <div class="progresscontainer">
                <ul class="progressbar">
                    <li class="active">Verify</li>
                    <li class="active">Fill up Information</li>
                    <li class="active">Review your request</li>
                    <li>Finish</li>
                </ul>
            </div>
            <form method="POST">
				<?php if(isset($_GET['error'])) { ?>
                    <center><p class="error"><?php echo $_GET['error']; ?></p></center>
                <?php }?>
				
                
                <h3>OFFICE OF THE REGISTRAR REQUEST FORM</h3>
                <label for="student-number" >Student Number</label>
                <input type="text" name="student-number" required class="input-field" value="<?php echo $studentnumber;?>" readonly>

                <label for="first-name">First Name</label>
                <input type="text" name="first-name" required class="input-field" value="<?php echo $fname;?>"readonly>

                <label for="last-name">Last Name</label>
                <input type="text" name="last-name" required class="input-field" value="<?php echo $lname;?>"readonly>

                <label for="middle-name">Middle Name</label>
                <input type="text" name="middle-name" required class="input-field" value="<?php echo $mname;?>"readonly>

                <label for="email-address">Email Address</label>
                <input type="email" name="email-address" required class="input-field" value="<?php echo $email;?>"readonly>

		<label for="contact">Contact Number</label>
                <input type="text" name="contact" required class="input-field" value="<?php echo $contact;?>"readonly>
		
		<label for="address">Complete Address</label>
                <input type="text" name="address" required class="input-field" value="<?php echo $address;?>"readonly>

		<label for="birthdate">Date of Birth</label>
                <input type="date" name="birthdate" required class="input-field" value="<?php echo $birthdate;?>"readonly>

                <label for="course">Course Name</label>
                <input type="text" name="course" required class="input-field" value="<?php echo $course;?>"readonly>

                <label for="yr-section">Yr & Section</label>
                <input type="text" name="yr-section" class="input-field" value="<?php echo $yr_section;?>"readonly>     

                <label>Document to Request</label>
                  <?php
                foreach($documents as $requests){
                    
                        echo "<label class='checkb'><input type='checkbox' onclick='return false' checked name='document[]' value='".$requests."' class='box'>".$requests."</label>";
                } 
                    ?>
                <label for="cor-rog">For COR or ROG</label>
                <p>Kindly indicate the semester and academic 
                    year Example: 1st Sem A.Y. 2020-2021</p>
                <input type="text" name="cor-rog" required class="input-field" value="<?php echo $yr_sem;?>"readonly>
		
                <label for="purpose">Purpose of Request</label>
                <input type="text" name="purpose" required class="input-field" value="<?php echo $purpose;?>"readonly>
		

                <div class="button">
                        
                        <input type="submit" id="cancel" value="CANCEL" name="cancel" >
                        <input type="submit" name="submit"value="SUBMIT" id="checkBtn">
                        
                    
                    </div>
                
                
                
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
        document.getElementById("verify").onclick = function(e){
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Are you sure?',
                text: "Data inputted will not be saved!",
                icon: 'warning',
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
        document.getElementById("status").onclick = function(e){
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Are you sure?',
                text: "Data inputted will not be saved!",
                icon: 'warning',
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
        document.getElementById("admin").onclick = function(e){
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Are you sure?',
                text: "Data inputted will not be saved!",
                icon: 'warning',
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
            document.getElementById("out").onclick = function(e){
            e.preventDefault();
            const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Are you sure?',
                text: "Data inputted will not be saved!",
                icon: 'warning',
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
    </script>
    
    
</body>
</html>


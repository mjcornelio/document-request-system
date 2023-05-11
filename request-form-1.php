<?php 
   session_start();
   if (!isset($_SESSION['nID'])){
        header('Location: student-verification.php'); 
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
	<script type="text/javascript">
	$(document).ready(function () {
		$('#checkBtn').click(function() {
			checked = $("input[type=checkbox]:checked").length;

             sessionStorage.setItem("studentnumber", document.getElementById("student-number").value);
             sessionStorage.setItem("first-name", document.getElementById("first-name").value);
             sessionStorage.setItem("last-name", document.getElementById("last-name").value);
             sessionStorage.setItem("middle-name", document.getElementById("middle-name").value);
             sessionStorage.setItem("email-address", document.getElementById("email-address").value);
             sessionStorage.setItem("contact", document.getElementById("contact").value);
             sessionStorage.setItem("address", document.getElementById("address").value);
             sessionStorage.setItem("course", document.getElementById("course").value);
             sessionStorage.setItem("birthdate", document.getElementById("birthdate").value);
             sessionStorage.setItem("yr-section", document.getElementById("yr-section").value);
             sessionStorage.setItem("cor-rog", document.getElementById("cor-rog").value);
             sessionStorage.setItem("purpose", document.getElementById("purpose").value);
            
		if(!checked) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "You must checked atleast one document.",
                showConfirmButton: true,
                })

        return false;
      }

    });
    
    document.getElementById("student-number").value = sessionStorage.getItem("studentnumber");
    document.getElementById("first-name").value  = sessionStorage.getItem("first-name");
    document.getElementById("last-name").value = sessionStorage.getItem("last-name");
    document.getElementById("middle-name").value = sessionStorage.getItem("middle-name");
    document.getElementById("email-address").value = sessionStorage.getItem("email-address");
    document.getElementById("contact").value = sessionStorage.getItem("contact");
    document.getElementById("address").value = sessionStorage.getItem("address");
    document.getElementById("course").value = sessionStorage.getItem("course");
    document.getElementById("birthdate").value = sessionStorage.getItem("birthdate");
    document.getElementById("yr-section").value = sessionStorage.getItem("yr-section");
    document.getElementById("cor-rog").value = sessionStorage.getItem("cor-rog");
    document.getElementById("purpose").value = sessionStorage.getItem("purpose");
    });
   
  
	</script>
    <link rel="stylesheet" href="css/request-form.css">
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
                        <li id="exit"><a href="index.html" class="exit" id="out">Home</a></li>
                        <li><a href="student-verification.php" id="verify">Request Form</a></li>
                        <li><a href="status-request.php" id="status">Request Status</a></li>
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
                    <li class="active">Fill up Information</li>
                    <li>Review your request</li>
                    <li>Finish</li>
                </ul>
            </div>
            <form action="connections/request.php" method="POST">
				<?php if(isset($_GET['error'])) { ?>
                    <center><p class="error"><?php echo $_GET['error']; ?></p></center>
                <?php }?>
				
                <h3>OFFICE OF THE REGISTRAR REQUEST FORM</h3>
                <label for="student-number" >Student Number</label>
                <input type="text" name="student-number" id="student-number"required class="input-field" autocomplete="off">

                <label for="first-name">First Name</label>
                <input type="text" name="first-name" id="first-name"required class="input-field" autocomplete="off">

                <label for="last-name">Last Name</label>
                <input type="text" name="last-name" id="last-name"required class="input-field" autocomplete="off">

                <label for="middle-name">Middle Name</label>
                <input type="text" name="middle-name" id="middle-name"required class="input-field" autocomplete="off">

                <label for="email-address">Email Address</label>
                <input type="email" name="email-address" id="email-address"required class="input-field" autocomplete="off">

		<label for="contact">Contact Number</label>
                <input type="text" name="contact" id="contact"required class="input-field" autocomplete="off">
		
		<label for="address">Complete Address</label>
                <input type="text" name="address" id="address"required class="input-field" autocomplete="off">

		<label for="birthdate">Date of Birth</label>
                <input type="date" name="birthdate" id="birthdate"required class="input-field" autocomplete="off">
		
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

                <label for="yr-section">Yr & Section</label>
                <input type="text" name="yr-section" id="yr-section" class="input-field" autocomplete="off">     

                <label>Document to Request</label>
		<label class="checkb"><input type="checkbox" name="document[]" value="TOR" class="box">Transcript of Records (TOR)</label>
        <label class="checkb"><input type="checkbox" name="document[]" value="Honorable Dismissal" class="box">Honorable Dismissal</label>
		<label class="checkb"><input type="checkbox" name="document[]" value="COG" class="box">Certification of Grades (COG)</label>
		<label class="checkb"><input type="checkbox" name="document[]" value="Good Moral Certificate" class="box">Certificate of Good Moral Character</label>
		<label class="checkb"><input type="checkbox" name="document[]" value="Certificate of Graduation" class="box">Certificate of Graduation</label>
		<label class="checkb"><input type="checkbox" name="document[]" value="COR" class="box">Certificate of Registration (COR)</label>
		<label class="checkb"><input type="checkbox" name="document[]" value="ROG" class="box">Report of Grades (ROG)</label>

                <label for="cor-rog">For COR or ROG</label>
                <p>Kindly indicate the semester and academic 
                    year Example: 1st Sem A.Y. 2020-2021</p>
                <input type="text" name="cor-rog" id= "cor-rog"class="input-field" autocomplete="off">

                <label for="purpose">Purpose of Request</label>
                <input type="text" name="purpose" id="purpose" required class="input-field" autocomplete="off">

                <input type="submit" value="NEXT" id="checkBtn">
                
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
    <?php 
    if(isset($_GET['verify'])){ 
        $message = $_GET['verify'];
    }
    ?>
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
    <script>
         var message = "<?php echo $message?>";
        if(message==1){
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            }) 

            Toast.fire({
            icon: 'success',
            title: 'Verify successfully'
            })
            setTimeout(() => {
            document.location.href = "request-form-1.php"
        }, 1100);
        }
    </script>
  
    
</body>
</html>
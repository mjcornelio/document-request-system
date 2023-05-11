    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    </head>
    <body>
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
                    <ul>
                        <li><a href="admin-login.php" id="admin">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <script>
            document.getElementById("admin").onclick = function(e){
                e.preventDefault();
                const ahref = $(this).attr('href');
                Swal.fire({
                title: 'Log out',
                text: "Are you sure you want to Logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Log out'
                }).then((result) => {
                if (result.value) {
                   
                    document.location.href = ahref;
                   
                }
                })
             
                
            }
        </script>
    </body>
    </html>
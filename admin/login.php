<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Test Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h4>Mocktest</h4>
                            </div>
                            <h4>Hello! let's get started</h4>
                            <?php
                            if (isset($_SESSION['status'])) {
                                echo "<span class='text-danger'>" . $_SESSION['status'] . "</span>";
                                unset($_SESSION['status']);
                            }
                            if(isset($_SESSION['adminloggedin'])){
                                header('location: index.php');
                            }
                            ?>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" id="loginform">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username">
                                    <div class="usererror text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                                    <div class="passerror text-danger"></div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>

    <script>
        document.querySelector("#loginform").addEventListener('submit', function(e) {
            e.preventDefault();
            var valid = true;
            var username = document.querySelector("#username").value;
            var password = document.querySelector("#password").value;
            document.querySelector(".usererror").innerHTML = '';
            document.querySelector(".passerror").innerHTML = '';
            var validRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            // console.log(username.length)
            // console.log(validRegex.test(username))
            if (!validRegex.test(username)) {
                valid = false;
                document.querySelector(".usererror").innerHTML = "Please fill correct username";
            }
            if (password.length < 1) {
                valid = false;
                document.querySelector(".passerror").innerHTML = "Please fill correct password";
            }

            if (valid) {
                var form = document.querySelector("#loginform");
                var formData = new FormData(form);
                // console.log("Hi submit")
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "codes/process-login.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // console.log(xhr.response);
                            var resp = JSON.parse(xhr.response);
                            //  console.log(resp.status);
                            if (resp.success === 'logged') {
                                location.href = "index.php";
                            }
                            if (resp.error) {
                                alert(resp.error);
                            }

                        } else {
                            alert("Error ocuured");
                        }
                    }
                }
                xhr.send(formData);

            } else {
                console.log("nooo")
            }
        })
    </script>
    <!-- endinject -->
</body>

</html>
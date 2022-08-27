<?php
session_start();

include('connection.php');

if (isset($_POST['register'])) {

    if (isset($_POST['typeofuser']) && !empty($_POST['typeofuser'])) {

        $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $location = $_POST['location'];
                $description = $_POST['description'];
                $fullname = $_POST['fullname'];

        $emails = [];

        $query1 = "
          SELECT email from pharmacie
          UNION SELECT email from pharmacist
          UNION SELECT email from client
          UNION SELECT email from delivery
          UNION SELECT email from admin
        ";

        $result = mysqli_query($con, $query1);

        while ($row = mysqli_fetch_assoc($result)) {
            $emails[] = $row['email'];
        }
        

        if (!in_array($email, $emails)) {

            

            if ($_POST['typeofuser'] == 'client') {
                

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                //get all emails to be validated


                if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
                    } else {
                        $error_msg = "Sorry, there was an error uploading your file.";
                    }
                }


                $query = "insert into client (fname,lname,email,password,phone,image,location) values ('$fname','$lname','$email','$password','$phone','$profile_pic','$location')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['message'] = 'Your account is registered successfully';
                    header('Location: register.php');
                } else {
                    $_SESSION['message'] = 'Your account is not registered, try again !!!!';
                    header('Location: register.php');
                }
            } else if ($_POST['typeofuser'] == 'delivery') {
                $approved = 0;

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                //get all emails to be validated


                if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
                    } else {
                        $error_msg = "Sorry, there was an error uploading your file.";
                    }
                }


                $query = "insert into delivery (fname,lname,email,password,phone,image,approved,location) values ('$fname','$lname','$email','$password','$phone','$profile_pic','$approved','$location')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['message'] = 'Your account is registered successfully';
                    header('Location: register.php');
                } else {
                    $_SESSION['message'] = 'Your account is not registered, try again !!!!';
                    header('Location: register.php');
                }
            } else if ($_POST['typeofuser'] == 'pharmacie') {
                $approved = 0;

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                //get all emails to be validated


                if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
                    } else {
                        $error_msg = "Sorry, there was an error uploading your file.";
                    }
                }


                $query = "insert into pharmacie (fname,lname,email,password,phone,image,approved,location,description) values ('$fullname','$lname','$email','$password','$phone','$profile_pic','$approved','$location','$description')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['message'] = 'Your account is registered successfully';
                    header('Location: register.php');
                } else {
                    $_SESSION['message'] = 'Your account is not registered, try again !!!!';
                    header('Location: register.php');
                }
            } else {
                //pharmacist
                $approved = 0;

                $target_dir = "uploads/";
                $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

                //get all emails to be validated


                if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
                    } else {
                        $error_msg = "Sorry, there was an error uploading your file.";
                    }
                }


                $query = "insert into pharmacist (fname,lname,email,password,phone,image,approved,location) values ('$fname','$lname','$email','$password','$phone','$profile_pic','$approved','$location')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['message'] = 'Your account is registered successfully';
                    header('Location: register.php');
                } else {
                    $_SESSION['message'] = 'Your account is not registered, try again !!!!';
                    header('Location: register.php');
                }
            }
        }
        else{
            $_SESSION['message'] = 'Email already in use!!';
            header('Location: register.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>EL-TreaQ &mdash;</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

    <style>
        .pharmacie, .notpharmacie {
            display: none;
        }

        .modal-open .modal {
  z-index: 10000 !important;
  margin-top: 70px !important;
}
    </style>

</head>

<body>

    <div class="site-wrap">


        <div class="site-navbar py-2">



            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <a href="#" class="js-logo-clone"><strong class="text-primary">EL-Trea</strong>Q</a>
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li class="active"><a href="#">Home</a></li>
                                
                            </ul>
                        </nav>
                    </div>
                    <div class="icons">
                        <a href="login.php" ><span>Login</span></a>
                        <a href="register.php" class="ml-2"><span>Register</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="#">Home</a> <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Register</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">Register</h2>
                    </div>
                    <div class="col-md-12">

                        <form action="register.php" method="post" enctype="multipart/form-data">
                
                            <div class="p-3 p-lg-5 border">

                                <?php
                                if(isset($_SESSION['message'])){
                                    echo '<div class="alert alert-success" role="alert">
                                    '.$_SESSION['message'].'
                                  </div>';
                                }
                                
                                ?>

                                <div class="form-group row" id="type_of_user">
                                    <label class="text-black m-3">Type Of User</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeofuser" id="inlineRadio1" required value="client">
                                        <label class="form-check-label text-black" for="inlineRadio1">Client</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeofuser" id="inlineRadio2" required value="pharmacie">
                                        <label class="form-check-label text-black" for="inlineRadio2">Pharmacie</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeofuser" id="inlineRadio3" required value="pharmacist">
                                        <label class="form-check-label text-black" for="inlineRadio3">pharmacist</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="typeofuser" id="inlineRadio4" required value="delivery">
                                        <label class="form-check-label text-black" for="inlineRadio4">Delivery</label>
                                    </div>
                                </div>
                                <div class="form-group row notpharmacie">
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_fname" name="fname">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_lname" name="lname">
                                    </div>
                                </div>
                                <div class="form-group row pharmacie">
                                    <div class="col-md-6">
                                        <label for="fullname" class="text-black">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fullname" name="fullname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="phone" name="phone" placeholder="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="c_email" name="email" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="password" class="text-black">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="image" class="text-black">Profile Photo </label>
                                        <input type="file" class="form-control" id="image" name="fileToUpload" required>
                                    </div>
                                </div>

                                <div class="form-group row pharmacie">
                                    <div class="col-md-12">
                                        <label for="description" class="text-black">Description </label>
                                        <textarea name="description" id="description" cols="30" rows="7" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="location" class="text-black">Location<span class="text-danger">*</span> </label>
                                        <textarea name="location" required id="location" cols="30" rows="7" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="register" value="Register">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <footer class="site-footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">

                        <div class="block-7">
                            <h3 class="footer-heading mb-4">About <strong class="text-primary">EL-TreaQ</strong></h3>
                            <p>An online pharmacy, internet pharmacy, or mail-order pharmacy is a pharmacy that operates over the Internet and sends orders to customers through mail, shipping companies, or online pharmacy web portal.</p>
                        </div>

                    </div>
                    <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
                        <h3 class="footer-heading mb-4">Navigation</h3>
                        <ul class="list-unstyled">
                            <li><a href="#">Drugs</a></li>
                            <li><a href="#">Supplements</a></li>
                            <li><a href="#">Vitamins</a></li>
                            <li><a href="#">Proteins</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address">Cover all Egypt region</li>
                                <li class="phone"><a href="tel://12345678901">+12345678901</a></li>
                                <li class="email">info@elterayq.com</li>
                            </ul>
                        </div>


                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | <a href="#" target="_blank" class="text-primary">EL-TreaQ</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>

    <script>
        $("#type_of_user").on('change', function(e) {
            var type_of_user = $("#" + e.target.id).val();

            if (type_of_user == 'pharmacie') {
                $('.pharmacie').css('display', 'block');
                $('.notpharmacie').css('display', 'none');
            } else {
                $('.pharmacie').css('display', 'none');
                $('.notpharmacie').css('display', 'block');
            }
        });
    </script>

</body>

</html>

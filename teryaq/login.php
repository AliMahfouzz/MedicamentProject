<?php
session_start();

include('connection.php');

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password)){
        $query = "select * from pharmacie where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

    
        if ($result) {
          if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] === $password && (int)$user_data['approved'] == 1) {
              $_SESSION['username'] = $user_data['fname'].' '.$user_data['lname'];
              $_SESSION['userid'] = $user_data['idpharmacie'];
              $_SESSION['usertype'] = 'pharmacie';
              header('Location: viewproducts.php');
              die;
            } else {
              $_SESSION['error_message'] =  "Your account is disabled!";
            }
          }
          else{
            $query = "select * from pharmacist where email = '$email' limit 1";
            $result = mysqli_query($con, $query);
        
            if ($result) {
              if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password && (int)$user_data['approved'] == 1) {
                    $_SESSION['username'] = $user_data['fname'].' '.$user_data['lname'];
                    $_SESSION['userid'] = $user_data['idpharmacist'];
                    $_SESSION['usertype'] = 'pharmacist';
                  header('Location: viewproducts.php');
                  die;
                } else {
                  $_SESSION['error_message'] =  "Your account is disabled!";
                }
              }
              else{
                $query = "select * from delivery where email = '$email' limit 1";
                $result = mysqli_query($con, $query);
            
                if ($result) {
                  if ($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if ($user_data['password'] === $password && (int)$user_data['approved'] == 1) {
                        $_SESSION['username'] = $user_data['fname'].' '.$user_data['lname'];
                        $_SESSION['userid'] = $user_data['iddelivery'];
                        $_SESSION['usertype'] = 'delivery';
                      header('Location: viewproducts.php');
                      die;
                    } else {
                      $_SESSION['error_message'] =  "Your account is disabled!";
                    }
                  }
                  else{
                    $query = "select * from admin where email = '$email' limit 1";
                    $result = mysqli_query($con, $query);
                
                    if ($result) {
                      if ($result && mysqli_num_rows($result) > 0) {
                        $user_data = mysqli_fetch_assoc($result);
                        if ($user_data['password'] === $password) {
                            $_SESSION['username'] = $user_data['fname'].' '.$user_data['lname'];
                            $_SESSION['userid'] = $user_data['idadmin'];
                            $_SESSION['usertype'] = 'admin';
                          header('Location: viewproducts.php');
                          die;
                        } else {
                          $_SESSION['error_message'] =  "Your account is disabled!";
                        }
                      }
                      else{
                        $query = "select * from client where email = '$email' limit 1";
                        $result = mysqli_query($con, $query);
                    
                        if ($result) {
                          if ($result && mysqli_num_rows($result) > 0) {
                            $user_data = mysqli_fetch_assoc($result);
                            if ($user_data['password'] === $password) {
                                $_SESSION['username'] = $user_data['fname'].' '.$user_data['lname'];
                                $_SESSION['userid'] = $user_data['idclient'];
                                $_SESSION['usertype'] = 'client';
                              header('Location: viewproducts.php');
                              die;
                            } else {
                              $_SESSION['error_message'] =  "Your account is disabled!";
                            }
                          }
                          else{
                            $_SESSION['error_message'] =  "Wrong username or password!";
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
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
        .pharmacie {
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
                                <li><a href="#">Home</a></li>
                               
                            </ul>
                        </nav>
                    </div>
                    <div class="icons">
                        <a href="login.php" class="active" ><span>Login</span></a>
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
                        <strong class="text-black">Login</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">Login</h2>
                    </div>
                    <div class="col-md-12">

                        <form action="login.php" method="post" enctype="multipart/form-data">
                
                            <div class="p-3 p-lg-5 border">

                                <?php
                                if(isset($_SESSION['error_message'])){
                                    echo '<div class="alert alert-success" role="alert">
                                    '.$_SESSION['error_message'].'
                                  </div>';
                                }
                                
                                ?>

                                <div class="form-group row">
                                    <div class="col-md-12">
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
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="login" value="Login">
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


</body>

</html>

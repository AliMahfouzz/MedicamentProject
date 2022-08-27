<?php
session_start();

include('connection.php');

if (isset($_POST["submit"])) {
    $qname = $_POST["qname"];
    $qdescription = $_POST["qdescription"];

    $idusers = $_SESSION["userid"];

    $target_dir = "uploads/";
    $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

    $profile_pic = "";

    if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
        } else {
            $error_msg = "Sorry, there was an error uploading your file.";
        }
    }


    $query = "insert into question (qname,qdescription,qfile,idusers) values ('$qname','$qdescription','$profile_pic','$idusers')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['question_message'] = 'Your question is sent successfully';
        header('Location: askquestion.php');
    } else {
        $_SESSION['question_message'] = 'Your question is not sent yet, try again !!!!';
        header('Location: askquestion.php');
    }
    
    //echo var_dump($_POST);

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
                    <?php
                    if ($_SESSION['usertype'] == 'client') {
                        include('clientnavbar.php');
                    } else if ($_SESSION['usertype'] == 'admin') {
                        include('adminnavbar.php');
                    } else if ($_SESSION['usertype'] == 'pharmacie') {
                        include('pharmacienavbar.php');
                    } else if ($_SESSION['usertype'] == 'delivery') {
                        include('deliverynavbar.php');
                    } else {
                        include('pharmacistnavbar.php');
                    }

                    ?>
                </div>
            </div>
        </div>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="#">Home</a> <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Ask a Question</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">Ask a question</h2>
                    </div>
                    <div class="col-md-12">
                        <?php
                            if(isset($_SESSION['question_message'])){
                                echo '
                                <div class="alert alert-success" role="alert">
                                    '.
                                    $_SESSION['question_message']
                                    .'
                                </div>
                                ';
                            }
                        ?>
                        <form method="POST" action="askquestion.php" enctype="multipart/form-data">
                            <div class="p-3 p-lg-5 border">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="qname" class="text-black">Question Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="qname" name="qname" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="qdescription" class="text-black">Question Description <span class="text-danger">*</span></label>
                                        <textarea name="qdescription" id="qdescription" cols="30" rows="7" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="image" class="text-black">File To Upload </label>
                                        <input type="file" class="form-control" id="image" name="fileToUpload">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Send">
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
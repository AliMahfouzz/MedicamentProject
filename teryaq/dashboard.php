<?php
session_start();

include('connection.php');

$xvalues = [];
$yvalues = [];

if ($_SESSION['usertype'] == 'client') {
    $query = "SELECT coalesce(count(*),0) as questions, (select count(*) from question) as total from question where idusers = '".$_SESSION["userid"]."'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $yvalues = [$row["questions"] , $row["total"]];
    }

    $xvalues = ["Your Questions", "Total Questions"];
} else if ($_SESSION['usertype'] == 'admin') {
    $query = "SELECT coalesce(count(*),0) as questions, (select count(*) from question) as total from question where response= 1";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $yvalues = [$row["questions"] , $row["total"]];

    }

    $xvalues = ["Replied Questions", "Total Questions"];
} else if ($_SESSION['usertype'] == 'pharmacie') {
    $query = "SELECT  coalesce(count(*),0) as orders,(select count(*) from orders) as total  FROM orders o left join product p on p.idproduct = o.idproduct left join pharmacie ph on ph.idpharmacie = p.idpharmacy where p.idpharmacy = '".$_SESSION["userid"]."'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $yvalues = [$row["orders"] , $row["total"]];

    }

    $xvalues = ["Your Ordered Products", "Total Orders"];

} else if ($_SESSION['usertype'] == 'delivery') {
    $query = "SELECT coalesce(count(*),0) as orders, (select count(*) from orders) as total from orders where assigned_to = '".$_SESSION["userid"]."'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $yvalues = [$row["orders"] , $row["total"]];

    }

    $xvalues = ["Your Assigned Orders", "Total Orders"];

} else {
    //pharamcist
    $query = "SELECT coalesce(count(*),0) as questions, (select count(*) from question) as total from question where replied_user = '".$_SESSION["userid"]."'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $yvalues = [$row["questions"] , $row["total"]];
    }

    $xvalues = ["Your Replied Questions", "Total Questions"];

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
                        if($_SESSION['usertype'] == 'client'){
                            include('clientnavbar.php');
                        }
                        else if($_SESSION['usertype'] == 'admin'){
                            include('adminnavbar.php');
                        }
                        else if($_SESSION['usertype'] == 'pharmacie'){
                            include('pharmacienavbar.php');
                        }
                        else if($_SESSION['usertype'] == 'delivery'){
                            include('deliverynavbar.php');
                        }
                        else{
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
                        <strong class="text-black">Dashboard</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">Dashboard</h2>
                    </div>
                    <div class="col-md-12">
                        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>


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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>

    <script>
        var xValues = new Array();
    <?php foreach($xvalues as $key => $val){ ?>
        xValues.push('<?php echo $val; ?>');
    <?php } ?>

    var yValues = new Array();
    <?php foreach($yvalues as $key => $val){ ?>
        yValues.push('<?php echo $val; ?>');
    <?php } ?>

var barColors = [
    'rgb(255, 99, 132)',
    'rgb(54, 162, 235)',
    // 'rgb(255, 205, 86)'
];


        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                title: {
                display: true,
                text: "World Wide Wine Production"
                }
            }
            });
    </script>

</body>

</html>

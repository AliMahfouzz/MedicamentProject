<?php
session_start();

include('connection.php');

//get all pharmacies accounts
$pharmaciesquery = "select * from pharmacie";
$pharmacies = mysqli_query($con, $pharmaciesquery);

//get all pharmacists accounts
$pharmacistsquery = "select * from pharmacist";
$pharmacists = mysqli_query($con, $pharmacistsquery);

//get all delivery accounts
$deliveryquery = "select * from delivery";
$deliveries = mysqli_query($con, $deliveryquery);



include('approveaccount.php');
include('cancelaccount.php');


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
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dataTables.bootstrap4.min.css">


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
        /* .container-acc {
  max-width: 960px;
} */


        /* */

        .panel-default>.panel-heading {
            color: #333;
            background-color: #fff;
            border-color: #e4e5e7;
            padding: 0;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .panel-default>.panel-heading a {
            display: block;
            padding: 10px 15px;
        }

        .panel-default>.panel-heading a:after {
            content: "";
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            float: right;
            transition: transform .25s linear;
            -webkit-transition: -webkit-transform .25s linear;
        }

        .panel-default>.panel-heading a[aria-expanded="true"] {
            background-color: #eee;
        }

        .panel-default>.panel-heading a[aria-expanded="true"]:after {
            content: "\2212";
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .panel-default>.panel-heading a[aria-expanded="false"]:after {
            content: "\002b";
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
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
                        <strong class="text-black">All Accounts</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">All Accounts</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="container-acc">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Pharmacies Accounts
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <div class="table-responsive">

                                                <table class="table table-striped datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Location</th>
                                                            <th>Description</th>
                                                            <th>Profile Image</th>
                                                            <th>Status</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysqli_fetch_array($pharmacies)) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row['idpharmacie'] ?></td>
                                                                <td><?php echo $row['fname'] . ' ' . $row['lname'] ?></td>
                                                                <td><?php echo $row['email'] ?></td>
                                                                <td><?php echo $row['phone'] ?></td>
                                                                <td><?php echo $row['location'] ?></td>
                                                                <td><?php echo $row['description'] ?></td>
                                                                <td><img src=<?php echo "./uploads/" . $row['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></td>
                                                                <?php
                                                                 if($row['approved'] == 2){
                                                                    echo '<td><span class="badge badge-danger">Cancelled</span>
                                                                    </td><td></td>';
                                                                }
                                                                else if ($row['approved'] != 1) {
                                                                    echo '<td><button class="btn btn-warning" type="button" disabled>
                                                                    <i class="fa fa-spinner fa-pulse"></i>Pending
                                                                    </button></td>';
                                                                    echo '<td>
                                                                    <button type="button" class="btn btn-danger cancelaccount0"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                                                                                <button type="button" class="btn btn-success approvebtn0"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                                                                            </td>';
                                                                } else {
                                                                    echo '<td><span class="badge badge-success">Approved</span>
                                                                                    </td><td></td>';
                                                                }
                                                                ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Pharmacists Accounts
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <div class="table-responsive">

                                                <table class="table table-striped datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Profile Image</th>
                                                            <th>Status</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row2 = mysqli_fetch_array($pharmacists)) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row2['idpharmacist'] ?></td>
                                                                <td><?php echo $row2['fname'] . ' ' . $row2['lname'] ?></td>
                                                                <td><?php echo $row2['email'] ?></td>
                                                                <td><?php echo $row2['phone'] ?></td>
                                                                <td><img src=<?php echo "./uploads/" . $row2['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></td>
                                                                <?php
                                                                 if($row2['approved'] == 2){
                                                                    echo '<td><span class="badge badge-danger">Cancelled</span>
                                                                    </td><td></td>';
                                                                }
                                                                else if ($row2['approved'] != 1) {
                                                                    echo '<td><button class="btn btn-warning" type="button" disabled>
                                                                    <i class="fa fa-spinner fa-pulse"></i>Pending
                    </button></td>';
                                                                    echo '<td>
                                                                    <button type="button" class="btn btn-danger cancelaccount1"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                                <button type="button" class="btn btn-success approvebtn1"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                            </td>';
                                                                } else {
                                                                    echo '<td><span class="badge badge-success">Approved</span>
                                    </td><td></td>';
                                                                }
                                                                ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Delivery Accounts
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <div class="table-responsive">

                                                <table class="table table-striped datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Profile Image</th>
                                                            <th>Status</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row3 = mysqli_fetch_array($deliveries)) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row3['iddelivery'] ?></td>
                                                                <td><?php echo $row3['fname'] . ' ' . $row3['lname'] ?></td>
                                                                <td><?php echo $row3['email'] ?></td>
                                                                <td><?php echo $row3['phone'] ?></td>
                                                                <td><img src=<?php echo "./uploads/" . $row3['image'] ?> alt="" style="width: 50%; border: 1px solid #cda45e;"></td>
                                                                <?php
                                                                if($row3['approved'] == 2){
                                                                    echo '<td><span class="badge badge-danger">Cancelled</span>
                                                                    </td><td></td>';
                                                                }
                                                                else if ($row3['approved'] != 1) {
                                                                    echo '<td><button class="btn btn-warning" type="button" disabled>
                                                                    <i class="fa fa-spinner fa-pulse"></i>Pending
                    </button></td>';
                                                                    echo '<td>
                                                                    <button type="button" class="btn btn-danger cancelaccount2"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                                <button type="button" class="btn btn-success approvebtn2"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                            </td>';
                                                                } 
                                                                else {
                                                                    echo '<td><span class="badge badge-success">Approved</span>
                                    </td><td></td>';
                                                                }
                                                                ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
    <script src="jquery.dataTables.min.js"></script>
    <script src="dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".datatables").DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.approvebtn0').on('click', function() {

                $('#approvemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#p_id').val(data[0].replaceAll(' ', ''));
                $('#ps_id').val('');
                $('#d_id').val('');
                $('#approvemodalLabel').html('Approve Pharmacie Account');

            });
        });
    </script>


<script>
        $(document).ready(function() {

            $('.cancelaccount0').on('click', function() {

                $('#cancelaccountmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#p_id0').val(data[0].replaceAll(' ', ''));
                $('#ps_id0').val('');
                $('#d_id0').val('');
                $('#cancelaccountmodalLabel').html('Cancel Pharmacie Account');

            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.approvebtn1').on('click', function() {

                $('#approvemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#ps_id').val(data[0].replaceAll(' ', ''));
                $('#d_id').val('');
                $('#p_id').val('');
                $('#approvemodalLabel').html('Approve Pharmacist Account');


            });
        });
    </script>

<script>
        $(document).ready(function() {

            $('.cancelaccount1').on('click', function() {

                $('#cancelaccountmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#ps_id0').val(data[0].replaceAll(' ', ''));
                $('#d_id0').val('');
                $('#p_id0').val('');
                $('#cancelaccountmodalLabel').html('Cancel Pharmacist Account');


            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.approvebtn2').on('click', function() {

                $('#approvemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);
                $('#ps_id').val('');
                $('#p_id').val('');
                $('#d_id').val(data[0].replaceAll(' ', ''));
                $('#approvemodalLabel').html('Approve Delivery Account');


            });
        });
    </script>
    
    <script>
        $(document).ready(function() {

            $('.cancelaccount2').on('click', function() {

                $('#cancelaccountmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);
                $('#ps_id0').val('');
                $('#p_id0').val('');
                $('#d_id0').val(data[0].replaceAll(' ', ''));
                $('#cancelmodalLabel').html('Cancel Delivery Account');


            });
        });
    </script>

    <script>
    function hourglass() {
        var a;
        a = document.getElementById("div1");
        a.innerHTML = "&#xf251;";
        setTimeout(function () {
            a.innerHTML = "&#xf252;";
            }, 1000);
        setTimeout(function () {
            a.innerHTML = "&#xf253;";
            }, 2000);
    }
    hourglass();
    setInterval(hourglass, 3000);
    </script>

</body>

</html>
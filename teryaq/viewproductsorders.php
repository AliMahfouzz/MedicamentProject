<?php
session_start();

include('connection.php');
include("assignordertodelivery.php");
include("approveorder.php");
include("cancelorder.php");


if ($_SESSION['usertype'] == 'client') {
    $query = "SELECT *, CONCAT(c.fname, ' ', c.lname) as client_name, CONCAT(d.fname, ' ', d.lname) as delivery_name FROM orders o 
    left join product p on p.idproduct = o.idproduct
    left join client c on  c.idclient = o.idusers
    left join pharmacie ph on ph.idpharmacie = o.idpharmacy
    left join delivery d on d.iddelivery = o.assigned_to
    Where c.idclient = '" . $_SESSION["userid"] . "'";
    $result = mysqli_query($con, $query);
} else if ($_SESSION['usertype'] == 'admin') {
    $query = "SELECT *, CONCAT(c.fname, ' ', c.lname) as client_name, CONCAT(d.fname, ' ', d.lname) as delivery_name FROM orders o 
    left join product p on p.idproduct = o.idproduct
    left join client c on  c.idclient = o.idusers
    left join pharmacie ph on ph.idpharmacie = o.idpharmacy
    left join delivery d on d.iddelivery = o.assigned_to";
    $result = mysqli_query($con, $query);
} else if ($_SESSION['usertype'] == 'pharmacie') {
    $query = "SELECT *, CONCAT(c.fname, ' ', c.lname) as client_name, CONCAT(d.fname, ' ', d.lname) as delivery_name FROM orders o 
    left join product p on p.idproduct = o.idproduct
    left join client c on  c.idclient = o.idusers
    left join pharmacie ph on ph.idpharmacie = o.idpharmacy
    left join delivery d on d.iddelivery = o.assigned_to
    WHERE ph.idpharmacie = '" . $_SESSION["userid"] . "'";
    $result = mysqli_query($con, $query);
} else if ($_SESSION['usertype'] == 'delivery') {
    $query = "SELECT *, CONCAT(c.fname, ' ', c.lname) as client_name, CONCAT(d.fname, ' ', d.lname) as delivery_name FROM orders o 
    left join product p on p.idproduct = o.idproduct
    left join client c on  c.idclient = o.idusers
    left join pharmacie ph on ph.idpharmacie = o.idpharmacy
    left join delivery d on d.iddelivery = o.assigned_to
    WHERE o.assigned_to = '" . $_SESSION["userid"] . "'";
    $result = mysqli_query($con, $query);
} else {
    header('Location: viewproducts.php');
    exit();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>El Trea-Q &mdash;</title>
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
        .defin i {
            margin-right: 10px;
        }

        .defin {
            color: #75b239;
        }

        .text-primary-order {
            color: #75b239;
            font-weight: bold;
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
                        <strong class="text-black">View Orders</strong>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section bg-white">
            <div class="container">
                <div class="table-responsive">

                <table class="table table-striped" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Price</th>
                            <th>Delivery Price</th>
                            <th>Pharmacy Name</th>
                            <th>Pharmacy locations</th>
                            <th>Client Name</th>
                            <th>Client Payment Type</th>
                            <th>Delivery User Name</th>
                            <th>Delivered</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo '
                                <tr>';
                            echo '<td>' . $row["idorders"] . '</td>';
                            echo '<td>' . $row["pname"] . '</td>
                                    <td>' . $row["pdescription"] . '</td>
                                    <td>' . $row["pprice"] . '</td>
                                    <td>20 L.E.</td>
                                    <td>' . $row["fname"] . '</td>
                                    <td>' . $row["location"] . '</td>
                                    <td>' . $row["client_name"] . '</td>
                                    <td>' . $row["ordertype"] . '</td>
                                    <td>' . $row["delivery_name"] . '</td>
                                    ';

                            if ($row['delivered'] != 1 && $row['delivered'] != 2) {
                                echo '<td><button class="btn btn-warning" type="button" disabled>
                                        <i class="fa fa-spinner fa-pulse"></i>Pending
</button></td>';
                                if ($_SESSION['usertype'] == 'admin') {
                                    echo '<td>
                                    <button type="button" class="btn btn-danger cancelorder"> <i class="fa fa-times" aria-hidden="true"></i> </button>
    <button type="button" class="btn btn-success approvebtn5"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
</td>';
                                }
                                else if($_SESSION['usertype'] == 'delivery'){
                                    echo '<td>
                                    <button type="button" class="btn btn-success approvebtn6"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                                </td>';
                                }
                                else{
                                    echo '<td></td>';
                                }
                            } 
                            else if($row['delivered'] == 2){
                                echo '<td><span class="badge badge-danger">Cancelled</span>
                                </td><td></td>';
                            }
                            else {
                                echo '<td><span class="badge badge-success">Delivered</span>
        </td><td></td>';
                            }

                            echo '</tr>
                                ';
                        }
                        ?>
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
    <?php include('footer.php')?>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="jquery.dataTables.min.js"></script>
    <script src="dataTables.bootstrap4.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $("#datatables").DataTable();
        })
    </script>

    <script>
        $(document).ready(function() {

            $('.approvebtn5').on('click', function() {

                $('#approvemodal5').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#o_id').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>

<script>
        $(document).ready(function() {

            $('.approvebtn6').on('click', function() {

                $('#approvemodal6').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#o_id2').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>


<script>
        $(document).ready(function() {

            $('.cancelorder').on('click', function() {

                $('#cancelordermodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                //console.log(data);

                $('#o_id3').val(data[0].replaceAll(' ', ''));
            });
        });
    </script>

</body>

</html>
<?php
session_start();

include('connection.php');

$idproduct = $_GET["idproduct"];

//echo $idproduct;


if ($_SESSION['usertype'] == 'client') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idproduct = '" . $idproduct . "'";
} else if ($_SESSION['usertype'] == 'admin') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idproduct = '" . $idproduct . "'";
} else if ($_SESSION['usertype'] == 'pharmacie') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idproduct = '" . $idproduct . "' AND p.idpharmacy = '" . $_SESSION["userid"] . "'";
} else if ($_SESSION['usertype'] == 'delivery') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idproduct = '" . $idproduct . "'";
} else {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idproduct = '" . $idproduct . "'";
}


$result = mysqli_query($con, $query);


if (isset($_POST["submit"])) {
    //echo var_dump($_POST);
    $ordertype = $_POST['ordertype'];

    $query = "INSERT INTO orders(idproduct, idpharmacy, idusers,ordertype) VALUES('" . $_POST["idproduct"] . "', '" . $_POST["idpharmacy"] . "', '" . $_SESSION["userid"] . "', '".$ordertype."')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION["orders_message"] = "Your order has been sent";
        header('Location: product.php?idproduct=' . $_POST["idproduct"]);
        exit();
    } else {
        $_SESSION["orders_message"] = "Your order has not been sent";
        header('Location: product.php?idproduct=' . $_POST["idproduct"]);
        exit();
    }
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

        .card-bounding {
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            /* top:50%; */
            /* transform: translateY(-50%); */
            padding: 30px;
            border: 1px solid #75b239;
            border-radius: 6px;
            font-family: 'Roboto';
            background: #ffffff;
        }

        .card-bounding aside {
            font-size: 24px;
            padding-bottom: 8px;
        }

        .card-container {
            width: 100%;
            padding-left: 80px;
            padding-right: 40px;
            position: relative;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 0 auto 30px auto;
        }

        .card-container input {
            width: 100%;
            letter-spacing: 1px;
            font-size: 30px;
            padding: 15px 15px 15px 25px;
            border: 0;
            outline: none;
            box-sizing: border-box;
        }

        .card-type {
            width: 80px;
            height: 56px;
            background: url("cards.png");
            background-position: 0 -291px;
            background-repeat: no-repeat;
            position: absolute;
            top: 3px;
            left: 4px;
        }

        .card-type.mastercard {
            background-position: 0 0;
        }

        .card-type.visa {
            background-position: 0 -115px;
        }

        .card-type.amex {
            background-position: 0 -57px;
        }

        .card-type.discover {
            background-position: 0 -174px;
        }

        .card-valid {
            position: absolute;
            top: 0;
            right: 15px;
            line-height: 60px;
            font-size: 40px;
            font-family: 'icons';
            color: #ccc;
        }

        .card-valid.active {
            color: green;
        }

        .card-details {
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
            transition: 300ms ease;
        }

        .card-details input {
            font-size: 30px;
            padding: 15px;
            box-sizing: border-box;
            width: 100%;
        }

        .card-details input.error {
            border: 1px solid #75b239;
            box-shadow: 0 4px 8px 0 rgba(238, 76, 87, 0.3);
            outline: none;
        }

        .card-details .expiration {
            width: 50%;
            float: left;
            padding-right: 5%;
        }

        .card-details .cvv {
            width: 45%;
            float: left;
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
                        <strong class="text-black">View Products</strong>
                    </div>
                </div>
            </div>
        </div>




        <div class="site-section bg-light">
            <div class="container">

                <?php
                if (isset($_SESSION["orders_message"])) {
                    echo '<div class="alert alert-success">' .
                        $_SESSION["orders_message"]
                        . '
                    </div>';
                }

                ?>

                <form method="POST" enctype="multipart/form-data" action="product.php">
                   

                    <input type="hidden" id="idproduct" value="<?php echo $idproduct ?>" name="idproduct" />
                    <div class="row" id="products">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo '
                            <input type="hidden" id="idpharmacy" value="' . $row["idpharmacy"] . '" name="idpharmacy"/>
                    <div class="col-sm-6 col-lg-6 text-center item mb-4 item-v2">
                        <span class="onsale">Sale</span>
                        <a href="product.php?idproduct=' . $row["idproduct"] . '"> 
                        <img src="./uploads/' . $row["pimage"] . '" alt="Image" width="200px" height="200px">
                        </a>
                            <h3 class="text-dark"><a href="product.php?idproduct=' . $row["idproduct"] . '">' . $row["pname"] . '</a></h3>
                        <p>
                            <span class="defin"><i class="fa fa-list-alt"></i></span><span class="text-primary-order">Description: </span>' . $row["pdescription"] . '
                        </p>
                        <p>
                            <span class="defin"><i class="fa fa-id-card"></i></span><span class="text-primary-order">Pharmacy Name: </span>' . $row["pname"] . '
                        </p>
                        <p>
                            <span class="defin"><i class="fa fa-location-arrow"></i></span><span class="text-primary-order">Pharmacy Locations: </span>' . $row["location"] . '
                        </p>
                        <p>
                            <span class="defin"><i class="fa fa-phone"></i></span><span class="text-primary-order">Pharmacy phone: </span>' . $row["phone"] . '
                        </p>
                        <p class="price">' . $row["pprice"] . '<span class="text-primary ml-1"> L.E. </span></p>
                        <p class="price">Delivery Fees: 20<i class="text-primary ml-1"> L.E. </i></p>
                    </div>';
                        }
                        echo '
                    <div class="col-sm-6 col-lg-6 text-center item mb-4 item-v2">
                    <div class="row m-2">

                    <select name="ordertype" class="form-control col-md-6" id="dropdown">
                        <option value="cash">Cash</option>
                        <option value="visa">Visa Card</option>
                    </select>
                    </div>
                    <div class="card-bounding" id="visa" style="display:none;">
                          
                    <aside>Card Number:</aside>
                            <div class="card-container">
                            <!--- ".card-type" is a sprite used as a background image with associated classes for the major card types, providing x-y coordinates for the sprite --->
                            <div class="card-type"></div>
                            <input placeholder="0000 0000 0000 0000"  onkeyup="$cc.validate(event)" name="creditcard" />
                            <!-- The checkmark ".card-valid" used is a custom font from icomoon.io --->
                            <div class="card-valid">&#x2713;</div>
                            </div>

                            <div class="card-details clearfix">

                            <div class="expiration">
                                <aside>Expiration Date</aside>
                                <input onkeyup="$cc.expiry.call(this,event)"  maxlength="7" name="expiration_date" placeholder="mm/yyyy" />
                            </div>

                            <div class="cvv">
                                <aside>CVV</aside>
                                <input placeholder="XXX"  name="cvv"/>
                            </div>
                           
                              </div>


                            </div>
                            <input type="submit" class="btn btn-primary mt-3" value="Buy" name="submit">

                    </div>';
                        ?>
                    </div>
                </form>
            </div>
        </div>
        <?php include('footer.php') ?>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>

    <script src="js/main.js"></script>
    <script src="js-CreditCardValidator-master/creditCardValidator.js"></script>

    <script>
        $(document).ready(function(){
            $("#dropdown").change(function(){
                var val = $("#dropdown").val();

                if(val == "visa"){
                    $("#visa").css("display", "block");
                }
                else{
                    $("#visa").css("display", "none");
                }
            });
        });
    </script>

</body>

</html>
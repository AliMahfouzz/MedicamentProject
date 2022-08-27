<?php
session_start();

include('connection.php');

if ($_SESSION['usertype'] == 'client') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy";
} else if ($_SESSION['usertype'] == 'admin') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy";
} else if ($_SESSION['usertype'] == 'pharmacie') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idpharmacy = '".$_SESSION["userid"]."'";
} else if ($_SESSION['usertype'] == 'delivery') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy";
} else {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy";
}


$result = mysqli_query($con, $query);

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
        .defin i{
            margin-right: 10px;
        }
        .defin{
            color: #75b239;
        }
        .text-primary-order{
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
                        <strong class="text-black">View Products</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter</h3>
                        <select id="filter" name="filter" class="form-control col-md-4">
                            <option default selected disabled>Select an Option</option>
                            <option>Qahira</option>
                            <option>Aswan</option>
                            <option>Gizah</option>
                            <option>Asyout</option>
                            <option>iskandaria</option>
                            <option>bour saiid</option>
                            <option>bour fouad</option>
                            <option>tanta</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section bg-light">
            <div class="container">


                    <input type="hidden" id="user_type" value="<?php echo $_SESSION['usertype']?>"/>
                <div class="row" id="products">
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo '
                    <div class="col-sm-6 col-lg-4 text-center item mb-4 item-v2">
                        <span class="onsale">Sale</span>
                        <a href="product.php?idproduct='.$row["idproduct"].'"> 
                        <img src="./uploads/'.$row["pimage"].'" alt="Image" width="200px" height="200px">
                        </a>
                            <h3 class="text-dark"><a href="product.php?idproduct='.$row["idproduct"].'">'.$row["pname"].'</a></h3>
                        <p>
                            <span class="defin"><i class="fa fa-list-alt"></i></span><span class="text-primary-order">Description: </span>'.$row["pdescription"].'
                        </p>
                        <p>
                            <span class="defin"><i class="fa fa-id-card"></i></span><span class="text-primary-order">Pharmacy Name: </span>'.$row["fname"].'
                        </p>
                        <p>
                            <span class="defin"><i class="fa fa-location-arrow"></i></span><span class="text-primary-order">Pharmacy Locations: </span>'.$row["location"].'
                        </p>
                        <p>
                            <span class="defin"><i class="fa fa-phone"></i></span><span class="text-primary-order">Pharmacy phone: </span>'.$row["phone"].'
                        </p>
                        <p class="price">'.$row["pprice"].'<i class="fa fa-usd text-primary ml-1"></i></p>
                    </div>';


                        }
                    ?>
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

    <script src="js/main.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#filter").change(function(){
                $.ajax({
                type: "post",
                url : "allproducts.php?idfilter="+$("#filter").val()+"&user_type="+$("#user_type").val(),
                contentType : "html",
                success : function(response){
                    $("#products").html(JSON.parse(response));
                }
            })
            //console.log($("#filter").val());
            })      
        })
    </script>
</body>

</html>
<?php
session_start();

include('connection.php');

$idfilter = $_GET["idfilter"];


if ($_SESSION['usertype'] == 'client') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE ph.location LIKE '%".$idfilter."%'";
} else if ($_SESSION['usertype'] == 'admin') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE ph.location LIKE '%".$idfilter."%'";
} else if ($_SESSION['usertype'] == 'pharmacie') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE p.idpharmacy = '".$_SESSION["userid"]."' AND ph.location LIKE '%".$idfilter."%'";
} else if ($_SESSION['usertype'] == 'delivery') {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE ph.location LIKE '%".$idfilter."%'";
} else {
    $query = "SELECT * FROM product p left join pharmacie ph on ph.idpharmacie = p.idpharmacy WHERE ph.location LIKE '%".$idfilter."%'";
}

$result = mysqli_query($con, $query);

$string = "";

while ($row = mysqli_fetch_array($result)) {
    $string .= '
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
    <span class="defin"><i class="fa fa-id-card"></i></span><span class="text-primary-order">Pharmacy Name: </span>'.$row["pname"].'
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

echo json_encode($string);


?>
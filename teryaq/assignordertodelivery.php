

<?php

include('connection.php');

$query = "SELECT * FROM delivery";
$result = mysqli_query($con, $query);

$select = "Choose a delivery account <select name='account' id='account' class='form-control col-md-8'>";

while ($row = mysqli_fetch_array($result)) {

    $select .= "<option value='".$row['iddelivery']."'>".$row['fname']." ".$row['lname']."</option>";
}

$select .= "</select>";

if (isset($_POST["approveuser"])) {
    echo var_dump($_POST);
    $query = "UPDATE orders SET assigned_to = ? WHERE idorders = ?";

                $stmt = $con->prepare($query);


                $id = (int)$_POST["o_id"];
                $uid = $_POST["account"];

                $stmt->bind_param('si', $uid, $id);

                $stmt->execute();

                if ($stmt) {
                    header("Location: viewproductsorders.php");
                    exit();
                } else {
                    header("Location: viewproductsorders.php");
                    exit();
                }
    
}


?>

<head>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

 <div class="modal fade" id="approvemodal5" tabindex="-1" role="dialog" aria-labelledby="approvemodal5Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="approvemodal5Label"> Do you want to Assign to the account ?? </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="assignordertodelivery.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="o_id" id="o_id">

                        <h4> Do you want to Assign to the account ??</h4>
                        <?php echo $select; ?>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="approveuser">Yes !! Approve it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="jquery.dataTables.min.js"></script>
    <script src="dataTables.bootstrap4.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        $(document).ready(function(){
            $("#account").select2();
        });
    </script>
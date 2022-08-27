

<?php

include('connection.php');


if (isset($_POST["approveuser"])) {
   // echo var_dump($_POST);
    $query = "UPDATE orders SET delivered = ? WHERE idorders = ?";

                $stmt = $con->prepare($query);


                $id = (int)$_POST["o_id2"];
                $uid = 1;

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


 <div class="modal fade" id="approvemodal6" tabindex="-1" role="dialog" aria-labelledby="approvemodal6Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="approvemodal6Label"> Do you want to approve the order ?? </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="approveorder.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="o_id2" id="o_id2">

                        <h4> Do you want to make the order as delivered ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="approveuser">Yes !! Approve it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



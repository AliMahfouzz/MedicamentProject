

<?php

include('connection.php');


if (isset($_POST["cancelorder"])) {
    $query = "UPDATE orders SET delivered = ? WHERE idorders = ?";

                $stmt = $con->prepare($query);


                $id = (int)$_POST["o_id3"];
                $uid = 2;

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


 <div class="modal fade" id="cancelordermodal" tabindex="-1" role="dialog" aria-labelledby="cancelordermodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="cancelordermodalLabel"> Do you want to cancel the order ?? </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="cancelorder.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="o_id3" id="o_id3">

                        <h4> Do you want to make the order as cancel ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="submit" name="cancelorder">Yes !! cancel it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



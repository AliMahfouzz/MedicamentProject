
 <div class="modal fade" id="approvemodal" tabindex="-1" role="dialog" aria-labelledby="approvemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="approvemodalLabel">  </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="approveaccount.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="p_id" id="p_id">
                        <input type="hidden" name="ps_id" id="ps_id">
                        <input type="hidden" name="d_id" id="d_id">

                        <h4> Do you want to Approve this account ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" name="approveuser">Yes !! Approve it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <?php


        if (isset($_POST["approveuser"])) {
            include("connection.php");

            $pid = $_POST["p_id"];
            $psid = $_POST["ps_id"];
            $did = $_POST["d_id"];

            

            if($pid != ""){
                $query = "UPDATE pharmacie SET approved = ? WHERE idpharmacie = ?";

                $stmt = $con->prepare($query);

                $approved = 1;

                $id = (int)$_POST["p_id"];

                $stmt->bind_param('ii', $approved, $id);

                $stmt->execute();

                if ($stmt) {
                    header("Location: viewaccounts.php");
                    exit();
                } else {
                    header("Location: viewaccounts.php");
                    exit();
                }
            }

            if($psid != ""){
                $query = "UPDATE pharmacist SET approved = ? WHERE idpharmacist = ?";

                $stmt = $con->prepare($query);

                $approved = 1;

                $id = (int)$_POST["ps_id"];

                $stmt->bind_param('ii', $approved, $id);

                $stmt->execute();

                if ($stmt) {
                    header("Location: viewaccounts.php");
                    exit();
                } else {
                    header("Location: viewaccounts.php");
                    exit();
                }
            }
            
            if($did != ""){
                $query = "UPDATE delivery SET approved = ? WHERE iddelivery = ?";

                $stmt = $con->prepare($query);

                $approved = 1;

                $id = (int)$_POST["d_id"];

                $stmt->bind_param('ii', $approved, $id);

                $stmt->execute();

                if ($stmt) {
                    header("Location: viewaccounts.php");
                    exit();
                } else {
                    header("Location: viewaccounts.php");
                    exit();
                }
            }
            
            
        }


    ?>
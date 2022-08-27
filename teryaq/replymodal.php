<div class="modal fade" id="replymodal" tabindex="-1" role="dialog" aria-labelledby="replymodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replymodalLabel"> Make A Reply </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="replymodal.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="q_id" id="q_id">

                    <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="replyy" class="text-black">Reply </label>
                                        <textarea name="replyy" id="replyy" cols="30" rows="7" class="form-control"></textarea>
                                    </div>
                                </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="image" class="text-black">File To Upload </label>
                            <input type="file" class="form-control" id="image" name="fileToUpload">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="reply">Reply</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php

if (isset($_POST["reply"])) {
    session_start();
    include("connection.php");

   // echo var_dump($_POST);

    $qid = $_POST["q_id"];
    $reply = $_POST["replyy"];

    $target_dir = "uploads/";
    $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);

    $profile_pic = "";

    if (isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != "") {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
        } else {
            $error_msg = "Sorry, there was an error uploading your file.";
        }
    }

    $response = 1;

    $idusers = $_SESSION["userid"];



        $query = "UPDATE question SET replied = ?, replied_user = ?, response = ?, filereply = ? WHERE idquestion = ?";

        $stmt = $con->prepare($query);

        $approved = 1;

        $id = (int)$_POST["q_id"];

        $stmt->bind_param('ssssi', $reply, $idusers, $response, $profile_pic, $id);

        $stmt->execute();

        if ($stmt) {
            header("Location: viewquestions.php");
            exit();
        } else {
            header("Location: viewquestions.php");
            exit();
        }
    }
?>
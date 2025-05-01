<?php

require('../../config.php');
$id = $_GET['id'];


if (isset($_POST['update'])) {

    $attribute_name  = $_POST['attribute_name'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $update = "UPDATE `aterbute` SET`attribute_name`='$attribute_name',`status`='$status',`description`='$description' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header('Location: index.php');
    }
}


$select = "SELECT * FROM `aterbute` WHERE id = '" . $id . "'";
$data = mysqli_query($conn, $select);
$rowResult = mysqli_fetch_assoc($data);




?>

<?php
include('../common/header.php');
include('../common/sidebar.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .select {
            width: 100% !important;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>


<form method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="fullname">attribute name</label>
            <input type="text" name="attribute_name" value="<?php echo $rowResult['attribute_name'] ?>" class="form-control"><br><br>
            <label for="fullname">status</label><br><br>
            <select class="select" name="status">
                <option class="select">select</option>
                <option class="select" value="1" <?php if ($rowResult['status'] == 1) {
                                                        echo "selected";
                                                    } ?>>Active</option>
                <option class="select" value="2" <?php if ($rowResult['status'] == 2) {
                                                        echo "selected";
                                                    } ?>>Inactive</option>
            </select><br><br>
            <label for="fullname">description</label>
            <input type="textarea" name="description" value="<?php echo $rowResult['description'] ?>" class="form-control">
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </div>
</form>
</div>



<?php include('../common/footer.php'); ?>
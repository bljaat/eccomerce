<?php

require('../../config.php');
$id = $_GET['id'];


if (isset($_POST['update'])) {

    $attachment = $_FILES['image'];
    $uplodfolder = '../uploads/categories/' . $attachment['name'];
    move_uploaded_file($attachment['tmp_name'], $uplodfolder);
    $filePath = 'categories/' . $attachment['name'];

    $brand_name  = $_POST['brand_name'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $update = "UPDATE `brands` SET`brand_name`='$brand_name',`logo`='$filePath',`status`='$status',`description`='$description' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header('Location: index.php');
    }
}


$select = "SELECT * FROM `brands` WHERE id = '" . $id . "'";
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
            <label for="fullname">category name</label>
            <input type="text" name="brand_name" value="<?php echo $rowResult['brand_name'] ?>" class="form-control">
            <label for="fullname">image</label>
            <input type="file" name="image" value="<?php echo $rowResult['logo'] ?>" class="form-control">
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

</div>

<?php include('../common/footer.php'); ?>
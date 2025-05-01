<?php

require('../../config.php');
$id = $_GET['id'];


if (isset($_POST['update'])) {

    $attachment = $_FILES['image'];
    $uplodfolder = '../uploads/categories/' . $attachment['name'];
    move_uploaded_file($attachment['tmp_name'], $uplodfolder);
    $filePath = 'categories/' . $attachment['name'];

    $category_name  = $_POST['category_name'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $showonhome = $_POST['showonhome'];
    $update = "UPDATE `category` SET`category_name`='$category_name',`image`='$filePath',`status`='$status',`description`='$description' , `showonhome` = '$showonhome' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header('Location: index.php');
    }
}


$select = "SELECT * FROM `category` WHERE id = '" . $id . "'";
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
            <input type="text" name="category_name" value="<?php echo $rowResult['category_name'] ?>" class="form-control">
            <label for="fullname">image</label>
            <input type="file" name="image" value="<?php echo $rowResult['image'] ?>" class="form-control">
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
            <div style="display: flex;height: 25px;margin: 10px;">
                <input style="width: 10px; margin : 4px;" type="checkbox" name="showonhome">Show on home<br><br>
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </div>
</form>
</div>

</div>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <div class="container">
        <h2>Modal Example</h2>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html> -->


<?php include('../common/footer.php'); ?>
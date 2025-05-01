<?php

require('../../config.php');
$id = $_GET['id'];


if (isset($_POST['update'])) {
    $attchquery = $conn->query("SELECT * FROM `banner` WHERE id = '" . $id . "'");
    $attchResult = mysqli_fetch_assoc($attchquery);
    $filePath = $attchResult['image'];
    $attachment = $_FILES['image'];
    if(!empty($attachment['name'])){
        $uplodfolder = '../uploads/banner/' . $attachment['name'];
        move_uploaded_file($attachment['tmp_name'], $uplodfolder);
        $filePath = 'banner/' . $attachment['name'];
    }
    $title = $_POST['title'];
    $description = $_POST['description'];
    $update = "UPDATE `banner` SET `image`='$filePath',`title`='$title',`description`='$description' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header('Location: index.php');
    }
}


$select = "SELECT * FROM `banner` WHERE id = '" . $id . "'";
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
            <input type="file" name="image" class="form-control"><br><br>
            
            <label for="fullname">title</label>
            <input type="textarea" name="title" value="<?php echo $rowResult['title'] ?>" class="form-control">

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
<?php

require('../../config.php');
$id = $_GET['id'];


if (isset($_POST['update'])) {
    $attachment = $_FILES['image'];
    $uplodfolder = '../uploads/categories/' . $attachment['name'];
    move_uploaded_file($attachment['tmp_name'], $uplodfolder);
    $filePath = 'categories/' . $attachment['name'];

    $subcategory_name  = $_POST['subcategory_name'];
    $categoryid = $_POST['category_id'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    $update = "UPDATE `subcategory` SET`subcategory_name`='$subcategory_name',category_id= '$categoryid',`image`='$filePath',`status`='$status',`description`='$description' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header('Location: index.php');
    }
}





$select = "SELECT * FROM `subcategory` WHERE id = '" . $id . "'";
$data = mysqli_query($conn, $select);
$rowResult = mysqli_fetch_array($data);

include('../common/header.php');
include('../common/sidebar.php');
$category_query = "SELECT * FROM category";
$category_result = mysqli_query($conn, $category_query);

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

<body>

    <form method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="subcategory_name">subcategory name</label>
                <input type="text" name="subcategory_name" value="<?php echo $rowResult['subcategory_name'] ?>" class="form-control">
                <label for="category">category name</label><br><br>
                <select class="form-control" name="category_id">
                    <option class="input" value="">select category</option>
                    <?php while ($cate = mysqli_fetch_assoc($category_result)) { ?>
                        <option value="<?php echo $cate['id'] ?>"
                            <?php echo ($cate['id'] == $rowResult['category_id']) ? "selected" : ""; ?>>
                            <?php echo $cate['category_name']; ?>
                        </option>
                    <?php } ?>
                </select>
                <label for="image">image</label>
                <input type="file" name="image" value="<?php echo $rowResult['image'] ?>" class="form-control">
                <label for="status">status</label><br><br>
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
        </div>
    </form>


    <?php include('../common/footer.php'); ?>
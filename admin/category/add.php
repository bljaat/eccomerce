<?php require '../../config.php';

if (isset($_POST['submit'])) {

    if (!empty($_POST['Category'])  && !empty($_POST['status'])) {
        $attachment = null;
        if (!empty($_FILES['attachment']['name'])) {
            $attachment = $_FILES['attachment'];
            $uplodfolder = '../uploads/categories/' . $attachment['name'];
            move_uploaded_file($attachment['tmp_name'], $uplodfolder);
            $filePath = 'categories/' . $attachment['name'];
        } else {
            echo "image not found";
        }


        $Category = $_POST['Category'];
        $Status = $_POST['status'];
        $Description = $_POST['description'];
        $showonhome = $_POST['showonhome'];

        $insert = "INSERT INTO `category`(`category_name`, `image`, `status`,`description`,`showonhome`) VALUES ('" . $Category . "','" . $filePath . "','" . $Status . "', '" . $Description . "','" . $showonhome . "')";

        $uplode = mysqli_query($conn, $insert);

        if ($uplode) {
            header('Location: index.php');
        }
    } else {
        echo "<script>
                alert('Please fill all the fields');
                window.location.href = 'add.php'; 
              </script>";
    }
}

?>


<?php
include '../common/header.php';
include '../common/sidebar.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .content {
            background: #fff;
        }

        .container-fluid {
            background-color: #fff !important;
        }

        .dark-mode .card {
            background-color: #fff !important;
            color: #000;
        }

        .dark-mode .content-wrapper {
            background: #fff;
        }

        .btn-block {
            width: 30%;
        }

        .btn-block+.btn-block {
            margin-top: .0rem;
        }

        .form-control {
            background: #fff !important;
            color: #000 !important;
        }

        .status {
            padding: 5px;
            border-radius: 2px;
            background: #fff !important;
            color: #000 !important;
            width: 100%;
        }

        .submit {
            border: none;
            padding: 5px;
            border-radius: 2px;
        }

        .submit a {
            text-decoration: none;
            color: #fff;
        }

        .form input {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Add a category</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" class="form" method="POST" enctype="multipart/form-data">
                <label for="Category">Category Name</label><br>
                <input type="text" name="Category" placeholder="Category Name"><br>
                <label for="image">Image</label><br>
                <input class="input" type="file" name="attachment"><br>
                <label for="Category">Status</label><br>

                <select class="status" name="status">
                    <option class="input" value="">Status</option>
                    <option class="input" value="1">Active</option>
                    <option class="input" value="2">Inactive</option>

                </select><br><br>
                <label for="Description">Description</label><br>
                <input type="textarea" name="description" placeholder="Description"><br><br>
                <div style="display: flex;height: 25px;margin: 10px;">
                    <input style="width: 10px; margin : 4px;" type="checkbox" name="showonhome">Show on home<br><br>
                </div>
                <button class="submit btn btn-block btn-primary btn-sm" name="submit" type="submit">Submit</button>
            </form>
        </div>
    </div>


    <?php include '../common/footer.php' ?>
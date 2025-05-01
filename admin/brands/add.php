<?php require '../../config.php';

if (isset($_POST['submit'])) {

    if (!empty($_POST['brand_name'])  && !empty($_POST['status'])) {
        $attachment = null;
        if (!empty($_FILES['attachment']['name'])) {
            $attachment = $_FILES['attachment'];
            $uplodfolder = '../uploads/categories/' . $attachment['name'];
            move_uploaded_file($attachment['tmp_name'], $uplodfolder);
            $filePath = 'categories/' . $attachment['name'];
        } else {
            echo "image not found";
        }


        $brandname = $_POST['brand_name'];
        $Status = $_POST['status'];
        $Description = $_POST['description'];
        $insert = "INSERT INTO `brands`(`brand_name`, `logo`, `status`,`description`) VALUES ('" . $brandname . "','" . $filePath . "','" . $Status . "', '" . $Description . "')";

        $uplode = mysqli_query($conn, $insert);

        if ($uplode) {
            header('Location: index.php');
        }
    }else{
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
            <h3 class="card-title">Add a brands</h3>

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
                <label for="Category">Brand Name</label><br>
                <input type="text" name="brand_name" placeholder="Brand Name"><br>
                <label for="image">Logo</label><br>
                <input class="input" type="file" name="attachment"><br>
                <label for="Category">Status</label><br>
                
                <select class="status" name="status">
                    <option class="input" value="">Status</option>
                    <option class="input" value="1">Active</option>
                    <option class="input" value="2">Inactive</option>

                </select><br><br>
                <label for="Description">Description</label><br>
                <input type="textarea" name="description" placeholder="Description"><br><br>
                <button class="submit btn btn-block btn-primary btn-sm" name="submit" type="submit">Submit</button>
            </form>
        </div>
    </div>


    <?php include '../common/footer.php' ?>
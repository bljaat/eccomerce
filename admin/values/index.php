<?php require "../../config.php";
$id = $_GET['id'];
if (isset($_POST['submit'])) {

    if (!empty($_POST['name'])  && !empty($_POST['hex_value'])) {
        $name = $_POST['name'];
        $hexvalue = $_POST['hex_value'];
        $description = $_POST['description'];


        $insert = "INSERT INTO `values`( `attribute_id`,`name`, `hex_value`,`description`) VALUES ('" . $id . "','" . $name . "','" . $hexvalue . "', '" . $description . "')";

        $uplode = mysqli_query($conn, $insert);

        if ($uplode) {
            header('Location: index.php?id=' . $id . '');
        }
    } else {
        echo "<script>
                alert('Please fill all the fields');
                window.location.href = 'index.php'; 
              </script>";
    }
}


?>




<?php include '../common/header.php'; ?>
<?php include '../common/sidebar.php';
$data1 = $conn->query("SELECT * FROM aterbute WHERE id = '$id'");


$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM `values` WHERE `values`.`attribute_id` = '$id' LIMIT $start, $limit";

$data = mysqli_query($conn, $query);

$totalQuery = "SELECT COUNT(*) FROM `values` WHERE `values`.`attribute_id` = '$id'";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_row($totalResult);
$total = $totalRow[0];

$pages = ceil($total / $limit);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            overflow-x: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header a {
            padding: 6px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .pagination a {
            padding: 8px 12px;
            text-decoration: none;
            border: none;
            margin: 2px;
            color: #fff !important;
            border-radius: 5px;
        }

        .pagination a.active {
            background: #007bff;
            color: #fff;
        }

        .btn-block+.btn-block {
            margin-top: .0rem;
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
            color: #fff;
            width: 100%;
            background: rgb(43, 50, 57);
            border: none;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .form input::placeholder {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-6">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div style="width: 100%;">
                                        <?php
                                        $result = mysqli_num_rows($data1);
                                        if ($data) {
                                            while ($row = mysqli_fetch_array($data1)) {
                                        ?>
                                                <h3 class="card-title">
                                                    <?php echo $row['attribute_name']; ?>
                                                </h3>
                                        <?php }
                                        } ?>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Value</th>
                                                <th>description</th>
                                            </tr>
                                            <?php
                                            $data = mysqli_query($conn, $query);
                                            $result = mysqli_num_rows($data);
                                            if ($data) {
                                                while ($row = mysqli_fetch_array($data)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['hex_value']; ?></td>
                                                        <td><?php echo $row['description']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </thead>
                                    </table>
                                    <div class="pagination">
                                        <?php if ($page > 1) { ?>
                                            <a href="?id=<?php echo $id ?>&&page=<?php echo $page - 1; ?>">Prev</a>
                                        <?php }
                                        for ($i = 1; $i <= $pages; $i++) { ?>
                                            <a href="?id=<?php echo $id ?>&&page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                        <?php }
                                        if ($page < $pages) { ?>
                                            <a href="?id=<?php echo $id ?>&&page=<?php echo $page + 1; ?>">Next</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add a Value</h3>

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
                        <label for="Name">Name</label><br>
                        <input type="text" name="name" placeholder="Name" class="form_cntrol"><br>
                        <label for=" Value">Hex Value</label><br>
                        <input type="text" name="hex_value" placeholder="Hex Value" class="form_cntrol"><br>
                        <label for="Description">Description</label><br>
                        <input type="textarea" name="description" class="form_cntrol" placeholder="Description"><br><br>
                        <button class="submit btn btn-block btn-primary btn-sm" name="submit" type="submit">Add</button>
                    </form>
                </div>
            </div>

        </div>
    </div>









    <?php include '../common/footer.php'; ?>
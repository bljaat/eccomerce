<?php
require('../../config.php');
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
    header('Location: login.php');
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = "DELETE FROM `brands` WHERE id = '$id'";
    $remove = mysqli_query($conn, $delete);
    if ($remove) {
        echo "<script>
                alert('Are you sure you want to delete this data?');
                window.location.href = 'index.php'; 
              </script>";
    }
}

if (isset($_POST['toggleStatus'])) {
    $id = $_POST['id'];
    $status = $_POST['status'] ?? 0;
    $sql = "UPDATE `brands` SET `status` = " . $status . " WHERE id = " . $id . "";
    $data = mysqli_query($conn, $sql);
}
?>



<?php
include('../common/header.php');
include('../common/sidebar.php');

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM brands LIMIT $start, $limit";
$data = mysqli_query($conn, $query);

$totalQuery = "SELECT COUNT(*) FROM brands";
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
        .btn-block+.btn-block {
            margin-top: .0rem;
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
    </style>
</head>

<body>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="width: 100%;">
                                <h3 class="card-title">Category</h3>
                            </div>
                            <div>
                                <a class="btn btn-block btn-success" href="add.php">Add</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Brand Name</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT * FROM brands";
                                $data = mysqli_query($conn, $query);
                                $result = mysqli_num_rows($data);
                                if ($data) {
                                    while ($row = mysqli_fetch_array($data)) {
                                ?>
                                        <tr style="align-items: center;">
                                            <td style="width: 20%;"><?php echo $row['brand_name'] ?></td>
                                            <?php if (!empty($row['logo'])) { ?>
                                                <td style="width: 20%; text-align:center;"><img src="<?php echo UPLOAD_PATH . '/' . $row['logo']; ?>" style="width:50%;" alt=""></td>
                                            <?php } ?>
                                            <td>
                                                <form method="POST" action="" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="status" value="<?php echo ($row['status'] == '1' ? '2' : '1'); ?>">
                                                    <button type="submit" style="background:#00aaff;border:none; padding:6px;border-radius:5px; color:#fff;" name="toggleStatus">
                                                        <?php echo ($row['status'] == '1' ? 'Active' : 'Inactive'); ?>
                                                    </button>
                                                </form>
                                            </td>
                                            <td><?php echo $row['description'] ?></td>


                                            <td>
                                                <div style="display:flex; justify-content: space-between; align-items:center;">
                                                    <a class="btn btn-block btn-success btn-sm mx-1" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                                    <a class="btn btn-block btn-danger btn-sm mx-1" href="index.php?delete=<?php echo $row['id']; ?>">Delete</a>
                                                </div>
                                            </td>


                                        </tr>
                                <?php }
                                } ?>
                            </table>
                            <div class="pagination">
                                <?php if ($page > 1) { ?>
                                    <a href="?page=<?php echo $page - 1; ?>">Prev</a>
                                <?php }
                                for ($i = 1; $i <= $pages; $i++) { ?>
                                    <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                <?php }
                                if ($page < $pages) { ?>
                                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>


<?php include('../common/footer.php') ?>
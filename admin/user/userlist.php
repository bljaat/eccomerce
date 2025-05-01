<?php
require('../../config.php');
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
    header('Location: login.php');
}

include('../common/header.php');
include('../common/sidebar.php');

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM users LIMIT $start, $limit";
$data = mysqli_query($conn, $query);

$totalQuery = "SELECT COUNT(*) FROM users";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_row($totalResult);
$total = $totalRow[0];

$pages = ceil($total / $limit);
?>
<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = "DELETE FROM `users` WHERE id = '$id'";
    $remove = mysqli_query($conn, $delete);
    if ($remove) {
        echo "<script>
                alert('Data deleted successfully');
                window.location.href = 'userlist.php'; 
              </script>";
    } else {
        echo "<script>alert('Error deleting data');</script>";
    }
}
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

        .card-header {
            align-items: center;
            display: flex;
            justify-content: space-between;
        }

        .card-header a {
            text-align: end;
            background: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
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
                                <h3 class="card-title">User list</h3>
                            </div>
                            <div>
                                <a href="add.php">Add</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $data = mysqli_query($conn, $query);
                                    $result = mysqli_num_rows($data);
                                    if ($data) {
                                        while ($row = mysqli_fetch_array($data)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['full_name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td style="display:flex; justify-content: space-around; align-items:center;">
                                                    <a class="btn btn-block btn-success btn-sm" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                                    <a class="btn btn-block btn-danger btn-sm" href="userlist.php?delete=<?php echo $row['id']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>

                                </tbody>
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
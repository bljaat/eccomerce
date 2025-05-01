<?php

require('../../config.php');
$id = $_GET['id'];

if (isset($_POST['update'])) {
    $full_name  = $_POST['full_name'];
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $update = "UPDATE `users` SET `full_name`='$full_name',`email`='$email',`password`='$password' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
       // echo "call here"; die;
        header('Location: userlist.php');
    }
}



$select = "SELECT * FROM `users` WHERE id = '" . $id . "'";
$data = mysqli_query($conn, $select);
$row = mysqli_fetch_array($data);

include('../common/header.php');
include('../common/sidebar.php');
?>
    <!-- form start -->
    <form method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="fullname">fullname</label>
                <input type="text" name="full_name" value="<?php echo $row['full_name'] ?>" class="form-control">

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" class="form-control" value="<?php echo $row['password'] ?>" name="password">
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" name="update" class="btn btn-primary">Submit</button>
            </div>
    </form>
</div>


</div>

<?php include('../common/footer.php'); ?>
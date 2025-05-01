<?php require '../../config.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['retype_password'])) {
        $fullname = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $retypepassword = $_POST['retype_password'];

        if ($password == $retypepassword) {
            $exists = "SELECT * FROM `users` WHERE email = '" . $email . "'";
            $result = mysqli_query($conn, $exists);
            if ($result->num_rows > 0) {
                echo "Email already exists!";
            } else {
                $user = "INSERT INTO `users`( `full_name`, `email`, `password`) VALUES ('" . $fullname . "','" . $email . "','" . md5($password) . "')";

                $query = mysqli_query($conn, $user);
                if ($query) {
                    echo "<script>
                alert('User add successfully');
                window.location.href = 'userlist.php'; 
              </script>";
                }
            }
        } else {
            echo "Password is not match";
        }
    } else {
        echo "Please fill all filds";
    }
} else {
    echo "";
}

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
        .dark-mode .content-wrapper {
            background: #fff;
            color: #000 !important;
        }

        .register-logo a {
            color: #000 !important;
        }

        .register-card-body {
            background-color: #fff !important;
            border-top: 0;
            color: #666 !important;
            padding: 20px;
        }

        .register-box {
            width: 100%;
        }

        .form-control {
            background: #fff !important;
            color: #000 !important;
        }

        .dark-mode .card {
            background-color: #fff;
            color: #000;
        }

        .col-4 {
            padding: 0px;
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="<?php echo ADMIN_ASSET ?>index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="full_name" class="form-control" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="retype_password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" name="submit" class="btn btn-block btn-primary btn-sm">Submit</button>
                    </div>

                </form>
            </div>

        </div>

    </div>








    <?php include('../common/footer.php'); ?>
<?php require('config.php');
include('../ecommerce/common/header.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $exists = "SELECT * FROM `vinaika_users` WHERE email = '" . $email . "'";
        $result = mysqli_query($conn, $exists);
        if ($result->num_rows > 0) {
            echo "<script>alert('Email Already Exists');</script>";
        } else {
            $query = $conn->query("INSERT INTO `vinaika_users`(`full_name`, `email`, `password`) VALUES ('" . $full_name . "','" . $email . "','" . md5($password) . "')");
            if ($query) {
                echo "<script>alert('Data Inserted Successfully');
                   window.location.href='login.php';
                   </script>";
            } else {
                echo "Data Not Inserted";
            }
        }
    } else {
        echo "<script>alert('Please Fill All The Fields');</script>";
    }
}



?>








<div class="content">
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Create Account</h4>
                        <div class="breadcrumb__links">
                            <a href="index-2.html">Home</a>
                            <span>Create Account</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="register-page spad-70">
        <div class="container">
            <div class="row create-an-account">
                <div class="col-md-12">
                    <form method="POST" id="form">
                        <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA">
                        <h2>REGISTER WITH VINAIKA</h2>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" />
                        </div>
                        <div class="form-group">
                            <label>Your Email Address </label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <label>Your Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" />
                        </div>
                        <button type="submit" name="submit" class="btn product__btn signin_btn w-100 save">Create an account</button>
                        <div class="already-btnRegisterPage text-center">
                            <p>Already have an account? <a href="login.php">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include('../ecommerce/common/footer.php') ?>
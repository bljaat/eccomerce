<?php include('config.php');

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: index.php');
}
?>

<?php

if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $exists = "SELECT * FROM `vinaika_users` WHERE email = '" . $_POST['email'] . "'";
        $result = mysqli_query($conn, $exists);

        if ($result->num_rows > 0) {

            $select = "SELECT * FROM `vinaika_users` WHERE email = '" . $_POST['email'] . "' AND password = '" . md5($_POST['password']) . "'";

            $result = mysqli_query($conn, $select);
            $_SESSION['user'] = mysqli_fetch_assoc($result);   
            


            if ($result) {

                header('Location: index.php');
            } else {
                echo "increct password";
            }
        } else {
            echo "<script>alert('Email Not Found');</script>";
        }
    } else {
        echo "<script>alert('Please Fill All The Fields');</script>";

    }
}
include('../ecommerce/common/header.php'); ?>



<div class="content">
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
                        <h4>Login</h4>
                        <div class="breadcrumb__links">
                            <a href="index.html">Home</a>
                            <span>Login</span>
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
                    <form method="POST" id="signinform">
                        <input type="hidden" name="_token" value="psq8olwBXSDwtv5FuFNL7aXE5g8QXzX9kOx6haHA">
                        <h2>Sign IN</h2>
                        <div class="form-group">
                            <label>Your Email </label>
                            <input type="email" id="email_main" class="form-control" name="email" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <label>Your Password</label>
                            <input type="password" id="password_main" class="form-control" name="password" placeholder="Enter Password" />
                        </div>
                        <button type="submit" name="submit" class="btn product__btn signin_btn w-100 save">Sign IN</button>
                        <div class="already-btnRegisterPage text-center">
                            <p>Don't have an account? <a href="register.php">Sign up</a></p>
                        </div>

                        <div class="col-md-12 text-center">
                            <a href="https://www.facebook.com/v3.3/dialog/oauth?client_id=1764025217293855&amp;redirect_uri=https%3A%2F%2Fvinaikajaipur.com%2Flogin%2Ffacebook%2Fcallback&amp;scope=email&amp;response_type=code&amp;state=eDC6dCJAeRQFvbCpfuwMIIs8fyCzWZEETG2RKdHX" class="btn btn-social btnfb"><i class="fa fa-facebook-f"></i> <span class="divider"></span> Login with Facebook</a>
                            <a href="https://accounts.google.com/o/oauth2/auth?client_id=997285346866-p2st47ok3jv0nr61vna7ra2otjs7u0uv.apps.googleusercontent.com&amp;redirect_uri=https%3A%2F%2Fvinaikajaipur.com%2Flogin%2Fgoogle%2Fcallback&amp;scope=openid+profile+email&amp;response_type=code&amp;state=3qjr5ZqDLXxN6cZ7unJUVm17dvWsAuJWS9SnTOCP" class="btn btn-social btn-gmail"><i class="fa fa-google"></i> <span class="divider"></span> Login with Google</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>






<?php include('../ecommerce/common/footer.php') ?>
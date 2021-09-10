<?php session_start(); ?>
<?php include "../config/connection.php"; ?>
<?php include "../functions/admin_functions.php"; ?>
<?php
    if (!empty($_SESSION['user_login_id'])) {
        header("location: " . BASE_URL . "/admin");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo BASE_URL; ?>/public/libs/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo BASE_URL; ?>/public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Impressgift Admin</h1>
                                </div>
                                <form action="" method="POST" class="user">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
    if (isset($_POST['submit'])) {
        $email = !empty($_POST['email']) ? $_POST['email'] : null;
        $password = !empty($_POST['password']) ? $_POST['password'] : null;

        if (empty($password) || empty($email)) {
            echo "<script>alert('Vui long nhap day du email va password');</script>";
        } else {
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $connect = connect_db();
            $result = mysqli_query($connect, $sql);
            close_db_connect($connect);
            if ($result->num_rows > 0) {
                $_SESSION['user_login_id'] = mysqli_fetch_array($result)['id'];
                header("location: " . BASE_URL . "/admin");
            } else {
                echo "<script>alert('Sai ten dang nhap hoac mat khau');</script>";
            }
        }
    }
?>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo BASE_URL; ?>/public/libs/jquery/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>/public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo BASE_URL; ?>/public/libs/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo BASE_URL; ?>/public/js/sb-admin-2.min.js"></script>

</body>

</html>

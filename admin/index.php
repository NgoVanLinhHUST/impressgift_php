<?php session_start(); ?>
<?php include "../functions/admin_functions.php"; ?>
<?php include "../config/connection.php"; ?>
<?php
if (empty($_SESSION['user_login_id'])) {
    header("location: " . BASE_URL .    '/admin/login.php');
}
?>
<?php include "includes/header.php"; ?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content -->
    <?php
        if (!empty($_GET['action']) && !empty($_GET['controller'])) {
            if (is_dir("pages/" . $_GET['controller']) && file_exists("pages/" . $_GET['controller'] . "/" . $_GET['action'] . ".php")) {
                include "pages/" . $_GET['controller'] . "/" . $_GET['action'] . ".php";
            } else {
                include "pages/dashboard/index.php";
            }
        }
    ?>
</div>
<!-- /.container-fluid -->

<?php include "includes/footer.php"; ?>

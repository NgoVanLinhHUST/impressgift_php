<?php
$userId = (!empty($_GET['param'])) ? $_GET['param'] : null;
if (empty($userId)) {
    redirectUrl(getAdminUrl('user', 'list'));
}

if ($userId == 1) {
    echo "<script>alert('Khong duoc phep xoa super admin.')</script>";
    redirectUrl(getAdminUrl('user', 'list'));
}

$sql = "SELECT * FROM users WHERE id = $userId";
$connect = connect_db();
$user = mysqli_query($connect, $sql);
close_db_connect($connect);
if ($user->num_rows == 0) {
    redirectUrl(getAdminUrl('user', 'list'));
}

$sql = "DELETE FROM users WHERE id = $userId";
$connect = connect_db();
mysqli_query($connect, $sql);
close_db_connect($connect);
echo "<script>alert('Xoa user thanh cong.')</script>";
redirectUrl(getAdminUrl('user', 'list'));
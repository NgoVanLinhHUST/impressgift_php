<?php
$categoryId = (!empty($_GET['param'])) ? $_GET['param'] : null;
if (empty($categoryId)) {
    redirectUrl(getAdminUrl('category', 'list'));
}

$sql = "SELECT * FROM categories WHERE id = $categoryId";
$connect = connect_db();
$category = mysqli_query($connect, $sql);
close_db_connect($connect);
if ($category->num_rows == 0) {
    redirectUrl(getAdminUrl('category', 'list'));
}

$sql = "DELETE FROM categories WHERE id = $categoryId";
$connect = connect_db();
mysqli_query($connect, $sql);
$sql = "UPDATE products SET category_id=0 where category_id=$categoryId";
mysqli_query($connect, $sql);
close_db_connect($connect);
echo "<script>alert('Xoa category thanh cong.')</script>";
redirectUrl(getAdminUrl('category', 'list'));
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

$category = mysqli_fetch_array($category);
?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    Category Management
                    <small>| Update Category</small>
                </h4>
            </div>
        </div>
        <form action="" class="mt-4" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="<?php echo $category['name']; ?>" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"><?php echo $category['description']; ?></textarea>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-dark" href="<?php echo getAdminUrl('category', 'list') ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $name = !empty($_POST['name']) ? $_POST['name'] : null;
        $description = !empty($_POST['description']) ? $_POST['description'] : null;

        $connect = connect_db();
        $sql = "SELECT * FROM categories WHERE name='$name' AND id != $categoryId";
        $category = mysqli_query($connect, $sql);
        close_db_connect($connect);
        if ($category->num_rows > 0) {
            echo "<script>alert('Category da ton tai.')</script>";
            redirectUrl(getAdminUrl('category', 'create'));
        }

        $sql = "UPDATE categories SET name='$name', description='$description' WHERE id = $categoryId";
        $connect = connect_db();
        mysqli_query($connect, $sql);
        echo "<script>alert('Update category thanh cong.')</script>";
        redirectUrl(getAdminUrl('category', 'list'));
    }
    ?>

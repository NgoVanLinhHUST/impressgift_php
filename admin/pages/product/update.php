<?php
$productId = (!empty($_GET['param'])) ? $_GET['param'] : null;
if (empty($productId)) {
    redirectUrl(getAdminUrl('product', 'list'));
}

$sql = "SELECT * FROM products WHERE id = $productId";
$connect = connect_db();
$product = mysqli_query($connect, $sql);
close_db_connect($connect);
if ($product->num_rows == 0) {
    redirectUrl(getAdminUrl('product', 'list'));
}

$product = mysqli_fetch_array($product);

$sql = "SELECT * FROM product_images WHERE product_id=$productId";
$connect = connect_db();
$productImages = [];
$productImagesQuery = mysqli_query($connect, $sql);
close_db_connect($connect);
if ($productImagesQuery->num_rows > 0) {
    while ($productImage = mysqli_fetch_array($productImagesQuery)) {
        $productImages[] = $productImage;
    }
}

$sql = "SELECT id, name FROM categories ORDER BY id DESC";
$connect = connect_db();
$categories = mysqli_query($connect, $sql);
close_db_connect($connect);
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    Product Management
                    <small>| Update product</small>
                </h4>
            </div>
        </div>
        <form action="" class="mt-4" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required class="form-control">
                    <option value="">-----Chon category-----</option>
                    <?php
                    if ($categories->num_rows > 0) {
                        while ($category = mysqli_fetch_array($categories)) {
                            if ($category['id'] == $product['category_id']) {
                                echo '<option value="' . $category['id'] . '" selected>' . $category['name'] . '</option>';
                            } else {
                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" value="<?php echo $product['name']; ?>" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" value="<?php echo $product['price']; ?>" id="price" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" rows="5" class="form-control"><?php echo $product['short_description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"><?php echo $product['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="images">Images</label> <br>
                <input type="file" name="images[]" id="images" multiple>
            </div>

            <div class="form-group">
                <table class="table table-bordered">
                    <?php
                        foreach ($productImages as $productImage) {
                    ?>
                            <tr>
                                <td><img src="<?php echo $productImage['image']; ?>" width="300" alt="Image"></td>
                                <td>
                                    <label for="image-deleted-<?php echo $productImage['id']; ?>" class="btn btn-danger js-delete-image">Delete</label>
                                    <input id="image-deleted-<?php echo $productImage['id']; ?>" class="d-none" type="checkbox" value="<?php echo $productImage['id'] ?>" name="image_id_deleted[]">
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>

            <hr>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-dark" href="<?php echo getAdminUrl('product', 'list') ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        window.onload = function () {
            $(".js-delete-image").click(function () {
                $(this).closest('tr').addClass("d-none");
            });
        }
    </script>

    <?php
    if (isset($_POST['submit'])) {
        $categoryId = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
        $name = !empty($_POST['name']) ? $_POST['name'] : null;
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;
        $shortDescription = !empty($_POST['short_description']) ? $_POST['short_description'] : null;
        $description = !empty($_POST['description']) ? $_POST['description'] : null;
        $imagesDeleted = !empty($_POST['image_id_deleted']) ? $_POST['image_id_deleted'] : [];

        $connect = connect_db();
        $sql = "SELECT * FROM products WHERE name='$name' AND id != $productId";
        $product = mysqli_query($connect, $sql);
        close_db_connect($connect);
        if ($product->num_rows > 0) {
            echo "<script>alert('Product da ton tai.')</script>";
            redirectUrl(getAdminUrl('product', 'create'));
        }

        if (!empty($_FILES["images"]["name"])) {
            $total = count($_FILES['images']['name']);
            $images = [];
            // Loop through each file
            for($i=0; $i < $total;$i++ ) {
                //Get the temp file path
                $tmpFilePath = $_FILES['images']['tmp_name'][$i];
                //Make sure we have a file path
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = '../public/images/' . $_FILES['images']['name'][$i];
                    $images[] = BASE_URL . '/public/images/' . $_FILES['images']['name'][$i];
                    //Upload the file into the temp dir
                    move_uploaded_file($tmpFilePath, $newFilePath);
                }
            }
        }

        $userId = $_SESSION['user_login_id'];
        $sql = "UPDATE products set category_id=$categoryId, name='$name', price='$price', short_description='$shortDescription', description='$description' WHERE id=$productId";
        $connect = connect_db();
        mysqli_query($connect, $sql);
        if (!empty($images)) {
            $sql = "INSERT INTO product_images (product_id, image) VALUES ";
            foreach ($images as $key => $image) {
                if ($key == 0) {
                    $sql .= "('$productId', '$image')";
                } else {
                    $sql .= ", ('$productId', '$image')";
                }
            }
            mysqli_query($connect, $sql);
            close_db_connect($connect);
        }

        if (!empty($imagesDeleted)) {
            $sql= "DELETE from product_images WHERE id in (";
            foreach ($imagesDeleted as $key => $id) {
                if ($key == 0) {
                    $sql .= $id;
                } else {
                    $sql .= "," . $id;
                }

                if (($key + 1) == count($imagesDeleted)) {
                    $sql .= ");";
                }
            }

            $connect = connect_db();
            mysqli_query($connect, $sql);
            close_db_connect($connect);
        }

        echo "<script>alert('Update product thanh cong.')</script>";
        redirectUrl(getAdminUrl('product', 'list'));
    }
    ?>

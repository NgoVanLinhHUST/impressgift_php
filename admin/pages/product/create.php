<?php
    $sql = "SELECT id, name FROM categories ORDER id DESC";
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
                    <small>| Add new product</small>
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
                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="images">Images</label> <br>
                <input type="file" required name="images[]" id="images" multiple>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" name="submit">Create</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-dark" href="<?php echo getAdminUrl('product', 'list') ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $categoryId = !empty($_POST['category_id']) ? $_POST['category_id'] : null;
        $name = !empty($_POST['name']) ? $_POST['name'] : null;
        $price = !empty($_POST['price']) ? $_POST['price'] : null;
        $shortDescription = !empty($_POST['short_description']) ? $_POST['short_description'] : null;
        $description = !empty($_POST['description']) ? $_POST['description'] : null;

        $connect = connect_db();
        $sql = "SELECT * FROM products WHERE name='$name'";
        $product = mysqli_query($connect, $sql);
        close_db_connect($connect);
        if ($product->num_rows > 0) {
            echo "<script>alert('Product da ton tai.')</script>";
            redirectUrl(getAdminUrl('product', 'create'));
        }

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
        $userId = $_SESSION['user_login_id'];
        $sql = "INSERT INTO products (category_id, user_id, name, price, short_description, description) VALUES ('$categoryId', '$userId', '$name', '$price', '$shortDescription', '$description')";
        $connect = connect_db();
        mysqli_query($connect, $sql);
        $productId = $connect->insert_id;
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
        echo "<script>alert('Them product thanh cong.')</script>";
        redirectUrl(getAdminUrl('product', 'list'));
    }
    ?>

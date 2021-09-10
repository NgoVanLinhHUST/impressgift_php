<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    Product Management
                </h4>
            </div>
            <div class="col-4 text-right">
                <a href="<?php echo getAdminUrl('product', 'create'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add new Product</a>
            </div>
        </div>
        <?php
        $connect = connect_db();
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $products = mysqli_query($connect, $sql);
        close_db_connect($connect);
        if ($products->num_rows > 0) {
            $userIds = [];
            $categoryIds = [];
            $productData = [];
            while ($product = mysqli_fetch_array($products)) {
                $productData[] = $product;
                if (! in_array($product['user_id'], $userIds)) {
                    $userIds[] = $product['user_id'];
                }

                if (! in_array($product['category_id'], $userIds)) {
                    $categoryIds[] = $product['category_id'];
                }
            }
        }

        if (!empty($userIds)) {
            $sql = "SELECT * FROM users WHERE id IN (";
            $count = count($userIds);
            foreach ($userIds as $key => $userId) {
                if ($key + 1 == $count) {
                    if ($key == 0) {
                        $sql .= "$userId)";
                    } else {
                        $sql .= ", $userId)";
                    }

                } else {
                    $sql .= "$userId";
                }
            }

            $connect = connect_db();
            $queryUsers = mysqli_query($connect, $sql);
            close_db_connect($connect);
            if ($queryUsers->num_rows > 0) {
                $users = [];
                while ($user = mysqli_fetch_array($queryUsers)) {
                    $users[$user['id']] = $user;
                }
            }
        }

        if (!empty($categoryIds)) {
            $sql = "SELECT * FROM categories WHERE id IN (";
            $count = count($categoryIds);
            foreach ($categoryIds as $key => $categoryId) {
                if ($key + 1 == $count) {
                    if ($key == 0) {
                        $sql .= "$categoryId)";
                    } else {
                        $sql .= ", $categoryId)";
                    }
                } else {
                    $sql .= "$categoryId";
                }
            }

            $connect = connect_db();
            $queryCategories = mysqli_query($connect, $sql);
            close_db_connect($connect);
            if ($queryCategories->num_rows > 0) {
                $categories = [];
                while ($category = mysqli_fetch_array($queryCategories)) {
                    $categories[$category['id']] = $category;
                }
            }
        }

        ?>
        <div class="mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Category</strong></td>
                        <td><strong>User</strong></td>
                        <td><strong>Created at</strong></td>
                        <td><strong>Action</strong></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($productData)) {
                        foreach ($productData as $product) {
                            ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo (!empty($categories) && !empty($categories[$product['category_id']])) ? $categories[$product['category_id']]['name'] : null; ?></td>
                                <td><?php echo (!empty($users) && !empty($users[$product['user_id']])) ? $users[$product['user_id']]['name'] : null; ?></td>
                                <td><?php echo $product['created_at']; ?></td>
                                <td>
                                    <a href="<?php echo getAdminUrl('product', 'update', $product['id']); ?>" class="btn btn-info">Edit</a>
                                    <a href="<?php echo getAdminUrl('product', 'destroy', $product['id']); ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

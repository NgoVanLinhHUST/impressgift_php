<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    Category Management
                </h4>
            </div>
            <div class="col-4 text-right">
                <a href="<?php echo getAdminUrl('category', 'create'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add new Category</a>
            </div>
        </div>
        <?php
        $connect = connect_db();
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $categories = mysqli_query($connect, $sql);
        close_db_connect($connect);
        ?>
        <div class="mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Created at</strong></td>
                        <td><strong>Action</strong></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($categories->num_rows > 0) {
                        while ($category = mysqli_fetch_array($categories)) {
                            ?>
                            <tr>
                                <td><?php echo $category['id']; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td><?php echo $category['created_at']; ?></td>
                                <td>
                                    <a href="<?php echo getAdminUrl('category', 'update', $category['id']); ?>" class="btn btn-info">Edit</a>
                                    <a href="<?php echo getAdminUrl('category', 'destroy', $category['id']); ?>" class="btn btn-danger">Delete</a>
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

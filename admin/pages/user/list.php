<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    User Management
                </h4>
            </div>
            <div class="col-4 text-right">
                <a href="<?php echo getAdminUrl('user', 'addnew'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add new User</a>
            </div>
        </div>
        <?php
            $connect = connect_db();
            $sql = "SELECT * FROM users ORDER BY id DESC";
            $users = mysqli_query($connect, $sql);
            close_db_connect($connect);
        ?>
        <div class="mt-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><strong>Name</strong></td>
                        <td><strong>Email</strong></td>
                        <td><strong>Avatar</strong></td>
                        <td><strong>Role</strong></td>
                        <td><strong>Created at</strong></td>
                        <td><strong>Action</strong></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($users->num_rows > 0) {
                            while ($user = mysqli_fetch_array($users)) {
                    ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo getAvatar($user['avatar']); ?></td>
                                    <td><?php echo getRoleName($user['role']); ?></td>
                                    <td><?php echo $user['created_at']; ?></td>
                                    <td>
                                        <a href="<?php echo getAdminUrl('user', 'edit', $user['id']); ?>" class="btn btn-info">Edit</a>
                                        <a href="<?php echo getAdminUrl('user', 'delete', $user['id']); ?>" class="btn btn-danger">Delete</a>
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

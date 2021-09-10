<?php
    $userId = (!empty($_GET['param'])) ? $_GET['param'] : null;
    if (empty($userId)) {
        redirectUrl(getAdminUrl('user', 'list'));
    }

    $sql = "SELECT * FROM users WHERE id = $userId";
    $connect = connect_db();
    $user = mysqli_query($connect, $sql);
    close_db_connect($connect);
    if ($user->num_rows == 0) {
        redirectUrl(getAdminUrl('user', 'list'));
    }

    $user = mysqli_fetch_array($user);
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    User Management
                    <small>| Edit User</small>
                </h4>
            </div>
        </div>
        <form action="" class="mt-4" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="<?php echo $user['name']; ?>" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?php echo $user['email']; ?>" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number</label>
                <input type="tel" id="phone_number" value="<?php echo $user['phone_number']; ?>" name="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" value="<?php echo $user['address']; ?>" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" required id="role" class="form-control">
                    <option value="">-----Choose a role----</option>
                    <option value="1" <?php echo ($user['role'] == 1) ? 'selected' : null; ?> >ADMIN</option>
                    <option value="2" <?php echo ($user['role'] == 2) ? 'selected' : null; ?>>MANAGER</option>
                </select>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <div>
                <?php echo getAvatar($user['avatar']) ?>
            </div>

            <hr>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-dark" href="<?php echo getAdminUrl('user', 'list') ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $name = (!empty($_POST['name'])) ? $_POST['name'] : null;
        $email = (!empty($_POST['email'])) ? $_POST['email'] : null;
        $password = (!empty($_POST['password'])) ? $_POST['password'] : null;
        $passwordConfirmation = (!empty($_POST['password_confirmation'])) ? $_POST['password_confirmation'] : null;
        $phoneNumber = (!empty($_POST['phone_number'])) ? $_POST['phone_number'] : null;
        $address = (!empty($_POST['address'])) ? $_POST['address'] : null;
        $role = (!empty($_POST['role'])) ? $_POST['role'] : null;

        if (!empty($password)) {
            if ($password != $passwordConfirmation) {
                echo "<script>alert('Xac nhan password k chinh xac.')</script>";
                redirectUrl(getAdminUrl('user', 'edit', $userId));
            }

            $password = md5($password);
        }

        $connect = connect_db();
        $sql = "SELECT * FROM users WHERE email='$email' AND id != $userId";
        $user = mysqli_query($connect, $sql);
        close_db_connect($connect);
        if ($user->num_rows > 0) {
            echo "<script>alert('Email da ton tai.')</script>";
            redirectUrl(getAdminUrl('user', 'edit', $userId));
        }

        if (!in_array($role, ["1", "2"])) {
            echo "<script>alert('Chon cho dung role vao.')</script>";
            redirectUrl(getAdminUrl('user', 'edit', $userId));
        }

        //Upload image
        if (!empty($_FILES['avatar']['tmp_name'])) {
            if (!in_array($_FILES['avatar']['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {
                echo "<script>alert('Avatar phai la hinh anh.')</script>";
                redirectUrl(getAdminUrl('user', 'edit', $userId));
            }

            if ($_FILES['avatar']['size'] > 2048000) {
                echo "<script>alert('Kich thuoc file qua lon.')</script>";
                redirectUrl(getAdminUrl('user', 'edit', $userId));
            }

            move_uploaded_file($_FILES['avatar']['tmp_name'], '../public/images/' . $_FILES['avatar']['name']);
            $avatarUrl = BASE_URL . '/public/images/' . $_FILES['avatar']['name'];
        }

        $sql = "UPDATE users set name='$name', email='$email', phone_number='$phoneNumber', address='$address', role='$role'";
        if (!empty($password)) {
            $sql .= ", password='$password'";
        }
        if (!empty($avatarUrl)) {
            $sql .= ", avatar='$avatarUrl'";
        }

        $sql .= " WHERE id = $userId";
        $connect = connect_db();
        mysqli_query($connect, $sql);
        echo "<script>alert('Update user thanh cong.')</script>";
        redirectUrl(getAdminUrl('user', 'list'));
    }
    ?>

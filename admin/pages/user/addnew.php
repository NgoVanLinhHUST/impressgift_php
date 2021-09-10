<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    User Management
                    <small>| Add new User</small>
                </h4>
            </div>
        </div>
        <form action="" class="mt-4" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number</label>
                <input type="tel" id="phone_number" name="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" required id="role" class="form-control">
                    <option value="">-----Choose a role----</option>
                    <option value="1">ADMIN</option>
                    <option value="2">MANAGER</option>
                </select>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar" required>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-dark" href="<?php echo getAdminUrl('user', 'list') ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConfirmation = $_POST['password_confirmation'];
            $phoneNumber = $_POST['phone_number'];
            $address = $_POST['address'];
            $role = $_POST['role'];

            if ($password != $passwordConfirmation) {
                echo "<script>alert('Xac nhan password k chinh xac.')</script>";
                header("location: " . getAdminUrl('user', 'addnew'));
            }

            $password = md5($password);

            $connect = connect_db();
            $sql = "SELECT * FROM users WHERE email='$email'";
            $user = mysqli_query($connect, $sql);
            close_db_connect($connect);
            if ($user->num_rows > 0) {
                echo "<script>alert('Email da ton tai.')</script>";
                header("location: " . getAdminUrl('user', 'addnew'));
            }

            if (!in_array($role, ["1", "2"])) {
                echo "<script>alert('Chon cho dung role vao.')</script>";
                header("location: " . getAdminUrl('user', 'addnew'));
            }

            //Upload image
            if (!in_array($_FILES['avatar']['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {
                echo "<script>alert('Avatar phai la hinh anh.')</script>";
                header("location: " . getAdminUrl('user', 'addnew'));
            }

            if ($_FILES['avatar']['size'] > 2048000) {
                echo "<script>alert('Kich thuoc file qua lon.')</script>";
                header("location: " . getAdminUrl('user', 'addnew'));
            }

            move_uploaded_file($_FILES['avatar']['tmp_name'], '../public/images/' . $_FILES['avatar']['name']);
            $avatarUrl = BASE_URL . '/public/images/' . $_FILES['avatar']['name'];
            $sql = "INSERT INTO users (name, email, password, phone_number, address, role, avatar) VALUES ('$name', '$email', '$password', '$phoneNumber', '$address', '$role', '$avatarUrl')";
            $connect = connect_db();
            mysqli_query($connect, $sql);
            echo "<script>alert('Them user thanh cong.')</script>";
            header("location: " . getAdminUrl('user', 'list'));
        }
    ?>

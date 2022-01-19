<?php
session_start();
include('../include/connect.php');
$user = $_SESSION['admin'];
$output = '';
$sql = "SELECT * FROM admin WHERE username!='$user'";
$result = mysqli_query($conn, $sql);
$list = mysqli_fetch_all($result, MYSQLI_ASSOC);

$errors = array('username' => '', 'password' => '', 'img' => '');
$username = $password = $adminAdded = '';
if (isset($_POST['add'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }
    if (empty($_FILES['img']['name'])) {
        $errors['img'] = 'Image is required';
    }
    if (!array_filter($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $img = mysqli_real_escape_string($conn, $_FILES['img']['name']);

        $query = "INSERT INTO admin(username, password, profile) VALUES('$username', '$password', '$img') ";
        $result2 = mysqli_query($conn, $query);
        if ($result2) {
            move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
            $adminAdded = 'Admin Added successfully';
            header('Location: admin.php');

            // exit();
        } else {
            $adminAdded = 'Something wrong!';
        }
    }
}
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $img_to_delete = mysqli_real_escape_string($conn, $_POST['img_to_delete']);
    $q = "DELETE FROM admin WHERE id = $id_to_delete";
    if (mysqli_query($conn, $q)) {
        unlink("img/$img_to_delete");
        header('Location: admin.php');
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
</head>

<body>
    <?php
    include('../include/header.php');
    ?>
    <div class="container-fluid">
        <div class="col-mid-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                    include('sidenav.php');
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center">All Admins</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                    <?php
                                    if (mysqli_num_rows($result) < 1) : ?>
                                        <tr>
                                            <td class='text-center' colspan="3"> No New Admin</td>
                                        </tr>
                                    <?php endif ?>
                                    <?php
                                    foreach ($list as $row) :
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td>
                                                <form action="admin.php" method='POST'>
                                                    <input type="hidden" name='id_to_delete' value="<?php echo $row['id'] ?>">
                                                    <input type="hidden" name='img_to_delete' value="<?php echo $row['profile'] ?>">
                                                    <input type="submit" name='delete' value='Remove' class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>


                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">Add Admin</h5>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name='username' class="form-control" autocomplete="off" value='<?php echo htmlspecialchars($username); ?>'>
                                        <?php if ($errors['username']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['username']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name='password' class="form-control" value='<?php echo htmlspecialchars($password); ?>'>
                                        <?php if ($errors['password']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['password']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Add Image</label>
                                        <input type="file" name='img' class="form-control" autocomplete="off" value='<?php echo htmlspecialchars($img); ?>'>
                                        <?php if ($errors['img']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['img']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <input type="submit" class="btn btn-success" name="add" value="Add New Admin">
                                </form>
                                <?php if ($adminAdded) : ?>
                                    <div class='alert alert-danger center'><?php echo $adminAdded ?></div>
                                <?php else : ?>
                                    <div></div>
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include('include/connect.php');
session_start();
$errors = array('username' => '', 'password' => '');
$username = $password = $loggedIn = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }
    if (!array_filter($errors)) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            echo "<script>alert('You have logged in as an admin')</script>";
            $_SESSION['admin'] = $username;
            header("Location:admin/index.php");
            exit();
        } else {
            $loggedIn = 'Invalid username or password';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>

<body style="background-image: url(img/hospital.jpg); background-repeat:no-repeat; background-size:cover">
    <?php
    include('include/header.php');
    ?>
    <div style="margin-top: 60px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
            <h5 class="text-center">Admins Login</h5>
                <form action="admin-login.php" method="POST" class="my-2">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value='<?php echo htmlspecialchars($username); ?>' class="form-control" autocomplete="off" placeholder="Enter Username">
                        <?php if ($errors['username']) : ?>
                            <div class='alert alert-danger'><?php echo $errors['username']; ?></div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value='<?php echo htmlspecialchars($password); ?>' class="form-control">
                        <?php if ($errors['password']) : ?>
                            <div class='alert alert-danger'><?php echo $errors['password']; ?></div>
                        <?php endif ?>
                    </div>
                    <input type="submit" name="submit" class="btn btn-success" value="login">
                </form>
                <?php if ($loggedIn) : ?>
                    <div class='alert alert-danger center'><?php echo $loggedIn ?></div>
                <?php else : ?>
                    <div></div>
                <?php endif ?>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>
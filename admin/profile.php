<?php
session_start();
include('../include/connect.php');

$adminName = $_SESSION['admin'];
$sql = "SELECT * FROM admin WHERE username='$adminName'";
$result = mysqli_query($conn, $sql);
$adminData = mysqli_fetch_array($result);

if (isset($_POST['update'])) {
    $profile = $_FILES['profile']['name'];
    if (empty($profile)) {
        $errors['img'] = 'Image is required';
    } else {
        $sql = "UPDATE admin SET profile='$profile' WHERE username='$adminName'";
        if (mysqli_query($conn, $sql)) {
            unlink("img/" . $adminData['profile']);
            move_uploaded_file($_FILES['profile']['tmp_name'], "img/$profile");
            header('Location: profile.php');
        }
    }
}

$oldPass = $newPass = $confirmedPass = $uname = '';
if (isset($_POST['updateName'])) {
    $username = $_POST['username'];
    if (empty($username)) {
    } else {
        $sql = "UPDATE admin SET username='$username' WHERE username='$adminName'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['admin'] = $username;
            header('Location: profile.php');
        }
    }
}


$errors = array('oldPass' => '', 'newPass' => '', 'confirmedPass' => '');
if (isset($_POST['updatePass'])) {
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmedPassword = $_POST['confirmed-password'];
    $old = mysqli_query($conn, "SELECT * FROM admin WHERE username='$adminName'");
    $row = mysqli_fetch_array($old);
    $pass = $row['password'];
    if (empty($oldPassword)) {
        $errors['oldPass'] = "Enter Old Password";
    } else if (empty($newPassword)) {
        $errors['newPass'] = "Enter New Password";
    } else if (empty($confirmedPassword)) {
        $errors['confirmedPass'] = "Enter Confirmed Password";
    } else if ($oldPassword !== $pass) {
        $errors['oldPass'] = "Invalid Old Password";
    } else if ($newPassword !== $confirmedPassword) {
        $errors['confirmedPass'] = "New and Confirmed Passwords Are NOT Matched";
    }
    if (!array_filter($errors)) {
        $sql = "UPDATE admin SET password='$newPassword' WHERE username='$adminName'";
        if (mysqli_query($conn, $sql)) {
            header('Location: profile.php');
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
    <title>Admin Profile </title>
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
                    <div style="margin-top: 20px;"></div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo $adminData['username'] ?> Profile</h4>
                                <form action="profile.php" method="POST" enctype="multipart/form-data">
                                    <img src='<?php echo "img/" . $adminData['profile'] ?>' alt="admin-img" class="col-md-12" style="height: 250px;">
                                    <div class="form-group">
                                        <label>Update Profile</label>
                                        <input type="file" name="profile" class="form-control"><br>
                                        <input type="submit" name="update" value="Update" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="profile.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Update Username</label>
                                        <input type="text" name="username" class="form-control" autocomplete="off" value='<?php echo htmlspecialchars($uname); ?>'><br>
                                        <input type="submit" name="updateName" value="Update Username" class="btn btn-success">
                                    </div>
                                </form> <br>
                                <form action="profile.php" method="POST">
                                    <h5 class="text-center my-4">Update Password</h5>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old-password" class="form-control" value='<?php echo htmlspecialchars($oldPass); ?>' >
                                        <?php if ($errors['oldPass']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['oldPass']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new-password" class="form-control"  value='<?php echo htmlspecialchars($newPass); ?>' > 
                                        <?php if ($errors['newPass']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['newPass']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmed-password" class="form-control"  value='<?php echo htmlspecialchars($confirmedPass); ?>' >
                                        <?php if ($errors['confirmedPass']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['confirmedPass']; ?></div>
                                        <?php endif ?>
                                        <br>
                                        <input type="submit" name="updatePass" value="Update Password" class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
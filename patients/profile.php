<?php
session_start();
include('../include/connect.php');

$patientName = $_SESSION['patient'];
$sql = "SELECT * FROM patients WHERE username='$patientName'";
$result = mysqli_query($conn, $sql);
$patientData = mysqli_fetch_array($result);

if (isset($_POST['update-profile'])) {
    $profile = $_FILES['profile']['name'];
    if (empty($profile)) {
        $errors['img'] = 'Image is required';
    } else {
        $sql = "UPDATE patients SET profile='$profile' WHERE username='$patientName'";
        if (mysqli_query($conn, $sql)) {
            unlink("img/" . $patientData['profile']);
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
        $sql = "UPDATE patients SET username='$username' WHERE username='$patientName'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['patient'] = $username;
            header('Location: profile.php');
        }
    }
}


$errors = array('oldPass' => '', 'newPass' => '', 'confirmedPass' => '');
$changeSuccess = '';
if (isset($_POST['updatePass'])) {
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmedPassword = $_POST['confirmed-password'];
    $old = mysqli_query($conn, "SELECT * FROM patients WHERE username='$patientName'");
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
        $sql = "UPDATE patients SET password='$newPassword' WHERE username='$patientName'";
        if (mysqli_query($conn, $sql)) {
            $changeSuccess = 'Your password has changed successfully!';
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
    <title>Patient Profile </title>
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
                                <h4><?php echo $patientData['username'] ?> Profile</h4>
                                <form action="profile.php" method="POST" enctype="multipart/form-data">
                                    <img src='<?php echo "img/" . $patientData['profile'] ?>' alt="patient-img" class="col-md-12" style="height: 250px;">
                                    <br>
                                    <div class="form-group">
                                        <label>Update Profile</label>
                                        <input type="file" name="profile" class="form-control"><br>
                                        <input type="submit" name="update-profile" value="Update" class="btn btn-success">
                                    </div>
                                </form>
                                <div class="my-3">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="text-center" colspan="2">
                                                Details
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td><?php echo $patientData['firstName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td><?php echo $patientData['lastName'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>username</td>
                                            <td><?php echo $patientData['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $patientData['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo $patientData['gender'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?php echo $patientData['phone'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><?php echo $patientData['country'] ?></td>
                                        </tr>
                                    </table>
                                </div>
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
                                        <input type="password" name="old-password" class="form-control" value='<?php echo htmlspecialchars($oldPass); ?>'>
                                        <?php if ($errors['oldPass']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['oldPass']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new-password" class="form-control" value='<?php echo htmlspecialchars($newPass); ?>'>
                                        <?php if ($errors['newPass']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['newPass']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmed-password" class="form-control" value='<?php echo htmlspecialchars($confirmedPass); ?>'>
                                        <?php if ($errors['confirmedPass']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['confirmedPass']; ?></div>
                                        <?php endif ?>
                                        <br>
                                        <input type="submit" name="updatePass" value="Update Password" class="btn btn-info">
                                    </div>
                                </form>
                                <?php if ($changeSuccess) : ?>
                                    <div class='alert alert-danger center'><?php echo $changeSuccess ?></div>
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
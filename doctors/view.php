<?php
include('../include/connect.php');
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM patients WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $row = $list[0];
}
if (isset($_POST['update'])) {
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $sql = "UPDATE doctors SET salary='$salary' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location:edit.php?id=$id");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient</title>
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
                    <h4 class="text-center my-4">View Patient</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <img src="../patients/img/<?php echo $row['profile']?>" alt="patient-img" class="col-md-12 my-2" height="255px;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center" colspan="2">Patient Details</th>
                                    </tr>
                                    <tr>
                                        <td>First Name</td>
                                        <td><?php echo $row['firstName'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td><?php echo $row['lastName'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>username</td>
                                        <td><?php echo $row['username'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $row['gender'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $row['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo $row['country'] ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
include('../include/connect.php');
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctors WHERE id='$id'";
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
    <title>Edit Doctor</title>
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
                    <h4 class="text-center my-4">Edit Doctor</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Doctor Details</h5>
                            <h6 class="my-3">ID: <?php echo $row['id']; ?></h6>
                            <h6 class="my-3">First Name: <?php echo $row['firstName']; ?></h6>
                            <h6 class="my-3">Last Name: <?php echo $row['lastName']; ?></h6>
                            <h6 class="my-3">Username: <?php echo $row['username']; ?></h6>
                            <h6 class="my-3">Email: <?php echo $row['email']; ?></h6>
                            <h6 class="my-3">Phone Number: <?php echo $row['phone']; ?></h6>
                            <h6 class="my-3">Gender: <?php echo $row['gender']; ?></h6>
                            <h6 class="my-3">Country: <?php echo $row['country']; ?></h6>
                            <h6 class="my-3">Salary: <?php echo $row['salary']; ?></h6>
                            <h6 class="my-3">Date Registered: <?php echo $row['data_reg']; ?></h6>
                        </div>
                        <div class="col-md-4">
                            <h5>Update Salary</h5>
                            <form action="" method="POST">
                                <label>Enter Doctor's Salary</label>
                                <input type="number" name="salary" autocomplete="off" placeholder="Enter Doctor's Salary" class="form-control" value='<?php echo htmlspecialchars($salary); ?>'>
                                <input type="submit" name="update" class="btn btn-info my-3" value="update salary">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
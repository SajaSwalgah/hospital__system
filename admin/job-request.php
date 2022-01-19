<?php
include('../include/connect.php');
session_start();
$sql = "SELECT * FROM doctors WHERE status='Pending' ORDER BY data_reg ASC";
$res = mysqli_query($conn, $sql);
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);

if (isset($_POST['approve'])) {
    $id_to_approve = mysqli_real_escape_string($conn, $_POST['id_to_approve']);
    $q = "UPDATE doctors SET status='Approved' WHERE id = $id_to_approve";
    if (mysqli_query($conn, $q)) {
        header('Location: job-request.php');
    }
}
if (isset($_POST['reject'])) {
    $id_to_reject = mysqli_real_escape_string($conn, $_POST['id_to_reject']);
    $q = "UPDATE doctors SET status='Rejected' WHERE id = $id_to_reject";
    if (mysqli_query($conn, $q)) {
        header('Location: job-request.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Request</title>
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
                    <h5 class="text-center">Job Request</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Country</th>
                            <th>Date Registered</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        if (mysqli_num_rows($res) < 1) : ?>
                            <tr>
                                <td class='text-center' colspan="10"> No Jobs Requested Yet!</td>
                            </tr>
                        <?php endif ?>
                        <?php
                        foreach ($list as $row) :
                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['firstName'] ?></td>
                                <td><?php echo $row['lastName'] ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['country'] ?></td>
                                <td><?php echo $row['data_reg'] ?></td>
                                <td>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 my-3 ">
                                                <form action="job-request.php" method='POST'>
                                                    <input type="hidden" name='id_to_approve' value="<?php echo $row['id'] ?>">
                                                    <input type="submit" name='approve' value='Approve' class="btn btn-success">
                                                </form>
                                            </div>
                                            <div class="col-md-6 my-3">
                                                <form action="job-request.php" method='POST'>
                                                    <input type="hidden" name='id_to_reject' value="<?php echo $row['id'] ?>">
                                                    <input type="submit" name='reject' value='Reject' class="btn btn-danger">
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
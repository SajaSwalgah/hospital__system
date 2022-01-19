<?php
include('../include/connect.php');
session_start();
$sql = "SELECT * FROM patients ORDER BY date_reg ASC";
$res = mysqli_query($conn, $sql);
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
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
                    <h5 class="text-center">Total Patients</h5>
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
                                <td class='text-center' colspan="10"> No Patients Registered Yet!</td>
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
                                <td><?php echo $row['date_reg'] ?></td>
                                <td>
                                    <a href="view.php?id=<?php echo $row['id'] ?>"><button class="btn btn-info">View</button></a>
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
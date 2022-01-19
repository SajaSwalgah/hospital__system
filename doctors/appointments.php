<?php
include('../include/connect.php');
session_start();
$sql = "SELECT * FROM appointment WHERE status='Pending' ORDER BY date_booked ASC";
$res = mysqli_query($conn, $sql);
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
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
                    <h5 class="text-center">Appointment</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Appointment Date</th>
                            <th>Symptoms</th>
                            <th>Date Registered</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        if (mysqli_num_rows($res) < 1) : ?>
                            <tr>
                                <td class='text-center' colspan="10"> No Appointments Booked Yet!</td>
                            </tr>
                        <?php endif ?>
                        <?php
                        foreach ($list as $row) :
                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['firstName'] ?></td>
                                <td><?php echo $row['lastName'] ?></td>
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['appointment_date'] ?></td>
                                <td><?php echo $row['symptoms'] ?></td>
                                <td><?php echo $row['date_booked'] ?></td>
                                <td>
                                    <a href="discharge.php?id=<?php echo $row['id'] ?>"><button class="btn btn-info">Check</button></a>                        
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
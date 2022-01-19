<?php
session_start();
include('../include/connect.php');


$patients = mysqli_query($conn, "SELECT * FROM patients");
$patientsNum = mysqli_num_rows($patients);

$appointments = mysqli_query($conn, "SELECT * FROM appointment");
$appointmentsNum = mysqli_num_rows($appointments);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors Dashboard</title>
</head>

<body>
    <?php
    include('../include/header.php');
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                    include('sidenav.php');
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        <h5 class="text-center">Doctors Dashboard</h5>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 my-2 bg-info mx-2" style="height: 150px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="text-white my-4">My Profile</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="profile.php"><i class="fa fa-user-circle fa-3x my-4" style="color: white;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-2 bg-warning mx-2" style="height: 150px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $patientsNum ?></h5>
                                                <h5 class="text-white">Total</h5>
                                                <h5 class="text-white">Patients</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="patients.php"><i class="fa fa-procedures fa-3x my-4" style="color: white;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-2 bg-success mx-2" style="height: 150px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="text-white my-2" style="font-size: 30px;"><?php echo $appointmentsNum ?></h5>
                                                <h5 class="text-white">Total</h5>
                                                <h5 class="text-white">Appointments</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="appointments.php"><i class="fa fa-calendar fa-3x my-4" style="color: white;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
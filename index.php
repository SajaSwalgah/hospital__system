<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital System</title>
</head>

<body>
    <?php
    include('include/header.php')
    ?>
    <div style="margin-top: 60px;"></div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 mx-1 shadow">
                    <img src="img/info.jpg" alt="more-info" style="width: 100%; height: 190px;">
                    <h5 class="text-center">For More Information: </h5>
                    <a href=""><button class="btn btn-success my-3" style="margin-left: 30%;">More Info</button></a>

                </div>
                <div class="col-md-3 mx-1 shadow">
                    <img src="img/patient.jpg" alt="patient" style="width: 100%; height: 190px;">
                    <h5 class="text-center">Create Account to take care of u </h5>
                    <a href="patient-login.php"><button class="btn btn-success my-3" style="margin-left: 30%;">Create Account</button></a>

                </div>
                <div class="col-md-3 mx-1 shadow">
                    <img src="img/doctors.jpg" alt="doctors" style="width: 100%; height: 190px;">
                    <h5 class="text-center">We are looking fo doctors </h5>
                    <a href="doctor-login.php"><button class="btn btn-success my-3" style="margin-left: 30%;">Apply Now</button></a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
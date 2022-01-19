<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" type="text/css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" type="text/javascript"></script>

    <title>Hospital System</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <a href="index.php">
            <h5 class="text-white">Hospital System</h5>
        </a>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['admin'])) { ?>
                <li class="nav-item"><a href="../admin/profile.php" class="nav-link text-white"><?php echo $_SESSION['admin'] ?></a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout </a></li>
            <?php }
            if (isset($_SESSION['doctor'])) { ?>
                <li class="nav-item"><a href="../doctors/profile.php" class="nav-link text-white"><?php echo $_SESSION['doctor'] ?></a></li>
                <li class="nav-item"><a href="../doctors/logout.php" class="nav-link text-white">Logout </a></li>
            <?php }
            if (isset($_SESSION['patient'])) { ?>
                <li class="nav-item"><a href="../patients/profile.php" class="nav-link text-white"><?php echo $_SESSION['patient'] ?></a></li>
                <li class="nav-item"><a href="../patients/logout.php" class="nav-link text-white">Logout </a></li>
            <?php } else { ?>
                <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="admin-login.php" class="nav-link text-white">Admin</a></li>
                <li class="nav-item"><a href="doctor-login.php" class="nav-link text-white">Doctor</a></li>
                <li class="nav-item"><a href="patient-login.php" class="nav-link text-white">Patient</a></li>
            <?php } ?>
        </ul>
    </nav>
</body>

</html>
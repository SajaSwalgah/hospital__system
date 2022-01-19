<?php
session_start();
include('../include/connect.php');

$sql = "SELECT * FROM admin";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

$job = mysqli_query($conn, "SELECT * FROM doctors WHERE status='Pending'");
$jobNum = mysqli_num_rows($job);

$doctors = mysqli_query($conn, "SELECT * FROM doctors WHERE status='Approved'");
$doctorsNum = mysqli_num_rows($doctors);

$errors = array('title' => '', 'message' => '');
$title = $message = $sendReport = '';
if (isset($_POST['send'])) {
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required';
    }
    if (empty($_POST['message'])) {
        $errors['message'] = 'Message is required';
    }
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if (!array_filter($errors)) {
        $username = $_SESSION['patient'];

        $query = "INSERT INTO report(title, message, username, date_created) VALUES('$title', '$message', '$username', NOW())";
        $result2 = mysqli_query($conn, $query);
        if ($result2) {
            $sendReport = 'The Report Has Sent!';
        } else {
            $sendReport = 'Something wrong!';
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
    <title>Patients Dashboard</title>
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
                        <h5 class="text-center">Patients Dashboard</h5>
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
                                <div class="col-md-3 my-2 bg-success mx-2" style="height: 150px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="text-white my-4">Book Appointment</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="appointment.php"><i class="fa fa-calendar fa-3x my-4" style="color: white;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-2 bg-warning mx-2" style="height: 150px;">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="text-white my-4">My Invoices</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="invoice.php"><i class="fa fa-file-invoice-dollar fa-3x my-4" style="color: white;"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 jumbotron bg-info my-5">
                                    <h5 class="text-center">Send A Report</h5>
                                    <form method="POST">
                                        <label>Title</label>
                                        <input value='<?php echo htmlspecialchars($title); ?>' type="text" name="title" autocomplete="off" placeholder="Enter Report Title" class="form-control">
                                        <?php if ($errors['title']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['title']; ?></div>
                                        <?php endif ?>
                                        <label>Message</label>
                                        <input value='<?php echo htmlspecialchars($message); ?>' type="text" name="message" autocomplete="off" placeholder="Enter a Message" class="form-control">
                                        <?php if ($errors['message']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['message']; ?></div>
                                        <?php endif ?>
                                        <input type="submit" name="send" value="Send Report" class="btn btn-success my-2">
                                    </form>
                                    <?php if ($sendReport) : ?>
                                        <div class='alert alert-danger center'><?php echo $sendReport ?></div>
                                    <?php else : ?>
                                        <div></div>
                                    <?php endif ?>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
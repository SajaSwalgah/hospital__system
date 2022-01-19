<?php
include('../include/connect.php');
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointment WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $row = $list[0];
}
$errors = array('fee' => '', 'description' => '');
$fee = $description = $invoiceSent = '';
if (isset($_POST['send'])) {
    $exactID = $id;
    if (empty($_POST['fee'])) {
        $errors['fee'] = 'Fee is required';
    }
    if (empty($_POST['description'])) {
        $errors['description'] = 'Description is required';
    }
    $fee = mysqli_real_escape_string($conn, $_POST['fee']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if (!array_filter($errors)) {
        $doctor = $_SESSION['doctor'];
        $patient = $row['firstName'];
        $query = "INSERT INTO incomes(doctor, patient, date_discharge, amount_paid, description)VALUES('$doctor','$patient', NOW(), '$fee', '$description')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $invoiceSent = 'You have sent an Invoice';
            echo "<script> alert($invoiceSent) </script>";
            header("Location:discharge.php?id=$id");
        } else {
            $invoiceSent = 'Invalid username or password';
            echo "<script> alert($invoiceSent) </script>";
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
    <title>Check Patient Appointment</title>
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
                    <h4 class="text-center my-4">Total Appointment</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center" colspan="2">Appointment Details</th>
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
                                        <td>Gender</td>
                                        <td><?php echo $row['gender'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo $row['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Appointment Date</td>
                                        <td><?php echo $row['appointment_date'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Symptoms</td>
                                        <td><?php echo $row['symptoms'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center my-1">Invoices</h5>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label>Fee</label>
                                        <input type="number" name="fee" value='<?php echo htmlspecialchars($fee); ?>' class="form-control" autocomplete="off" placeholder="Enter Fee">
                                        <?php if ($errors['fee']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['fee']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="description" name="description" value='<?php echo htmlspecialchars($description); ?>' class="form-control" autocomplete="off" placeholder="Enter Description">
                                        <?php if ($errors['description']) : ?>
                                            <div class='alert alert-danger'><?php echo $errors['description']; ?></div>
                                        <?php endif ?>
                                    </div>
                                    <input type="submit" name="send" class="btn btn-success" value="Send">
                                </form>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

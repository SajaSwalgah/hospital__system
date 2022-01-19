<?php
session_start();
include('../include/connect.php');
$errors = array('date' => '', 'symptoms' => '');
$date = $symptoms = $booked = '';
if (isset($_POST['book'])) {
    if (empty($_POST['date'])) {
        $errors['date'] = 'date is required';
    }
    if (empty($_POST['symptoms'])) {
        $errors['symptoms'] = 'Symptoms are required';
    }
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $symptoms = mysqli_real_escape_string($conn, $_POST['symptoms']);
    if (!array_filter($errors)) {
        $username = $_SESSION['patient'];
        $sql = "SELECT * FROM patients WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_array($result);
            $firstName = $res['firstName'];
            $lastName = $res['lastName'];
            $gender = $res['gender'];
            $phone = $res['phone'];
            $date = $_POST['date'];
            $symptoms = $_POST['symptoms'];
            $query = "INSERT INTO appointment(firstName, lastName, gender, phone, appointment_date, symptoms, status, date_booked)
            VALUES('$firstName', '$lastName', '$gender', '$phone', '$date', '$symptoms', 'Pending',NOW())";
            $result2 = mysqli_query($conn, $query);
            if ($result2) {
                $booked = "You Have Booked an Appointment Successfully at $date";
            } else {
                $booked = "Something Went Wrong!";
            }
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
    <title>Book Appointment</title>
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
                <div class="col-md-10 my-5">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 jumbotron">
                                    <h5 class="text-center">Book Appointment</h5>
                                    <form action="appointment.php" method="POST" class="my-2">
                                        <div class="form-group">
                                            <label>Appointment Date</label>
                                            <input type="date" name="date" value='<?php echo htmlspecialchars($date); ?>' class="form-control" autocomplete="off" placeholder="Enter Appointment Date">
                                            <?php if ($errors['date']) : ?>
                                                <div class='alert alert-danger'><?php echo $errors['date']; ?></div>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Symptoms</label>
                                            <input type="text" name="symptoms" value='<?php echo htmlspecialchars($symptoms); ?>' class="form-control" autocomplete="off" placeholder="Enter Symptoms">
                                            <?php if ($errors['symptoms']) : ?>
                                                <div class='alert alert-danger'><?php echo $errors['symptoms']; ?></div>
                                            <?php endif ?>
                                        </div>
                                        <input type="submit" name="book" class="btn btn-info" value="Book Appointment">
                                    </form>
                                    <?php if ($booked) : ?>
                                        <div class='alert alert-danger center'><?php echo $booked ?></div>
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
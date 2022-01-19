<?php
include('include/connect.php');
session_start();
$errors = array('firstName' => '', 'lastName' => '', 'username' => '', 'email' => '', 'phone' => '', 'gender' => '', 'country' => '', 'password' => '', 'confPassword' => '');
$firstName = $lastName = $username = $email = $phone = $gender = $country = $password = $confPassword = $addedDoctor = '';
if (isset($_POST['apply'])) {
    if (empty($_POST['firstName'])) {
        $errors['firstName'] = 'FirstName is required';
    }
    if (empty($_POST['lastName'])) {
        $errors['lastName'] = 'LastName is required';
    }
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required';
    }
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone is required';
    }
    if (empty($_POST['gender'])) {
        $errors['gender'] = 'Gender is required';
    }
    if (empty($_POST['country'])) {
        $errors['country'] = 'Country is required';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required';
    }
    if (empty($_POST['confPassword'])) {
        $errors['confPassword'] = 'Confirm Password is required';
    } else if ($_POST['password'] !== $_POST['confPassword']) {
        $errors['confPassword'] = "Password and Confirmed Password Are NOT Matched";
    }
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confPassword = mysqli_real_escape_string($conn, $_POST['confPassword']);
    if (!array_filter($errors)) {
        $sql = "SELECT * FROM doctors WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $addedDoctor = "This Account exist";
        } else {
        $query = "INSERT INTO doctors(firstName, lastName, username, email, gender, phone, country, password, salary, data_reg, profile, status)
            VALUES('$firstName', '$lastName', '$username', '$email', '$gender', '$phone', '$country', '$password', '0', NOW(), 'Pending', 'doctor.jpg')";
        $result2 = mysqli_query($conn, $query);
        if ($result2) {
            $addedDoctor = "You Have Successfully Applied";
            header('Location:doctor-login.php');
        } else {
            $addedDoctor = "Something Went Wrong!";
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
    <title>Apply Now</title>
</head>

<body style="background-image: url(img/doctors.jpg); background-repeat:no-repeat; background-size:cover">
    <?php
    include('include/header.php');
    ?>
    <div style="margin-top: 60px;"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 jumbotron">
                    <h5 class="text-center">Apply Now</h5>
                    <form action="apply.php" method="POST" class="my-2">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstName" value='<?php echo htmlspecialchars($firstName); ?>' class="form-control" autocomplete="off" placeholder="Enter First Name">
                            <?php if ($errors['firstName']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['firstName']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastName" value='<?php echo htmlspecialchars($lastName); ?>' class="form-control" autocomplete="off" placeholder="Enter Last Name">
                            <?php if ($errors['lastName']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['lastName']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value='<?php echo htmlspecialchars($username); ?>' class="form-control" autocomplete="off" placeholder="Enter Username">
                            <?php if ($errors['username']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['username']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value='<?php echo htmlspecialchars($email); ?>' class="form-control" autocomplete="off" placeholder="Enter Email">
                            <?php if ($errors['email']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['email']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                        <?php echo htmlspecialchars($gender); ?>
                            <label>Select Gender</label>
                            <select name="gender" id="" class="form-control" value='<?php echo htmlspecialchars($gender); ?>'>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <?php if ($errors['gender']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['gender']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="phone" value='<?php echo htmlspecialchars($phone); ?>' class="form-control" autocomplete="off" placeholder="Enter Phone Number">
                            <?php if ($errors['phone']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['phone']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Select Country</label>
                            <select name="country" value='<?php echo htmlspecialchars($country); ?>' class="form-control">
                                <option value="">Select Country</option>
                                <option value="Jordan">Jordan</option>
                                <option value="KSA">KSA</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Egypt">Egypt</option>
                                <option value="UAE">UAE</option>
                            </select>
                            <?php if ($errors['country']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['country']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" value='<?php echo htmlspecialchars($password); ?>' class="form-control">
                            <?php if ($errors['password']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['password']; ?></div>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confPassword" value='<?php echo htmlspecialchars($confPassword); ?>' class="form-control">
                            <?php if ($errors['confPassword']) : ?>
                                <div class='alert alert-danger'><?php echo $errors['confPassword']; ?></div>
                            <?php endif ?>
                        </div>
                        <input type="submit" name="apply" class="btn btn-success" value="Apply now">
                        <p>You already have an account?? <a href="doctor-login.php">Login In</a></p>
                    </form>
                    <?php if ($addedDoctor) : ?>
                        <div class='alert alert-danger center'><?php echo $addedDoctor ?></div>
                    <?php else : ?>
                        <div></div>
                    <?php endif ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>

</html>
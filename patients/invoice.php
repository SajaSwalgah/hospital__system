<?php
session_start();
include('../include/connect.php');

$patientName = $_SESSION['patient'];
$sql = "SELECT * FROM patients WHERE username='$patientName'";
$result = mysqli_query($conn, $sql);
$patientData = mysqli_fetch_array($result);
$firstName = $patientData['firstName'];
$query = "SELECT * FROM incomes WHERE patient='$firstName'";
$res = mysqli_query($conn, $query);
$incomeData = mysqli_fetch_array($res);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Invoices </title>
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
                    <h5 class="text-center my-2">My Invoices</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Date Discharge</th>
                            <th>Amount Paid</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if (mysqli_num_rows($res) < 1) : ?>
                            <tr>
                                <td class='text-center' colspan="6"> No Invoices Yet!</td>
                            </tr>
                        <?php endif ?>

                        <tr>
                            <td><?php echo $incomeData['id'] ?></td>
                            <td><?php echo $incomeData['doctor'] ?></td>
                            <td><?php echo $incomeData['patient'] ?></td>
                            <td><?php echo $incomeData['date_discharge'] ?></td>
                            <td><?php echo $incomeData['amount_paid'] ?></td>
                            <td><?php echo $incomeData['description'] ?></td>

                            <td>
                                <a href="view.php?id=<?php echo $incomeData['id'] ?>"><button class="btn btn-info">View</button></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();
include('../include/connect.php');
$sql = "SELECT * FROM incomes";
$res =  mysqli_query($conn, $sql);
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incomes</title>
</head>

<body>
    <?php
    include('../include/header.php');
    ?>
    <div class="container-fluid">
        <div class="com-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px;">
                    <?php
                    include('sidenav.php');
                    ?>
                </div>
                <div class="col-md-10" style="margin-left:-30px;">
                    <h5 class="text-center my-2">Total Reports</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Date Discharge</th>
                            <th>Amount Paid</th>
                        </tr>
                        <?php
                        if (mysqli_num_rows($res) < 1) : ?>
                            <tr>
                                <td class='text-center' colspan="10"> No Patients Discharged Yet!</td>
                            </tr>
                        <?php endif ?>
                        <?php
                        foreach ($list as $row) :
                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['doctor'] ?></td>
                                <td><?php echo $row['patient'] ?></td>
                                <td><?php echo $row['date_discharge'] ?></td>
                                <td><?php echo $row['amount_paid'] ?></td>
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
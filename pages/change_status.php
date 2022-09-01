<?php
include '../includes/css_files.php';
include '../includes/header.php';

$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];
$terminal = $_SESSION['terminal'];
$state = $_SESSION['state'];
$booking_id = $_GET['id'];
//print_r($terminal);
($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard user</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> My Bookings</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Manage Staffs
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>

                                                    <th>Booking ID</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>

                                                    <th>Booking ID</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                </tr>
                                            </tfoot>

                                            <?php $sql = $conn->query("SELECT * FROM ((((dbooking JOIN dstaff_registration ON dstaff_registration.dstaff_id = dbooking.staff_id)
                                                        JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage) 
                                                        JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id WHERE dbooking_id = '$booking_id' ");
                                                        $row = $sql->fetch_assoc();
                                                        $package_id = $row['dpackage_id'];
                                                        //print_r($id);

                                                        
                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) { 
                                                            $sql1 = $conn->query("SELECT * FROM dpackage_registration JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id WHERE dpackage_id = '$package_id'");
                                                            $row1 = $sql1->fetch_assoc();?>
                                            <tr>
                                                <td>1</td>
                                                <td><?php echo $row['dbooking_id'] ?></td>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal']. ' '. 'station' ?></td>
                                                <td><?php echo $row1['dterminal']. ' '.'station' ?></td>
                                                <td><?php echo $row['dbooking_status'] ?></td>
                                                <td><?php echo $row['dbooking_date'] ?></td>

                                            </tr>
                                            <?php   }?>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="text-center">Are you sure you want to transit this package</h6>
                                    <div style="display: flex; justify-content:center;">
                                        <a style="margin: 10px" class="btn btn-primary btn-sm"
                                            href="../process/change_status.php?id=<?php echo $booking_id ?>">Transit</a>
                                        <a style="margin: 10px" class="btn btn-danger btn-sm"
                                            href="view_bookings.php">Back</a>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>
        </main>
        <?php include '../includes/footer.php' ?>
    </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>
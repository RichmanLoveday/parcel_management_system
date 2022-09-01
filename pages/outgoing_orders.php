<?php
include '../includes/css_files.php';
include '../includes/header.php';

$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];
$terminal = $_SESSION['terminal'];
$state = $_SESSION['state'];
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
                                            <?php
                                            if($position == 'Office-staff') { ?>
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
                                                    <th>Terminal</th>
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
                                                    <th>Terminal</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                </tr>
                                            </tfoot>

                                            <?php $sql = $conn->query("SELECT * FROM ((((dbooking JOIN dstaff_registration ON dstaff_registration.dstaff_id = dbooking.dstaff_id)
                                                        JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage_id) 
                                                        JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id WHERE dterminal_id = '$terminal'");
                                                        
                                                         if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            $num = 0;
                                                            while($row = $sql->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <td><?php echo $row['dbooking_id'] ?></td>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dstate_name'] ?></td>
                                                <td><?php echo $row['dterminal'] ?></td>

                                                <?php if($row['dbooking_status'] == 'canceled') { ?>
                                                <td><?php echo $row['dbooking_status'] ?></td>
                                                <?php } else { ?>
                                                <td><?php echo 'boooked' ?></td>
                                                <?php }?>

                                                <td><?php echo $row['dbooking_date'] ?></td>
                                                <td>
                                                    <a href="../cancel_package.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-danger btn-sm">Cancel</a>
                                                </td>
                                            </tr>
                                            <?php $num++;  }
                                                        }


                                                    ?>

                                            <?php } elseif($position == 'admin') { ?>

                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>

                                                    <th>Booking ID</th>
                                                    <th>Staff ID</th>
                                                    <th>Vehicle ID</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>Terminal</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Booking ID</th>
                                                    <th>Staff ID</th>
                                                    <th>Vehicle ID</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping fee</th>
                                                    <th>From</th>
                                                    <th>Terminal</th>
                                                    <th>Terminal</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                </tr>
                                            </tfoot>

                                            <?php
                                                        $sql = $conn->query("SELECT * FROM (((((dbooking JOIN dstaff_registration ON dstaff_registration.dstaff_id = dbooking.dstaff_id)
                                                        JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage_id) 
                                                        JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id)");


                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            $num = 0;
                                                            while($row = $sql->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <td><?php echo $row['dbooking_id'] ?></td>
                                                <td><?php echo $row['dstaff_id']?></td>
                                                <td><?php echo $row['dvehicle_id']?></td>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dstate_name'] ?></td>
                                                <td><?php echo $row['dterminal'] ?></td>
                                                <td><?php echo $row['dbooking_status'] ?></td>
                                                <td><?php echo $row['dregdate'] ?></td>
                                            </tr>
                                            <?php $num++; } }
                                                        }
                                                    ?>
                                        </table>
                                    </div>
                                </div>
                                <h5>Today Sales: $500</h5>
                                <h5>Total Sales: $10000</h5>
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
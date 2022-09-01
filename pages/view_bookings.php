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
    <title>Manage Bookings</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> My Bookings</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage bookings</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <?php echo isset($_SESSION['transit']) ? $_SESSION['transit'] :  ' ' ?>
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
                                                    <!-- <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th> -->
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Booking ID</th>
                                                    <!-- <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th> -->
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <?php 
                                                        $sql = $conn->query("SELECT * FROM ((((dbooking JOIN dstaff_registration ON dstaff_registration.dstaff_id = dbooking.staff_id)
                                                        JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage) 
                                                        JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id WHERE dterminal_id = '$terminal'");
                                                        //print_r($id);

                                                        
                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            
                                                            $num = 0;
                                                            while($row = $sql->fetch_assoc()) { 
                                                            $package_id = $row['dpackage_id'];

                                                            $sql1 = $conn->query("SELECT * FROM dpackage_registration JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id WHERE dpackage_id = '$package_id'");
                                                            $row1 = $sql1->fetch_assoc();?>
                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <td><?php echo $row['dbooking_id']?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row1['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php 
                                                        if($row['dbooking_status'] == 'booked') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Booked</a>
                                                    <?php } elseif($row['dbooking_status'] == 'in-transit') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Shipped</a>

                                                    <?php } elseif($row['dbooking_status'] == 'arrived') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Arrived</a>

                                                    <?php } elseif($row['dbooking_status'] == 'canceled') { ?>
                                                    <a href="#" class="btn btn-danger btn-sm disabled">canceled</a>

                                                    <?php } else { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Delivered</a>

                                                    <?php }
                                                ?>
                                                </td>
                                                <td><?php echo $row['dbooking_date'] ?></td>
                                                <td>
                                                    <?php if($row['dbooking_status'] != 'booked') { ?>
                                                    <a href="package_detail.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-primary btn-sm">View</a>

                                                    <?php  } else { ?>

                                                    <a href="cancel_booking.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-danger btn-sm">Cancel</a>
                                                    <a href="change_status.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-primary btn-sm">Transit</a>


                                                    <?php     } ?>

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
                                                    <th>Booked By</th>
                                                    <th>Vehicle No</th>
                                                    <!-- <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th> -->
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Booking ID</th>
                                                    <th>Booked By</th>
                                                    <th>Vehicle No</th>
                                                    <!-- <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th> -->
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>Terminal</th>
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <?php
                                                        $sql = $conn->query("SELECT * FROM ((((((dbooking JOIN dstaff_registration ON dstaff_registration.dstaff_id = dbooking.staff_id)
                                                        JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage) 
                                                        JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id)
                                                        JOIN dvehicle_registration ON dvehicle_registration.dvehicle_id = dbooking.dvehicle_id) ");
                                                        

                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            $num = 0;
                                                            while($row = $sql->fetch_assoc()) { 
                                                            $staff_id = $row['staff_id'];
                                                            $package_id = $row['dpackage_id'];

                                                            $sql1 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$staff_id'");
                                                            $row1 = $sql1->fetch_assoc();

                                                            $sql2 = $conn->query("SELECT * FROM dpackage_registration JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id WHERE dpackage_id = '$package_id'");
                                                            $row2 = $sql2->fetch_assoc();
                                                            ?>
                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <td><?php echo $row['dbooking_id'] ?></td>
                                                <?php if($staff_id == $id) { ?>
                                                <td><?php echo $row1['dposition']?></td>
                                                <?php   } else { ?>
                                                <td><?php echo $row1['dfname']. ' '.$row1['dlname']?></td>

                                                <?php   } ?>

                                                <td><?php echo $row['dvehicle_num']?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row2['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php 
                                                        if($row['dbooking_status'] == 'booked') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Booked</a>

                                                    <?php } elseif($row['dbooking_status'] == 'in-transit') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Shipped</a>

                                                    <?php } elseif($row['dbooking_status'] == 'arrived') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Arrived</a>

                                                    <?php } elseif($row['dbooking_status'] == 'canceled') { ?>
                                                    <a href="#" class="btn btn-danger btn-sm disabled">canceled</a>

                                                    <?php } else { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Delivered</a>

                                                    <?php }
                                                ?>
                                                </td>
                                                <td><?php echo $row['dbooking_date'] ?></td>
                                                <td>
                                                    <?php if($row['dbooking_status'] != 'booked') { ?>
                                                    <a href="package_detail.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-primary btn-sm">View</a>

                                                    <?php  } else { ?>

                                                    <a href="cancel_booking.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-danger btn-sm">Cancel</a>
                                                    <a href="change_status.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-primary btn-sm">Transit</a>


                                                    <?php     } ?>

                                                </td>
                                            </tr>
                                            <?php $num++; } }
                                                        }
                                                    ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </main>
        <?php include '../includes/footer.php';
                unset($_SESSION['transit'])?>
    </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>
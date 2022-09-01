<?php
include '../includes/css_files.php';
include '../includes/header.php';

$position = $_SESSION['position'];
$package_id = $_GET['id'];
$booking_id = $_GET['id'];
//print_r($terminal);
($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Package Information</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> Package Information</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <?php if($position == 'admin' || $position == 'Office-staff') { ?>

                    <li class="breadcrumb-item"><a href="view_bookings.php">View bookings</a></li>

                    <?php  } else { ?>
                    <li class="breadcrumb-item"><a href="deliveries.php">Manage package</a></li>

                    <?php   } ?>
                    <li class="breadcrumb-item active">View package</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        View Package
                                    </div>
                                    <div class="card-body">
                                        <?php if($position == 'admin' || $position == 'Office-staff') { ?>
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">

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

                                            <?php $sql = $conn->query("SELECT * FROM (((dbooking
                                                JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage) 
                                                JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id WHERE dbooking_id = '$booking_id'");
                                                $row = $sql->fetch_assoc();
                                                $package_id = $row['dpackage_id'];
                                                //print_r($id);

                                                
                                                if($conn->connect_error) {
                                                    die("Connection Error: ".$conn->connect_error);
                                                } elseif($sql == TRUE) { 
                                                    $sql1 = $conn->query("SELECT * FROM dpackage_registration JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id WHERE dpackage_id = '$package_id'");
                                                    $row1 = $sql1->fetch_assoc(); ?>
                                            <tr>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row1['dterminal']. ' '. 'station' ?></td>
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
                                            </tr>
                                            <?php   }?>
                                        </table>

                                        <?php    } else { ?>
                                        <table id="datatablesSimple">

                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>Fulfilment ID</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Reg Date</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>Fulfilment ID</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Reg Date</th>
                                                </tr>
                                            </tfoot>

                                            <?php $sql = $conn->query("SELECT * FROM ((dpackage_registration 
                                                        JOIN duser_registration ON duser_registration.duser_id = dpackage_registration.dsender_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dpackage_registration.dstate_id WHERE dpackage_id = '$package_id' ");
                                                        $row = $sql->fetch_assoc();
                                                        $package_id = $row['dpackage_id'];
                                                        //print_r($id);

                                                        
                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) { 
                                                            $sql = $conn->query("SELECT * FROM ((dbooking 
                                                            JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                            JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id) WHERE dpackage = '$package_id'");
                                                            $row1 = $sql->fetch_assoc(); 
                                                            ?>
                                            <tr>

                                                <?php
                                                                if(isset($row1['dbooking_id'])) { ?>
                                                <td><?php echo $row1['dbooking_id']?></td>
                                                <?php    } else { ?>
                                                <td>N/A</td>
                                                <?php   }?>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <?php
                                                                    if(isset($row1['dweight'])) { ?>
                                                <td><?php echo $row1['dweight'].'kg' ?></td>
                                                <?php    } else { ?>
                                                <td>N/A</td>
                                                <?php   }?>


                                                <?php
                                                                    if(isset($row1['damount'])) { ?>
                                                <td><?php echo '$'. $row1['damount']?></td>
                                                <?php    } else { ?>
                                                <td>N/A</td>
                                                <?php   }?>


                                                <?php
                                                                    if(isset($row1['dpackage']) == $package_id) { ?>
                                                <td><?php echo $row1['dterminal']. ' '. 'station' ?></td>
                                                <?php    } else { ?>
                                                <td>N/A</td>
                                                <?php   }?>

                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>

                                                <td><?php 
                                                        if(isset($row1['dbooking_status'])) { 
                                                                            
                                                          if($row1['dbooking_status'] == 'booked' || $row1['dbooking_status'] == 'in-transit'   || $row1['dbooking_status'] == 'arrived') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Approved</a>

                                                    <?php } elseif($row1['dbooking_status'] == 'canceled' || $row['dpackage_status'] == 'canceled') { ?>
                                                    <a href="#" class="btn btn-danger btn-sm disabled">canceled</a>

                                                    <?php } else { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Delivered</a>

                                                    <?php } ?>

                                                    <?php } else { ?>
                                                    <a href="#"
                                                        class="btn btn-danger btn-sm disabled"><?php echo 'Pending' ?></a>
                                                    <?php }
                                                                ?>
                                                </td>
                                                <td><?php echo $row['dregdate'] ?></td>
                                            </tr>
                                            <?php   }?>
                                        </table>

                                        <?php  }?>

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
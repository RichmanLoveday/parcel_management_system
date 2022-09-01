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
    <title>View Records</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> Arrived Packages</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Records</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Manage packages
                                    </div>
                                    <div class="card-body">
                                        <span
                                            class="alert-success"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?></span>
                                        <table id="datatablesSimple">
                                            <?php
                                            
                                            if($position == 'Office-staff') { ?>
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
                                                    <th>Date</th>
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
                                                    <th>Date</th>
                                                </tr>
                                            </tfoot>

                                            <?php 
                                                       $sql = $conn->query("SELECT * FROM (((((dbooking JOIN 
                                                       dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage) 
                                                       JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                       JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                       JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id)
                                                       JOIN dvehicle_registration ON dvehicle_registration.dvehicle_id = dbooking.dvehicle_id)
                                                       WHERE dbooking_status = 'arrived' OR dbooking_status = 'delivered'");
                                                        //print_r($id);

                                                        
                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            
                                                        $num = 0;
                                                        while($row = $sql->fetch_assoc()) { 
                                                            $booking_id = $row['dbooking_id'];
                                                            $package_id = $row['dpackage'];

                                                            $sql1 = $conn->query("SELECT * FROM arrived_package WHERE booking = '$booking_id'");
                                                            
                                                           
                                                            $sql2 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
                                                            $row2 = $sql2->fetch_assoc();

                                                            while($row1 = $sql1->fetch_assoc()) {
                                                                $delivery_status = $row1['delivery_status'];

                                                                // getting the location of package
                                                                $sql2 = $conn->query("SELECT * FROM dpackage_registration JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id WHERE dpackage_id = '$package_id'");
                                                                $row2 = $sql2->fetch_assoc();
                                                                switch($delivery_status) {
                                                                    case '1':
                                                                    if($row2['dlocation_id'] == $terminal) { ?>
                                            <tr>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row2['dterminal'] . ' '. 'station' ?></td>
                                                <td><a href="#" class="btn btn-primary btn-sm disabled">Arrived</a></td>
                                                <td><?php echo date('Y-m-d') ?></td>

                                            </tr>
                                            <?php       } else {
                                                                        echo '';
                                                                    } ?>


                                            <?php break;
                                                                       
                                                                      case '2':
                                                                      if($row2['dlocation_id'] == $terminal) { ?>
                                            <tr>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row2['dterminal'] . ' '. 'station' ?></td>
                                                <td><a href="#" class="btn btn-primary btn-sm disabled">Picked-up</a>
                                                </td>
                                                <td><?php echo date('Y-m-d') ?></td>

                                            </tr>

                                            <?php      } else {
                                                                        echo '';
                                                                      }
                                                                      ?>



                                            <?php break;
                                                                      default:
                                                                            echo 'No record found!';
                                                                } 
                                                             ?>


                                            <?php $num++;  }
                                                                
                                                            }
                                                                
                                                        }
                                                    ?>

                                            <?php } elseif($position == 'admin') { ?>

                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Cleared By</th>
                                                    <th>Vehicle</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping Fee</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Cleared By</th>
                                                    <th>Vehicle</th>
                                                    <th>Package Name</th>
                                                    <th>Sender Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Shipping fee</th>
                                                    <th>From</th>
                                                    <th>To/th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <?php
                                                        $sql = $conn->query("SELECT * FROM (((((dbooking JOIN 
                                                        dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage) 
                                                        JOIN duser_registration ON duser_registration.duser_id = dbooking.dcustomer_id) 
                                                        JOIN dlocation ON dlocation.dlocation_id = dbooking.dlocation_id)
                                                        JOIN dstate_registration ON dstate_registration.dstate_id = dbooking.dstate_id)
                                                        JOIN dvehicle_registration ON dvehicle_registration.dvehicle_id = dbooking.dvehicle_id)
                                                        WHERE dbooking_status = 'arrived' OR dbooking_status = 'delivered'");
                                                        

                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            $num = 0;
                                                            while($row = $sql->fetch_assoc()) { 
                                                            $booking_id = $row['dbooking_id'];
                                                            $package_id = $row['dpackage'];

                                                            $sql1 = $conn->query("SELECT * FROM arrived_package JOIN dstaff_registration ON dstaff_registration.dstaff_id = arrived_package.staff WHERE booking = '$booking_id'");
                                                            
                                                            
                                                            while($row1 = $sql1->fetch_assoc()) {
                                                                $delivery_status = $row1['delivery_status'];

                                                                // getting the location of package
                                                                $sql2 = $conn->query("SELECT * FROM dpackage_registration JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id WHERE dpackage_id = '$package_id'");
                                                                $row2 = $sql2->fetch_assoc();

                                                                switch($delivery_status) {

                                                                    

                                                                    // checking the delivery arrival and delivery status for only admin to see 
                                                                    case '1' : ?>

                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <?php if($row1['staff'] == $id ) { ?>
                                                <td><?php echo $position ?></td>
                                                <?php   } else { ?>
                                                <td><?php echo $row1['dfname']. ' '.$row1['dlname']?></td>
                                                <?php    } ?>
                                                <td><?php echo $row['dvehicle_num']?></td>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row2['dterminal'] . ' '. 'station' ?></td>
                                                <td><a href="#" class="btn btn-primary btn-sm disabled">Arrived</a></td>
                                                <td><?php echo date('Y-m-d') ?></td>
                                                <td>
                                                    <?php if($row['dbooking_status'] != 'delivered') { ?>
                                                    <a href="../process/delete_inbox.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-danger disabled btn-sm">
                                                        Delete
                                                    </a>
                                                    <?php } else{ ?>
                                                    <a href="../process/delete_inbox.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-danger btn-sm">
                                                        Delete
                                                    </a>

                                                    <?php  } ?>


                                                </td>


                                            </tr>
                                            <?php   break;
    
                                                                    case '2': ?>

                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <?php if($row1['staff'] == $id ) { ?>
                                                <td><?php echo $position ?></td>
                                                <?php   } else { ?>
                                                <td><?php echo $row1['dfname']. ' '.$row1['dlname']?></td>
                                                <?php    } ?>
                                                <td><?php echo $row['dvehicle_num']?></td>
                                                <td><?php echo $row['dpackage_name'] ?></td>
                                                <td><?php echo $row['dfname']. ' '.$row['dlname']?></td>
                                                <td><?php echo $row['dreceiver'] ?></td>
                                                <td><?php echo $row['dreceiver_phone'] ?></td>
                                                <td><?php echo $row['dweight']. 'Kg' ?></td>
                                                <td><?php echo '$'.$row['damount'] ?></td>
                                                <td><?php echo $row['dterminal'] . ' '. 'station' ?></td>
                                                <td><?php echo $row2['dterminal'] . ' '. 'station' ?></td>
                                                <td><a href="#" class="btn btn-primary btn-sm disabled">Picked-up</a>
                                                </td>
                                                <td><?php echo date('Y-m-d') ?></td>
                                                <td>
                                                    <a href="../process/delete_inbox.php?id=<?php echo $row['dbooking_id'] ?>"
                                                        class="btn btn-danger btn-sm">
                                                        Delete
                                                    </a>

                                                </td>
                                            </tr>
                                            <?php    break;
                                                                    default:
                                                                        echo 'No record found';
    
    
                                                        } $num++; 
                                                               }
                                                            }
                                                            
                                                        }
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
                unset($_SESSION['message'])?>
    </div>
    </div>
    <?php include '../includes/scripts.php' ?>
</body>

</html>
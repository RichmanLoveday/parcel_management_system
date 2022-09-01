<?php ob_start();
      include '../includes/header.php';
      include '../includes/css_files.php'; 
      
      $position = $_SESSION['position'];
      $id = $_SESSION['staff_id'];
      
    
      ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inbox</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> My Inbox</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage inbox</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-body">
                                <?php
                              
                               // $id = $_GET['id'];
                                // $sql1 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' ");

                                // if($sql1 -> num_rows > 0) {
                                //     $rows1 = $sql1 -> fetch_assoc();
                                // }
                                
                            ?>

                                <?php// echo isset($_SESSION['status_change']) ?  $_SESSION['status_change'] : '';
                                //echo isset($_SESSION['message']) ?  $_SESSION['message'] : '';?>

                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        My Inbox
                                    </div>
                                    <div class="card-body">

                                        <?php $sql = $conn->query("SELECT * FROM dinbox WHERE duser_id = '$id' ORDER BY id DESC");

                                    if($conn->connect_error) {
                                        die("Connection Error: ".$conn->connect_error);

                                    } elseif($sql->num_rows > 0) {

                                        while($row = $sql->fetch_assoc()) { 

                                            $package_id = $row['dpackage_id'];

                                            $inbox_status = $row['dinbox_status'];
                                            $inbox_date = $row['dinbox_date'];
                                            $time = strtotime($inbox_date);
                                            $to_date = getdate($time);
                                            $day = $to_date['weekday'];
                                            $date = $to_date['mday'];
                                            $month = $to_date['month'];
                                            $year = $to_date['year'];

                                            $date = $day. ','. ' '. $date. 'th'. ' ' .$month . ' ' .$year;
                                            // print_r($to_date);
                                            
                                            $sql1 = $conn->query("SELECT * FROM ((dpackage_registration JOIN dstate_registration ON dstate_registration.dstate_id = dpackage_registration.dstate_id)
                                            JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id) WHERE dsender_id = '$id' AND dpackage_id = '$package_id'");

                                            $row1 = $sql1->fetch_assoc();
                                            $receiver_name = $row1['dreceiver'];
                                            $receiver_phone = $row1['dreceiver_phone'];
                                            $delivery_point = $row1['dstate_name']. ','. ' '.$row1['dterminal']. ' '.'terminal';
                                            $package_name = $row1['dpackage_name'];

                                            switch($inbox_status) {

                                                case '1': ?>

                                        <div class="card bg-primary mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <p style="padding-top: 15px">Your package has been placed and awaiting
                                                    to be booked. <br> Please visit the nearest office to complete your
                                                    booking.</p>

                                                <h6>Package Number </h6>
                                                <h6><?php echo $package_id ?></h6>
                                                <h6>Receiver Name: <?php echo $receiver_name ?></h6>
                                                <h6>Receiver Phone: <?php echo $receiver_phone ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_point  ?></h6>


                                                <h6>Date: <?php echo $date;  ?></h6>
                                                <h6 style="margin-top: 30px;">Thanks</h6>
                                            </div>

                                            <?php $sql2 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
                
                                                $row2 = $sql2->fetch_assoc();
                                                if($row2['dpackage_status'] == 'approved') { ?>
                                            <a href="../process/delete_inbox.php?package_id=<?php echo $row['dpackage_id']?>"
                                                class="btn btn-danger btn-sm disabled"
                                                style='width: 25%; margin: 10px;'>Cancel Package</a>
                                            <?php } else { ?>

                                            <a href="../process/delete_inbox.php?id=<?php echo $row['dpackage_id']?>&status=<?php echo $inbox_status?>"
                                                class="btn btn-danger btn-sm" style='width: 25%; margin: 10px;'>Delete
                                            </a>


                                            <?php } ?>

                                        </div>

                                        <?php break;

                                               case '2': ?>
                                        <?php 
                                            $sql3 = $conn->query("SELECT * FROM dbooking
                                            JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage WHERE dcustomer_id = '$id' AND dpackage_id = '$package_id' ");
                                            $row3 = $sql3->fetch_assoc(); ?>

                                        <div class="card bg-secondary mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <p>Your package has been booked. <br>
                                                    Track your desired package.</p>
                                                <h6>Receiver Name: <?php echo $receiver_name ?></h6>
                                                <h6>Receiver Phone: <?php echo $receiver_phone ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_point ?></h6>
                                                <h6>Date: <?php echo $date;  ?></h6>
                                                <h6>Thanks</h6>
                                            </div>
                                            <?php
                                                $sql4 = $conn->query("SELECT * FROM dbooking
                                                JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage WHERE dcustomer_id = '$id' AND dpackage_id = '$package_id'");
                                                $row4 = $sql4->fetch_assoc();
                                                
                                                if($row4['dbooking_status'] == 'cancelled') { ?>
                                            <a href="../process/delete_inbox.php?id=<?php echo $row['dpackage_id'] ?>&status=<?php echo $inbox_status?>"
                                                class="btn btn-danger btn-sm"
                                                style='width: 25%; margin: 10px;'>Delete</a>
                                            <?php   } else { ?>
                                            <a name="search"
                                                href="track_package.php?id=<?php echo $row3['dbooking_id']?>"
                                                class="btn btn-danger btn-sm" style='width: 25%; margin: 10px;'>Track
                                                Package</a>
                                            <?php   }?>
                                            <?php if($row3['dbooking_status'] == 'delivered') { ?>
                                            <a href="../process/delete_inbox.php?id=<?php echo $row6['dpackage_id'] ?>&status=<?php echo $inbox_status ?>"
                                                class="btn btn-danger btn-sm"
                                                style='width: 25%; margin: 10px;'>Delete</a>

                                            <?php   } else {
                                                echo '';
                                            } ?>

                                        </div>

                                        <?php break;

                                                case '3':
                                                $sql5 = $conn->query("SELECT * FROM  dpackage_registration WHERE dsender_id = '$id' AND dpackage_id = '$package_id'"); 
                                                $row5 = $sql5->fetch_assoc(); ?>

                                        <div class="card bg-danger mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <p>Your package has been cancelled. <br>
                                                <h6>Package Number</h6>
                                                <h6><?php echo $row5['dpackage_id'] ?></h6>
                                                <h6>Receiver Name: <?php echo $receiver_name ?></h6>
                                                <h6>Receiver Phone: <?php echo $receiver_phone ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_point  ?></h6>
                                                <h6>Date: <?php echo $date; ?></h6>
                                                <h6>Thanks</h6>
                                            </div>
                                            <a href="../process/delete_inbox.php?id=<?php echo $row5['dpackage_id'] ?>&status=<?php echo $inbox_status?>"
                                                class="btn btn-primary btn-sm"
                                                style='width: 25%; margin: 10px;'>Delete</a>
                                        </div>

                                        <?php break;
                                                case '4':
                                                $sql6 = $conn->query("SELECT * FROM dbooking
                                                JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage WHERE dcustomer_id = '$id' AND dpackage = '$package_id'"); 
                                                $row6 = $sql6->fetch_assoc();
                                                $booking_id = $row6['dbooking_id'];
                                                //print_r($booking_id); echo '<br>';

                                                $sql7 = $conn->query("SELECT * FROM arrived_package WHERE booking = '$booking_id' ");
                                                $row7 = $sql7->fetch_assoc();
                                                $pickup_id = $row7['pickup_id'];
                                                //print_r($pickup_id);
                                                ?>
                                        <div class="card bg-info mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <p>Your package has arrived terminal, forward the pickup number to the
                                                    receiver.<br>
                                                <h6>Pickup Number</h6>
                                                <h6><?php echo $pickup_id?></h6>
                                                <h6>Receiver Name: <?php echo $receiver_name ?></h6>
                                                <h6>Receiver Phone: <?php echo $receiver_phone ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_point  ?></h6>
                                                <h6>Date: <?php echo $date; ?></h6>
                                                <h6>Thanks</h6>
                                            </div>
                                            <?php if($row6['dbooking_status'] == 'delivered') { ?>
                                            <a href="../process/delete_inbox.php?id=<?php echo $row6['dpackage_id'] ?>&status=<?php echo $inbox_status ?>"
                                                class="btn btn-danger btn-sm"
                                                style='width: 25%; margin: 10px;'>Delete</a>

                                            <?php   } else {
                                                echo '';
                                            } ?>

                                        </div>

                                        <?php  
                                            break;
                                            case '5':
                                                $sql6 = $conn->query("SELECT * FROM dbooking
                                                JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage WHERE dcustomer_id = '$id' AND dpackage = '$package_id'"); 
                                                $row6 = $sql6->fetch_assoc();
                                                $booking_id = $row6['dbooking_id'];
                                                //print_r($booking_id); echo '<br>';

                                                $sql7 = $conn->query("SELECT * FROM arrived_package WHERE booking = '$booking_id' ");
                                                $row7 = $sql7->fetch_assoc();
                                                $pickup_id = $row7['pickup_id'];
                                                //print_r($pickup_id);
                                                ?>
                                        <div class="card bg-success mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <p>Your package has been delivered.</p>
                                                <h6>Receiver Name: <?php echo $receiver_name ?></h6>
                                                <h6>Receiver Phone: <?php echo $receiver_phone ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_point  ?></h6>
                                                <h6>Date: <?php echo $date; ?></h6>
                                                <h6>Thanks</h6>
                                            </div>

                                            <a href="../process/delete_inbox.php?id=<?php echo $row6['dpackage_id'] ?>&status=<?php echo $inbox_status?>"
                                                class="btn btn-danger btn-sm"
                                                style='width: 25%; margin: 10px;'>Delete</a>
                                        </div>
                                        <?php
                                            break;
                                            default:
                                                echo 'No inbox Avaible';
                                            }

                                        }

                                            } else {
                                        echo 'No inbox Available';
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>
        <?php include '../includes/footer.php' ?>
    </div>
    <?php include '../includes/scripts.php';
            unset($_SESSION['message']); 
            unset($_SESSION['status_change']); 
            unset($_SESSION['null']);
            ob_end_flush();?>

</body>

</html>
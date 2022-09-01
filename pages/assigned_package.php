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
    <title>Dashboard user</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> Assigned Packages </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">view inbox</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-body">

                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Inbox
                                    </div>
                                    <div class="card-body">
                                        <?php  
                            
                              // Quering the drivers table to get drivers who has a vehicle
                              $sql = $conn->query("SELECT * FROM drivers WHERE driver_id = '$id'");
                              $row = $sql->fetch_assoc();


                              // Condition to check if a driver has a vehicles assigned
                              if($row['vehicle_id'] != 'not-assigned') {
                                
                                // Storing the vehicle id from the drivers table of a particular driver
                                $vehicle_id = $row['vehicle_id'];
                                //print_r($vehicle_id); echo '<br>';

                                
                                 // Querying the booking table to get bookings with the vehicle ID
                                 $sql2 = $conn->query("SELECT * FROM dbooking WHERE dvehicle_id = $vehicle_id");
                                 $row1 = $sql2->fetch_assoc();

                                    if($conn->connect_error) {
                                        die("Connection Error: ".$conn->connect_error);
  
                                    // Condition to check if the booking table vehicle is same with the driver table vehicle
                                    } elseif(isset($row1['dvehicle_id']) == $vehicle_id) {
                                      // print_r($row['driver_id'] );
                                    //   echo '<br>'; 
                                    //   print_r($id); 
                                      
                                       ?>


                                        <?php
                                        $sql1 = $conn->query("SELECT * FROM driver_inbox WHERE vehicle_id = '$vehicle_id' ORDER BY id DESC");
                        
                                        if($conn->connect_error) {
                                            die("Connection Error: ".$conn->connect_error);

                                        } elseif($sql1->num_rows > 0) { ?>
                                        <p style="padding-top: 15px">You have been assigned to make delivery to the
                                            following terminals, summit booking number on arrival.</p>
                                        <h6>Thanks.</h6>

                                        <?php $num = 0;
                                            while($row1 = $sql1->fetch_assoc()) {
                                                $booking_id = $row1['booking_id'];

                                                // Querying the booking table and package registration table to fetch a specific package id where booking id is available
                                                $sql2 = $conn->query("SELECT * FROM ((dbooking JOIN dpackage_registration ON dpackage_registration.dpackage_id = dbooking.dpackage)
                                                JOIN drivers ON drivers.vehicle_id = dbooking.dvehicle_id) WHERE dbooking_id = '$booking_id' ");
                                                $row2 = $sql2->fetch_assoc();
                                                $package_id = $row2['dpackage_id']; // get the package id

                                                
                                                // Quering the package table where theirs a specific package id to output datas
                                                $sql3 = $conn->query("SELECT * FROM (((dpackage_registration 
                                                JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id)
                                                JOIN dstate_registration ON dstate_registration.dstate_id = dpackage_registration.dstate_id)
                                                JOIN duser_registration ON duser_registration.duser_id = dpackage_registration.dsender_id) WHERE dpackage_id = '$package_id'");
                                                $row3 = $sql3->fetch_assoc();
      
                                                // Quering the package table where theirs a specific package id to output datas
                                                $sql4 = $conn->query("SELECT * FROM dpackage_registration JOIN dstate_registration ON dstate_registration.dstate_id = dpackage_registration.dstate_id WHERE dpackage_id = '$package_id'");
                                                $row4 = $sql4->fetch_assoc();
                                                
                                                
                                                // Gotten datas to display
                                                $package_name = $row3['dpackage_name'];
                                                $fullname = $row3['dfname']. ' '.$row3['dlname'];
                                                $weight = $row2['dweight'].'Kg';
                                                $delivery_office = $row4['dstate_name']. ',' . ' '.$row3['dterminal'];

                                                // Datas from the drivers inbox table
                                                $inbox_status = $row1['inbox_status'];
                                                $booking_date = $row1['reg_date'];
                                                $time = strtotime($booking_date);
                                                $to_date = getdate($time);
                                                $day = $to_date['weekday'];
                                                $date = $to_date['mday'];
                                                $month = $to_date['month'];
                                                $year = $to_date['year'];
                                                $date = $day. ','. ' '. $date. 'th'. ' '. $month . ' ' .$year;

                                                // Switching the inbox status to output a message
                                                switch($inbox_status) {
                                                    case '1': ?>
                                        <div class="card bg-primary mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <h6>Booking Number</h6>
                                                <h6><?php echo $row1['booking_id'] ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Sender Name: <?php echo $fullname ?></h6>
                                                <h6>Weight: <?php echo $weight ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_office .' '. 'terminal' ?>
                                                </h6>
                                                <h6>Booking Date: <?php echo $date ?></h6>
                                                <h6>Status: Awaiting Deliverly</h6>
                                            </div>
                                        </div>
                                        <?php break;
                                                case '2': 
                                                // $sql5 = $conn->query("DELETE FROM driver_inbox WHERE booking_id = '$booking_id' AND inbox_status = '1'"); ?>
                                        <div class="card bg-primary mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <h6>Booking Number</h6>
                                                <h6><?php echo $row1['booking_id'] ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Sender Name: <?php echo $fullname ?></h6>
                                                <h6>Weight: <?php echo $weight ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_office .' '. 'terminal' ?>
                                                </h6>
                                                <h6>Booking Date: <?php echo $date ?></h6>
                                                <h6>Status: In Transit</h6>
                                            </div>
                                        </div>

                                        <?php break;
                                            case '3': ?>
                                        <div class="card bg-danger mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <h6>Booking Number</h6>
                                                <h6><?php echo $row1['booking_id'] ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Sender Name: <?php echo $fullname ?></h6>
                                                <h6>Weight: <?php echo $weight ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_office .' '. 'terminal' ?>
                                                </h6>
                                                <h6>Booking Date: <?php echo $date ?></h6>
                                                <h6>Status: Canceled</h6>
                                                <a href="../process/delete_inbox.php?id=<?php echo $row1['booking_id'] ?>"
                                                    class="btn btn-primary btn-sm">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>

                                        <?php 
                                            break;
                                                case '4' ?>
                                        <div class="card bg-primary mb-2" style="margin-top: 30px;">
                                            <div class="card-body text-white">
                                                <h6>Booking Number</h6>
                                                <h6><?php echo $row1['booking_id'] ?></h6>
                                                <h6>Package Name: <?php echo $package_name ?></h6>
                                                <h6>Sender Name: <?php echo $fullname ?></h6>
                                                <h6>Weight: <?php echo $weight ?></h6>
                                                <h6>Delivery Office: <?php echo $delivery_office .' '. 'terminal' ?>
                                                </h6>
                                                <h6>Arrival Date: <?php echo $date ?></h6>
                                                <h6>Status: Package arrived terminal</h6>
                                                <a href="../process/delete_inbox.php?id=<?php echo $row1['booking_id'] ?>"
                                                    class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                        <?php 
                                         break;
                                        
                                        default:
                                        echo 'No inbox Available';
                                        
                                           }
                                        }


                                        // Condition when no vehicle ID is assigned in drivers inbox
                                        } else {
                                        echo 'No inbox Available';
                                        }

                                        // Condition for vehicle ID in drivers and vehicle ID in booking tables not the
                                        
                                        } else {
                                        echo 'No inbox Avaliable';
                                        }

                                        // Condition for drivers not assigned a vehicle
                                        } else {
                                        echo 'No inbox Avaliable';
                                        } ?>


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
            unset($_SESSION['status_change']); ob_end_flush();?>

</body>

</html>
<?php
    ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php'; 
        
      $position = $_SESSION['position'];
      $id = $_SESSION['staff_id'];
      $terminal = $_SESSION['terminal'];
      $state = $_SESSION['state'];
      
      //print_r($state);

      if(isset($_POST['search'])) {
          include '../process/pickup_process.php';

      } elseif(isset($_POST['delivered'])) {
          include '../process/deliver_process.php';
      } else {
          echo '';
      }

      //print_r($position)
      ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pick up</title>
</head>

<body class='sb-nav-fixed'>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pick Up</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pick-up package</li>
                </ol>
                <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                <div class="container my-lg-5">
                    <form action="pickup.php" method="post">
                        <div class="container form-group" style="width: 65%;">
                            <label for="">Input Pick-up ID</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="pickup_id" placeholder="203873633"
                                    value="">
                                <button class="btn btn-primary" name="search" id="btnNavbarSearch"><i
                                        class="fas fa-search"></i>
                                </button>
                            </div>
                            <span class="text-danger">
                                <?php echo isset($errId) ? $errId : '' ?>
                            </span>
                        </div>
                    </form>
                </div>

                <?php if (isset($_SESSION['output'])) { 
                        
                        // checking if theirs an ID in the url and it is set
                        if(isset($_GET['id'])) {
                            
                            $pickup_id = $_GET['id'];      // storing the url ID in a variable 
                            //print_r($booking_id);

                            // quering the database to get the package details

                            $sql1 = $conn->query("SELECT * FROM ((dbooking JOIN dpackage_registration  ON
                            dpackage_registration.dpackage_id = dbooking.dpackage)
                            JOIN arrived_package ON arrived_package.booking = dbooking.dbooking_id) WHERE pickup_id = '$pickup_id'");
                            $row1 = $sql1->fetch_assoc();
                            
                            
                            $package_id = '';
                            if(isset($row1['dpackage_id'])) {
                                $package_id = $row1['dpackage_id'];
                            }
                            
                            
                            $sql = $conn->query("SELECT * FROM (((dpackage_registration JOIN duser_registration ON
                            dpackage_registration.dsender_id = duser_registration.duser_id)
                            JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id)
                            JOIN dstate_registration ON dstate_registration.dstate_id = dpackage_registration.dstate_id) WHERE
                            dpackage_id = '$package_id'");
                            $row = $sql->fetch_assoc();


                        // checking if connection exists
                        if($conn->connect_error) {
                            die("Connection Error: ".$conn->connect_error);
                        } elseif($sql->num_rows > 0) {      // checking if sql has the package ID
                        //print_r($row);
                        
                            // created this variable to get only vehicles heading to package destination
                            $delivery_state = $row['dstate_id'];
                            //print_r($_SESSION);

                            $fullname = $row['dfname'] . ' ' . $row['dlname'];

                            // Below has the the outputed form for a specific package
                
                ?>


                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Please fill in all forms correctly.
                    </div>
                    <div class="card-body">
                        <form action="../process/deliver_process.php" method="post">
                            <div class="container">
                                <input type="text" name="pickup_id" value="<?php echo $pickup_id ?>">
                                <div class="row mb-3">
                                    <div class="form-group col-md-20" style="margin-bottom: 10px;">
                                        <label for="">Use the booking ID to locate arrive package</label>
                                        <input type="text" name="pack_name" class="form-control"
                                            value="<?php echo $row1['dbooking_id']?>" disabled>
                                    </div>

                                    <div class="row mb-3">

                                        <div class="form-group conatiner-flux col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Name of Sender</label>
                                            <input type="text" name="send_name" class="form-control"
                                                value="<?php echo $fullname ?>" disabled>
                                        </div>
                                        <div class="container-flux form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Name of Receiver</label>
                                            <input type="text" name="rec_name" class="form-control"
                                                value="<?php echo $row['dreceiver']?>" disabled>
                                        </div>

                                        <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Receiver Phone</label>
                                            <input type="text" name="phn" class="form-control"
                                                value="<?php echo $row['dreceiver_phone']?>" disabled>
                                        </div>

                                        <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Name of package</label>
                                            <input type="text" name="pack_name" class="form-control"
                                                value="<?php echo $row['dpackage_name']?>" disabled>
                                            <span class="text-danger">
                                        </div>

                                        <h5 style="margin-top: 10px; margin-bottom: 10px;">Destination of package
                                        </h5>
                                        <div class="form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">State</label>
                                            <input type="text" name="pack_name" class="form-control"
                                                value="<?php echo $row['dstate_name']?>" disabled>
                                        </div>

                                        <div class="form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Terminal</label>
                                            <input type="text" name="pack_name" class="form-control"
                                                value="<?php echo $row['dterminal']?>" disabled>
                                        </div>

                                        <div class="container form-group col-md-20" style="margin-bottom: 10px;">
                                            <label for="">Address</label>
                                            <textarea name="ads" id="" value="" cols="30" rows="5" class="form-control"
                                                placeholder="Optional" name="<?php echo $ads ?>" disabled></textarea>
                                        </div>

                                        <div class="container form-group " style="margin-bottom: 10px;">
                                            <label for="">Driver Name</label>
                                            <?php
                                                    $vehicle_id_id = '';
                                                    if(isset($row1['dvehicle_id'])) {
                                                        $vehicle_id = $row1['dvehicle_id'];
                                                    }

                                                    //print_r($vehicle_id);

                                                    $sql2 = $conn->query("SELECT * FROM drivers JOIN dstaff_registration ON dstaff_registration.dstaff_id = drivers.driver_id WHERE vehicle_id = '$vehicle_id' ");
                                                    $row2 = $sql2->fetch_assoc();
                                                    $driver_name = "{$row2['dfname']} {$row2['dlname']}";
                                                        
                                                ?>
                                            <input type="text" name="pack_name" class="form-control"
                                                value="<?php echo $driver_name?>" disabled>
                                        </div>



                                        <div class="container form-group" style="margin-bottom: 10px;">
                                            <label for="">Weight Of Package</label>
                                            <input type="text" name="weight" class="form-control"
                                                value="<?php echo $row1['dweight'] . 'kg' ?>" disabled>
                                        </div>

                                        <div class="container form-group" style="">
                                            <label for="">Amount Paid($)</label>
                                            <input type="text" name="amt" class="form-control"
                                                value="<?php echo '$'.$row1['damount'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-primary " data-bs-toggle="modal" name="arrived"
                                data-bs-target="#myModal" style="">Delivered
                            </button>
                        </form>
                    </div>

                    <?php } 

                    // outputed value when package ID can't be found in the data-base
                    else { ?>

                    <span class="text-danger">
                        No Result Found!
                    </span>

                    <?php
                    
                        }
                    } 
                    
                } ?>

                    <?php if(isset($_SESSION['null3'])) {  ?>
                    <span class="text-danger"><?php echo $_SESSION['null3']?></span>
                    <?php } ?>
                    <span class="text-success">
                        <?php echo isset($_SESSION['delivered']) ? $_SESSION['delivered'] : '' ?>
                    </span>
                </div>

        </main>
        <?php include '../includes/footer.php'; ?>

    </div>
    <?php include '../includes/scripts.php';
            ob_end_flush(); ?>

</body>

</html>
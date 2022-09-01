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
          include_once '../process/search_package.php';

      } elseif(isset($_POST['book'])) {
          include_once '../process/booking_process.php';
      } else {
          echo '';
      }

      ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 

      //print_r($position)

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Package</title>
</head>

<body class='sb-nav-fixed'>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Book a package</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Book Package</li>
                </ol>
                <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                <div class="container my-lg-5">
                    <form action="book_package.php" method="post">
                        <div class="container form-group" style="width: 65%;">
                            <label for="">Input Package Id</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="package_id" placeholder="203873633"
                                    value="">
                                <button class="btn btn-primary" name="search" id="btnNavbarSearch"><i
                                        class="fas fa-search"></i></button>
                            </div>
                            <span class="text-danger"><?php echo isset($errId) ? $errId : '' ?></span>

                        </div>
                    </form>
                </div>

                <?php if(isset($_SESSION['null'])) {  ?>
                <span class="text-danger"><?php echo $_SESSION['null']?></span>
                <?php } ?>
                <span class="text-success">
                    <?php echo isset($_SESSION['booked']) ? $_SESSION['booked'] : '' ?>
                </span>

                <?php if (isset($_SESSION['output'])) { 
                        
                        // checking if theirs an ID in the url and it is set
                        if(isset($_GET['id'])) {
                            
                            $package_id = $_GET['id'];      // storing the url ID in a variable 

                            // quering the database to get the package details
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
                        <form action="book_package.php" method="post">
                            <div class="container">
                                <input type="hidden" name="package_id" value="<?php echo $row['dpackage_id'] ?>">
                                <div class="row mb-3">

                                    <input type="hidden" name="customer_id" value="<?php echo $row['duser_id'] ?>">
                                    <div class="row mb-3">

                                        <input type="hidden" name="location_id"
                                            value="<?php echo $row['dlocation_id'] ?>">
                                        <div class="row mb-3">

                                            <div class="form-group conatiner-flux col-md-6"
                                                style="margin-bottom: 10px;">
                                                <label for="">Name of Sender</label>
                                                <input type="text" name="send_name" class="form-control"
                                                    value="<?php echo $fullname ?>" disabled>
                                            </div>
                                            <div class="container-flux form-group col-md-6"
                                                style="margin-bottom: 10px;">
                                                <label for="">Name of Receiver</label>
                                                <input type="text" name="rec_name" class="form-control"
                                                    value="<?php echo $row['dreceiver']?>" disabled>
                                                <span class="text-danger">
                                                    <?php echo isset($errName) ? $errName : '' ?></span>
                                            </div>

                                            <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                                <label for="">Receiver Phone</label>
                                                <input type="text" name="phn" class="form-control"
                                                    value="<?php echo $row['dreceiver_phone']?>" disabled>
                                                <span class="text-danger">
                                                    <?php echo isset($errPhone) ? $errPhone : '' ?></span>
                                            </div>

                                            <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                                <label for="">Name of package</label>
                                                <input type="text" name="pack_name" class="form-control"
                                                    value="<?php echo $row['dpackage_name']?>" disabled>
                                                <span class="text-danger">
                                                    <?php echo isset($errPackage) ? $errPackage : '' ?></span>
                                            </div>

                                            <h5 style="margin-top: 10px; margin-bottom: 10px;">Destination of package
                                            </h5>
                                            <div class="form-group col-md-6" style="margin-bottom: 10px;">
                                                <label for="">State</label>
                                                <input type="text" name="pack_name" class="form-control"
                                                    value="<?php echo $row['dstate_name']?>" disabled>
                                                <span class="text-danger">
                                                    <?php echo isset($errPackage) ? $errPackage : '' ?></span>
                                                <span class="text-danger">
                                                    <?php echo isset($errState) ? $errState : '' ?></span>
                                            </div>

                                            <div class="form-group col-md-6" style="margin-bottom: 10px;">
                                                <label for="">Terminal</label>
                                                <input type="text" name="pack_name" class="form-control"
                                                    value="<?php echo $row['dterminal']?>" disabled>
                                                <span class="text-danger">
                                                    <?php echo isset($errPackage) ? $errPackage : '' ?></span>
                                                <span class="text-danger">
                                                    <?php echo isset($errTerm) ? $errTerm : '' ?></span>
                                            </div>

                                            <div class="container form-group col-md-20" style="margin-bottom: 10px;">
                                                <label for="">Address</label>
                                                <textarea name="ads" id="" value="" cols="30" rows="5"
                                                    class="form-control" placeholder="Optional"
                                                    name="<?php echo $ads ?>" disabled></textarea>
                                                <span class="text-danger">
                                                    <?php echo isset($errAds) ? $errAds : '' ?></span>
                                            </div>
                                            <?php if($position == 'Office-staff') {   ?>
                                            <div class="container form-group " style="margin-bottom: 10px;">
                                                <label for="">Available Drivers</label>
                                                <select name="driver" id="" class="form-control form-select" required>

                                                    <option value="">---select driver---</option>
                                                    <?php
                                                    // quering the datatbase to check for available drivers and vehicle heading to a specfic location
                                                    
                                                    $sql = $conn->query("SELECT * FROM ((drivers JOIN dvehicle_registration ON dvehicle_registration.ddriver_id = drivers.driver_id)
                                                    JOIN dstaff_registration ON dstaff_registration.dstaff_id = drivers.driver_id)
                                                    WHERE vehicle_id != 'not-assigned' AND dstaff_state = '$state' AND dvehicle_dest = '$delivery_state' AND dstaff_state != 'in-transit'");
                                                    
                                                    if($sql) {
                                                        // Fetching each data in a row and looping to the next data
                                                        while($row = $sql->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['vehicle_id']  ?>">
                                                        <?php echo $row['dfname'] . ' ' . $row['dlname'] ?></option>

                                                    <?php } } ?>
                                                </select>
                                                <span
                                                    class="text-danger"><?php echo isset($errDrive) ? $errDrive : '' ?></span>
                                            </div>

                                            <?php } elseif($position == 'admin') { ?>

                                            <div class="form-group conatiner-flux col-md-6 "
                                                style="margin-bottom: 10px;">
                                                <label for="">Booking State</label>
                                                <select name="book_state" id="" class="form-control form-select"
                                                    required>

                                                    <option value="">---Select state---</option>
                                                    <?php 
                                                    // quering the datatbase to check for available drivers and vehicle heading to a specfic location
                                                    
                                                    $sql1 = $conn->query("SELECT * FROM dstate_registration ORDER BY dstate_name");
    
                                                    if($sql1) {
                                                        // Fetching each data in a row and looping to the next data
                                                        while($row1 = $sql1->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row1['dstate_id'] ?>">
                                                        <?php echo $row1['dstate_name'] . ' '. 'state' ?>
                                                    </option>

                                                    <?php } } ?>
                                                </select>
                                                <span
                                                    class="text-danger"><?php echo isset($errDrive) ? $errDrive : '' ?></span>
                                            </div>

                                            <div class="form-group conatiner-flux col-md-6 "
                                                style="margin-bottom: 10px;">
                                                <label for="">Booking Terminal</label>
                                                <select name="book_term" id="" class="form-control form-select"
                                                    required>

                                                    <option value="">---Select terminal---</option>
                                                    <?php 
                                                    // quering the datatbase to check for available drivers and vehicle heading to a specfic location
                                                    
                                                    $sql1 = $conn->query("SELECT * FROM dlocation JOIN  dstate_registration ON dstate_registration.dstate_id = dlocation.dstate ORDER BY dterminal");
    
                                                    if($sql1) {
                                                        // Fetching each data in a row and looping to the next data
                                                        while($row1 = $sql1->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row1['dlocation_id'] ?>">
                                                        <?php echo $row1['dterminal'] . '-' . $row1['dstate_name'] .' ' . 'state' ?>
                                                    </option>

                                                    <?php } } ?>
                                                </select>

                                            </div>
                                            <div class="container form-group " style="margin-bottom: 10px;">
                                                <label for="">Available Drivers</label>
                                                <select name="driver" id="" class="form-control form-select" required>

                                                    <option value="">---select driver---</option>
                                                    <?php 
                                                    // quering the datatbase to check for available drivers and vehicle heading to a specfic location
                                                    
                                                    $sql1 = $conn->query("SELECT * FROM (((dstaff_registration JOIN dvehicle_registration ON dvehicle_registration.ddriver_id = dstaff_registration.dstaff_id)
                                                    JOIN dstate_registration ON dstate_registration.dstate_id = dstaff_registration.dstaff_state)
                                                    JOIN drivers ON drivers.driver_id = dstaff_registration.dstaff_id)
                                                    WHERE vehicle_id != 'not-assigned' AND dvehicle_dest = '$delivery_state' ORDER BY dstate_name");
    
                                                    if($sql1) {
                                                        // Fetching each data in a row and looping to the next data
                                                        while($row1 = $sql1->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row1['vehicle_id'] ?>">
                                                        <?php echo $row1['dfname'] . ' ' . $row1['dlname'] . '  -  ' .$row1['dstate_name'] .' ' . 'state' ?>
                                                    </option>

                                                    <?php } } ?>
                                                </select>
                                                <span
                                                    class="text-danger"><?php echo isset($errDrive) ? $errDrive : '' ?></span>
                                            </div>

                                            <?php } ?>

                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Weight Of Package (Kg)</label>
                                                <input type="text" name="weight" class="form-control"
                                                    value="<?php echo isset($weight) ? $weight : '' ?>" required>
                                                <span
                                                    class="text-danger"><?php echo isset($errWgt) ? $errWgt : ''; ?></span>
                                            </div>

                                            <div class="container form-group" style="">
                                                <label for="">Amount ($)</label>
                                                <input type="text" name="amt" class="form-control"
                                                    value="<?php echo isset($amount) ? $amount : '' ?>" required>
                                                <span
                                                    class="text-danger"><?php echo isset($errAmt) ? $errAmt  : '' ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-primary " data-bs-toggle="modal" name="book"
                                    data-bs-target="#myModal" style="">Book</button>
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


                </div>

        </main>
        <?php include '../includes/footer.php';
            unset($_SESSION['booked']);
            //unset($_SESSION['null']); ?>

    </div>
    <?php include '../includes/scripts.php';
            ob_end_flush(); ?>

</body>

</html>
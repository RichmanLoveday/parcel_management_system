<?php 
    include '../includes/header.php';
    include '../includes/css_files.php';
    
    // When transfer button is clicked include admin_transfer page
    if(isset($_POST['update'])) {
      include_once "../process/update_vehicle__process.php";
    }

    // Get the request from the transfer button
    $id = $_SESSION['staff_id'];
    $vehicle_id = $_GET['vehicle_id'];
    ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update vehicle</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> Update Vehicle </h1>
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

                                <?php echo isset( $_SESSION['message'])  ?   $_SESSION['message']  : ''; ?>
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Manage Vehicles
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Driver Name</th>
                                                    <th>Vehicle Name</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Destination</th>
                                                    <th>Date of Registration</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Driver Name</th>
                                                    <th>Vehicle Name</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Destination</th>
                                                    <th>Date of Registration</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php  
                                            
                                            $sql = $conn->query("SELECT * FROM dvehicle_registration
                                            JOIN dstate_registration ON dstate_registration.dstate_id = dvehicle_registration.dvehicle_dest WHERE dvehicle_id = '$vehicle_id'" );
                                            //$row = $sql->fetch_assoc();
                                            
                                    
                                                if($conn->connect_error) {
                                                    die("Connection Error: ".$conn->connect_error);
                                                } elseif($sql->num_rows > 0) { 
                                                    echo '';
                                                }

                                            $num = 0;
                                            while($row = $sql->fetch_assoc()) { //print_r($row);
                                                //$driver_id = $row['ddriver_id']; ?>
                                                <tr>
                                                    <td><?php echo $num +1?></td>

                                                    <?php if($row['ddriver_id'] == 'not-assigned') { ?>
                                                    <td>not-assigned</td>

                                                    <?php  } else {

                                                        $sql1 = $conn->query("SELECT * FROM dvehicle_registration
                                                        JOIN dstaff_registration ON dstaff_registration.dstaff_id = dvehicle_registration.ddriver_id WHERE dvehicle_id = '$vehicle_id'" );
                                                        $row1 = $sql1->fetch_assoc();
                                                        $fullname = $row1['dfname'] . ' '. $row1['dlname']; ?>
                                                    <td><?php echo $fullname ?></td>

                                                    <?php } ?>

                                                    <td><?php echo $row['dvname'] ?></td>
                                                    <td><?php echo $row['dvehicle_type'] ?></td>
                                                    <td><?php echo $row['dvehicle_num'] ?></td>
                                                    <td><?php echo $row['dstate_name'] ?></td>
                                                    <td><?php echo $row['dregdate'] ?></td>

                                                </tr>
                                            </tbody>
                                            <?php $num ++; } ?>

                                        </table>


                                        <form action="../process/update_vehicle_process.php" method="post">


                                            <!---- Outputing data from the location and terminal database --->
                                            <div class="row mb-3">
                                                <div class="form-group container col-md-4" style="margin-bottom: 10px;">
                                                    <label for="">Change Vehicle Destination</label>
                                                    <select name="vehicle_destination" id=""
                                                        class="form-control form-select">


                                                        <?php 
                                                        // $sqlx = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dlocation.state = dstate_registration.state_id GROUP BY dstate_name"); 
                                                        $sql1 = $conn->query("SELECT * FROM dvehicle_registration JOIN dstate_registration ON dstate_registration.dstate_id =  dvehicle_registration.dvehicle_dest WHERE dvehicle_id = '$vehicle_id'");

                                                        $row1 = $sql1->fetch_assoc();

                                                        
                                                        ?>
                                                        <option value="<?php echo $row1['dstate_id']  ?>">
                                                            <?php echo $row1['dstate_name'] ?></option>


                                                        <?php $sqlx = $conn->query("SELECT * FROM dstate_registration ") ?>


                                                        <?php if($sqlx->num_rows>0){
                                                        while($rowx = $sqlx->fetch_assoc()) { ?>
                                                        <option value="<?php echo $rowx['dstate_id']  ?>">
                                                            <?php echo $rowx['dstate_name'] ?></option>
                                                        <?php }}  ?>

                                                    </select>
                                                    <span class="text-danger">
                                                        <?php echo isset($errState) ? $errState : '' ?></span>
                                                </div>

                                                <div class="form-group container col-md-4" style="margin-bottom: 10px;">
                                                    <label for="">Change Driver</label>
                                                    <select name="driver" id="" class="form-control form-select">


                                                        <?php

                                                        // Query database to get all registered terminal 
                                                        $sql2 = $conn->query("SELECT * FROM dvehicle_registration WHERE dvehicle_id = '$vehicle_id'"); 

                                                        $row2 = $sql2->fetch_assoc();

                                                            if($row2['ddriver_id'] == 'not-assigned') {  ?>
                                                        <option value="<?php echo $row2['ddriver_id'] ?>">
                                                            <?php echo 'not-assigned' ?> </option>

                                                        <?php    } else {
                                                                $sql7 = $conn->query("SELECT * FROM dvehicle_registration JOIN dstaff_registration ON dstaff_registration.dstaff_id = dvehicle_registration.ddriver_id WHERE dvehicle_id = '$vehicle_id'"); 
                                                                $row7 = $sql7->fetch_assoc();
                                                                
                                                                $fullname = $row7['dfname']. ' '.$row7['dlname']; 
                                                                //$_SESSION['driver_id'] = $row7['ddriver_id'] ?>

                                                        <option value="<?php echo $row7['dstaff_id'] ?>">
                                                            <?php echo $fullname ?></option>
                                                        <?php   } 
                        
                                                        $sql3 = $conn->query("SELECT * FROM drivers JOIN dstaff_registration ON dstaff_registration.dstaff_id = drivers.driver_id WHERE vehicle_id = 'not-assigned'");
                                                        
                                                        if($sql3->num_rows > 0) {
                                                                $row3 = $sql->fetch_assoc();
                                                            } 

                                                            $num = 0;
                                                            // Fetching each data in a row and looping to the next data
                                                            while($row3 = $sql3->fetch_assoc()) {
                                                                $fullname = $row3['dfname']. ' '.$row3['dlname']; ?>

                                                        <option value="<?php echo $row3['dstaff_id']?>">
                                                            <?php echo $fullname ?></option>
                                                        <?php 
                                                            } $num++; 
                                                            
                                                      ?>
                                                        <option value="not-assigned">not-assigned</option>




                                                    </select>

                                                </div>
                                                <?php
                                               
                                               $sql8 = $conn->query("SELECT * FROM dvehicle_registration WHERE dvehicle_id = '$vehicle_id'" );
                                               $row8 = $sql8->fetch_assoc();
                                               
                                                if($row8['ddriver_id'] != 'not-assigned') { ?>
                                                <div class="form-group container col-md-4" style="margin-bottom: 10px;">
                                                    <label for="">Change Driver Location</label>
                                                    <select name="driver_state" id="" class="form-control form-select">


                                                        <?php

                                                        // Query database to get all registered terminal 
                                                        $sql4 = $conn->query("SELECT * FROM dvehicle_registration WHERE dvehicle_id = '$vehicle_id' ");
                                                        $row4 = $sql4->fetch_assoc();
                                                        $driver_id = $row4['ddriver_id'];

                                                        $sql5 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$driver_id'");

                                                        $row5 = $sql5->fetch_assoc();
                                                        $state = $row5['dstaff_state'];
                                                        echo $state;
                                                        
                                                        // Checking if a driver is in transit 
                                                        if($row5['dstaff_state'] != 'in-transit') { 

                                                                // Oupting the driver state if not in transit
                                                                $sql6 = $conn->query("SELECT * FROM dstaff_registration JOIN dstate_registration ON dstate_registration.dstate_id = dstaff_registration.dstaff_state WHERE dstaff_id = '$driver_id'");
                                                                $row6 = $sql6->fetch_assoc(); ?>

                                                        <option class="disabled"
                                                            value="<?php echo $row6['dstate_id']?>">
                                                            <?php echo $row6['dstate_name'] ?></option>

                                                        <?php
                                                                $sql7 = $conn->query("SELECT * FROM dstate_registration ");
                                                                    if($sql2->num_rows > 0) {
                                                                        $row = $sql->fetch_assoc();
                                                                    } 

                                                                
                                                                    $num = 0;
                                                                    // Fetching each data in a row and looping to the next data
                                                                    while($row7 = $sql7->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row7['dstate_id']?>">
                                                            <?php echo $row7['dstate_name'] ?></option>
                                                        <?php } $num++; ?>

                                                        <?php  } else { ?>

                                                        <option value="<?php echo $row5['dstaff_state']?>">
                                                            <?php echo 'in-transit' ?></option>

                                                        <?php     }  ?>






                                                    </select>
                                                </div>


                                                <?php } ?>



                                                <!--- This input helps to hold id of the variable cl  -->
                                                <?php //print_r($driver_id) ?>
                                                <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id?>">
                                                <input type="hidden" name="driver_id" value="<?php echo $driver_id?>">

                                            </div>
                                            <button name="update" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#myModal" style="margin-left: 10px;">Update</button>
                                        </form>

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
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
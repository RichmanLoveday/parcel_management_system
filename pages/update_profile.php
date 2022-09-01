<?php 
    ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php'; 
    
        if(isset($_POST['update'])) {
            include_once '../process/profile_edit_process.php';
        } elseif(isset($_POST['update-state'])) {
            include_once '../process/update_state_process.php';
        }
      
      
    $position = $_SESSION['position'];
    $id = $_GET['id'];

    ($_SESSION['success'] != true) ? header('Location:login.php') : '';
    
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard - SB Admin</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <?php 
                
               
          
                if(isset($id) && $position == 'admin') {
                    $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position' ");

                    if($conn -> connect_error) {
                        die("Connection Error: ". $conn -> connect_error);
              
                    } elseif($sql -> num_rows > 0) {
                      $rows = $sql -> fetch_assoc();
              
                      // echo '<pre>';
                      // print_r($rows);
                      // echo '</pre>';
              
                    
                    
                    ?>
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-lg-7">
                        <div class="card rounded-lg mt-5">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Profile
                            </div>
                            <div class="card-body">

                                <form action="update_profile.php" method="post">
                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">First Name</label>
                                        <input type="text" name="fname" class="form-control" placeholder=""
                                            value="<?php echo $rows['dfname'] ?>">
                                        <span
                                            class="text-danger"><?php echo isset($fnameError) ? $fnameError : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" class="form-control"
                                            placeholder="<?php echo $rows['dlname'] ?>"
                                            value="<?php echo $rows['dlname'] ?>">
                                        <span
                                            class="text-danger"><?php echo isset($lnameError) ? $lnameError : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="<?php echo $rows['dusername'] ?>" disabled>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control"
                                            placeholder="<?php echo $rows['demail'] ?>" disabled>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Gender</label> <br>
                                        <input type="radio" checked name="gender" value="MALE">
                                        <label for="male">Male</label>
                                        <input type="radio" name="gender" value="FEMALE">
                                        <label for="female">Female</label><br>
                                    </div>


                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Date of birth</label>
                                        <input type="date" name="birth" class="form-control" placeholder=""
                                            value="<?php echo $rows['ddob'] ?>">

                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Postion</label>
                                        <input type="text" class="form-control"
                                            placeholder="<?php echo $rows['dposition'] ?>" disabled>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="location">State</label>
                                        <?php 
                                        $state_id = $rows['dstaff_state'];
                                        $sql1 = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = $state_id ");
                                        $row1 = $sql1->fetch_assoc(); ?>
                                        <select name="state" class="form-control form-select">
                                            <option value="<?php echo $row1['dstate_id'] ?>">
                                                <?php echo $row1['dstate_name'] ?>
                                            </option>
                                            <?php 
                                                    $sqlx = $conn->query("SELECT * FROM dstate_registration ORDER BY dstate_name");
                                                    if($sqlx->num_rows>0){
                                                    while($rowx = $sqlx->fetch_assoc()) { ?>
                                            <option value=" <?php echo $rowx['dstate_id'] ?>">
                                                <?php echo $rowx['dstate_name'] ?></option>
                                            <?php }}  ?>
                                        </select>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Terminal</label>
                                        <select name="terminal" class="form-control form-select">
                                            <?php  $terminal = $rows['dterminal_id'];
                                            $sql2 = $conn->query("SELECT * FROM dlocation WHERE dlocation_id = '$terminal' ");
                                            $row2 = $sql2->fetch_assoc();  ?>
                                            <option value="<?php echo $row2['dlocation_id'] ?>">
                                                <?php echo $row2['dterminal'] ?>
                                            </option>

                                            <?php

                                                    // Query database to get all registered terminal 
                                                    $sql2 = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id WHERE dlocation_status = 'active' order by dstate_name");

                                                    $num = 0;
                                                    if($sql2->num_rows > 0) {
                                                        // Fetching each data in a row and looping to the next data
                                                        while($row2 = $sql2->fetch_assoc()) { ?>
                                            <option value="<?php echo $row2['dlocation_id']  ?>">
                                                <?php echo $row2['dstate_name'] . ' - ' . ucfirst($row2['dterminal']) ?>
                                            </option>
                                            <?php } } ?>
                                        </select>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Address</label>
                                        <textarea placeholder="<?php echo $rows['dads'] ?>"
                                            value="<?php echo $rows['dads'] ?>" name="ads" id="" cols="30" rows="5"
                                            class="form-control"></textarea>
                                    </div>



                                    <button class="btn btn-primary mx-4" type="submit" name="update">Submit</button>

                                    <!-- <a href="admin_edit.php?admin_id= ?>">
                                              <button class="btn btn-primary mx-3 my-3">Submit</button>
                                          </a> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php } ?>
            <?php }elseif(isset($id) && $position != 'admin' && $position != 'Driver' && $position != 'Office-staff') { 
                        
                        $sql1 = $conn->query("SELECT * FROM duser_registration WHERE duser_id = '$id' AND dusername = '$position' ");

                        if($conn -> connect_error) {
                            die("Connection Error: ". $conn -> connect_error);
                  
                        } elseif($sql1 -> num_rows > 0) {
                          $row1 = $sql1 -> fetch_assoc();
                  
                          // echo '<pre>';
                          // print_r($rows);
                          // echo '</pre>';
                  
                        }  ?>


            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-lg-7">
                        <div class="card rounded-lg mt-5">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Profile
                            </div>
                            <div class="card-body">

                                <form action="edit_profile.php" method="post">
                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">First Name</label>
                                        <input type="text" name="fname" class="form-control" placeholder=""
                                            value="<?php echo $row1['dfname'] ?>">
                                        <span
                                            class="text-danger"><?php echo isset($fnameError) ? $fnameError : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" class="form-control"
                                            placeholder="<?php echo $row1['dlname'] ?>"
                                            value="<?php echo $row1['dlname'] ?>">
                                        <span
                                            class="text-danger"><?php echo isset($lnameError) ? $lnameError : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="<?php echo $row1['dusername'] ?>" disabled>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control"
                                            placeholder="<?php echo $row1['demail'] ?>" disabled>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Gender</label> <br>
                                        <input type="radio" checked name="gender" value="MALE">
                                        <label for="male">Male</label>
                                        <input type="radio" name="gender" value="FEMALE">
                                        <label for="female">Female</label><br>
                                    </div>


                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Date of birth</label>
                                        <input type="date" name="birth" class="form-control" placeholder=""
                                            value="<?php echo $row1['ddob'] ?>">

                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="location">State</label>
                                        <select name="state" class="form-control form-select">
                                            <option value="">---choose state---</option>
                                            <?php states(); ?>
                                        </select>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px;">
                                        <label for="">Address</label>
                                        <textarea placeholder="<?php echo $row1['daddress'] ?>"
                                            value="<?php echo $row1['daddress'] ?>" name="ads" id="" cols="30" rows="5"
                                            class="form-control"></textarea>
                                    </div>



                                    <button class="btn btn-primary mx-4" type="submit" name="update">Submit</button>

                                    <!-- <a href="admin_edit.php?admin_id= ?>">
                                              <button class="btn btn-primary mx-3 my-3">Submit</button>
                                          </a> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php } elseif(isset($id) && $position == 'Driver') { ?>

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"> Update State </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">

                                <div class="card-body">


                                    <?php echo isset( $_SESSION['message'])  ?   $_SESSION['message']  : ''; ?>
                                    <div class="card mb-4">
                                        <div class="card-header bg-primary text-white">
                                            <i class="fas fa-table me-1"></i>
                                            Manage States
                                        </div>
                                        <div class="card-body">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th>S/N</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Current State</th>
                                                        <th>Vehicle Name</th>
                                                        <th>Vehicle Type</th>
                                                        <th>Vehicle Number</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr class="bg-primary text-white">
                                                        <th>S/N</th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Current State</th>
                                                        <th>Vehicle Name</th>
                                                        <th>Vehicle Type</th>
                                                        <th>Vehicle Number</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php  
                                            
                                            $sql2 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id'" );

                                            // Queering the driver to get drivers with vehicles
                                            $sql4 = $conn->query("SELECT * FROM drivers WHERE driver_id = '$id'");
                                            $row4 = $sql4->fetch_assoc();
                                            
                                            
                                    
                                                if($conn->connect_error) {
                                                    die("Connection Error: ".$conn->connect_error);

                                                // checking the condition when the driver is not in transit 
                                                } elseif($row2['dstaff_state'] != 'in-transit') { 
                                                    $state_id = $row2['dstaff_state'];
                                                    //echo $state_id;

                                                    $sql3 = $conn->query("SELECT * FROM dstaff_registration JOIN
                                                    dstate_registration ON dstate_registration.dstate_id = dstaff_registration.dstaff_state WHERE dstaff_id = '$id'"); 
                                                    $row3 = $sql3->fetch_assoc();
                                                    $driver_name = $row3['dfname']. ' '.$row3['dlname'];
                                                    $role = $row3['dposition'];
                                                    $state = $row3['dstate_name'];
                                                    $row2 = $sql2->fetch_assoc();

                                                    // echo $driver_name;
                                                    // echo $state;
                                                    // echo $role;


                                                    ?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><?php echo $driver_name ?></td>
                                                        <td><?php echo $role ?></td>
                                                        <td><?php echo $state ?></td>
                                                        <?php 
                                                     // checking if a vehicle is assigned to a specific driver
                                                    if($row4['vehicle_id'] != 'not-assigned') {
                                                        $vehicle_id = $row4['vehicle_id'];
                                                        
                                                        $sqlx = $conn->query("SELECT * FROM dvehicle_registration WHERE dvehicle_id = '$vehicle_id'");
                                                        $rowx = $sqlx->fetch_assoc();

                                                        $v_type = $rowx['dvehicle_type'];
                                                        $v_name = $rowx['dvname'];
                                                        $v_num = $rowx['dvehicle_num']; ?>

                                                        <td><?php echo $v_name ?></td>
                                                        <td><?php echo $v_type ?></td>
                                                        <td><?php echo $v_num ?></td>

                                                        <?php     } else { ?>
                                                        <td><?php echo 'not-assigned' ?></td>
                                                        <td><?php echo 'not-assigned' ?></td>
                                                        <td><?php echo 'not-assigned' ?></td>

                                                        <?php    } ?>
                                                    </tr>
                                                    <?php  
                                              // If the driver is in transit, display this messages 
                                                    } else {

                                                  $driver_name = $row2['dfname']. ' '.$row2['dlname'];
                                                  $role = $row2['dposition'];
                                                   ?>


                                                    <tr>
                                                        <td>1</td>
                                                        <td><?php echo $driver_name ?></td>
                                                        <td><?php echo $role ?></td>
                                                        <td><?php echo 'in-transit' ?></td>

                                                        <?php 
                                                    // checking if a vehicle is assigned to a specific driver
                                                    if($row4['vehicle_id'] != 'not-assigned') {
                                                        $vehicle_id = $row4['vehicle_id'];
                                                        //echo $vehicle_id;
                                                        $sql11 = $conn->query("SELECT * FROM dvehicle_registration WHERE dvehicle_id = '$vehicle_id'");
                                                        $row11 = $sql11->fetch_assoc();

                                                        $v_type = $row11['dvehicle_type'];
                                                        $v_name = $row11['dvname'];
                                                        $v_num = $row11['dvehicle_num']; ?>

                                                        <td><?php echo $v_name ?></td>
                                                        <td><?php echo $v_type ?></td>
                                                        <td><?php echo $v_num ?></td>

                                                        <?php     } else { ?>
                                                        <td><?php echo 'not-assigned' ?></td>
                                                        <td><?php echo 'not-assigned' ?></td>
                                                        <td><?php echo 'not-assigned' ?></td>
                                                    </tr>
                                                    <?php    } 
                                              }

                                            ?>

                                            </table>


                                            <form action="../process/update_state_process.php" method="post">

                                                <!---- Outputing data from the location and terminal database --->
                                                <div class="row mb-3">
                                                    <div class="form-group container col-md-6"
                                                        style="margin-bottom: 10px;">
                                                        <label for="">State</label>
                                                        <select name="state" id="" class="form-control form-select">


                                                            <?php 
                                                        // $sqlx = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dlocation.state = dstate_registration.state_id GROUP BY dstate_name"); 
                                                        $sql5 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = $id");
                                                        $row5 = $sql5->fetch_assoc();

                                                        if($row5['dstaff_state'] == 'in-transit') { ?>
                                                            <option value="<?php echo $row5['dstaff_state'] ?>">
                                                                <?php echo 'in-transit' ?></option>
                                                            <?php  } else { 

                                                            $sql6 = $conn->query("SELECT * FROM dstaff_registration JOIN dstate_registration ON dstate_registration.dstate_id = dstaff_registration.dstaff_state WHERE dstaff_id = '$id' ");
                                                            $row6 = $sql6->fetch_assoc(); ?>

                                                            <option value="<?php echo $row6['dstaff_state'] ?>">
                                                                <?php echo $row6['dstate_name'] ?></option>
                                                            <?php   
                                                        }
                                                        
                                                        
                                                       // Outputing states only when the package has arrived terminal have been delivered for a specific vehicle

                                                       // First check if a vehicle is assigned to a specific driver
                                                       if($row4['vehicle_id'] != 'not-assigned') { 
                                                           $vehicle_id = $row4['vehicle_id']; // storing the vehicle id in a variable

                                                        
                                                        $sql10 = $conn->query("SELECT * FROM dstate_registration ");

                                                        // Looping over the available states in the states table
                                                        while($row10 = $sql10->fetch_assoc()) { ?>
                                                            <option value="<?php echo $row10['dstate_id']  ?>">
                                                                <?php echo $row10['dstate_name'] ?></option>


                                                            <?php  } 
                                            
                                            } 

                                            


                                                    // Checking for conditions to display in transit
                                                    if($row4['vehicle_id'] == 'not-assigned') { 
                                                       echo ' ';
                                                    } else { ?>
                                                            <option value="in-transit">in-transit</option>
                                                            <?php   } ?>


                                                        </select>
                                                    </div>



                                                </div>

                                                <!--- This input helps to hold id of the variable cl  -->
                                                <input type="hidden" name="id" value="<?php echo $id ?>">

                                                <button name="update-state" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#myModal"
                                                    style="margin-left: 10px;">Update</button>
                                            </form>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            </main>

            <?php    } else {
                        echo ' ';
              } ?>
        </main>
        <?php include '../includes/footer.php';
                unset($_SESSION['admin_edit_profile']); 
                ob_end_flush();?>
    </div>
    </div>
    <?php include '../includes/scripts.php'; ?>
</body>

</html>
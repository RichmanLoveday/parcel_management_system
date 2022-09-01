<?php 
    include '../includes/config.php';
    include '../includes/header.php';
    include '../includes/css_files.php'; 
    

    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];
    ($_SESSION['success'] != true) ? header('Location:login.php') : '';
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content" class="bg-info">
        <main>
            <?php if(isset($id) && $position == 'admin') { 
                    
                    $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position' ");

                    if($conn->connect_error) {
                        die("Connection Error:" .$conn->connect_error);

                    } elseif($sql -> num_rows > 0) {
                        
                        $rows = $sql->fetch_assoc();

                        // echo '<pre>';
                        // print_r($rows);
                        // echo '</pre>';

                        $fullname = $rows['dfname'] . " " . $rows['dlname'];
                        $state = $rows['dstaff_state'];
                        $terminal = $rows['dterminal_id'];

                    }
                ?>



            <div class="container-fluid px-4">
                <h1 class="mt-4">My Profile</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">My account</li>
                </ol>

                <div class="row">
                    <div class="col-xl-8 ">
                        <div class="card mb-4">
                            <?php echo isset($_SESSION['edit_profile']) ? $_SESSION['edit_profile'] : '' ?>
                            <?php echo isset($_SESSION['update']) ? $_SESSION['update'] : '' ?>
                            <div class="card-header bg-black text-warning">
                                <i class="fas fa-chart-area me-1"></i>
                                Profile Details
                            </div>
                            <div>
                                <ul class="list-group">
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold p-2 "> Name</span>
                                        <span class=" badge px-3 text-light"> <?php echo $fullname; ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Role </span>
                                        <span class=" badge px-3 text-light"> <?php echo $position ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Email</span>
                                        <span class=" badge px-3 text-light"> <?php echo $rows['demail'] ?></span>

                                    </li>

                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <?php $sql1 = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = $state ");
                                        $row1 = $sql1->fetch_assoc(); ?>
                                        <span class="badge font-weight-bold "> State</span>
                                        <span class=" badge px-3 text-light"> <?php echo $row1['dstate_name'] ?>
                                        </span>

                                    </li>

                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <?php $sql2 = $conn->query("SELECT * FROM dlocation WHERE dlocation_id = $terminal ");
                                        $row2 = $sql2->fetch_assoc(); ?>
                                        <span class="badge font-weight-bold "> Terminal</span>
                                        <span class=" badge px-3 text-light"> <?php echo $row2['dterminal'] ?>
                                        </span>

                                    </li>

                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold ">Gender</span>
                                        <span class=" badge px-3 text-light"> <?php echo $rows['dgender'] ?> </span>
                                    </li>
                                </ul>
                                <a
                                    href="update_profile.php?id=<?php echo $rows['dstaff_id'] ?>&position=<?php echo $rows['dposition']?> ">
                                    <button class="btn btn-primary mx-3 my-3">Edit Profile</button>
                                </a>
                            </div>

                            <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div> -->
                        </div>
                    </div>

                </div>
                <?php } elseif(isset($id) && $position != 'Driver' && $position != 'Office-staff' && $position != 'admin' ) { 

                                $sql1 = $conn->query("SELECT * FROM duser_registration WHERE duser_id = '$id' AND dusername = '$position' ");

                                if($conn->connect_error) {
                                    die("Connection Error:" .$conn->connect_error);

                                } elseif($sql1 -> num_rows > 0) {
                                    
                                    $row = $sql1->fetch_assoc();

                                    // echo '<pre>';
                                    // print_r($rows);
                                    // echo '</pre>';

                                    $fullname = $row['dfname'] . " " . $row['dlname'];

                                }
                                                        
                        ?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">My Profile</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">My account</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-8 ">
                            <div class="card mb-4">
                                <?php echo isset($_SESSION['edit_profile']) ? $_SESSION['edit_profile'] : '' ?>
                                <?php echo isset($_SESSION['update']) ? $_SESSION['update'] : '' ?>
                                <div class="card-header bg-black text-warning">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Profile Details
                                </div>
                                <div>
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                            <span class="badge font-weight-bold p-2 "> Name</span>
                                            <span class=" badge px-3 text-light"> <?php echo $fullname; ?></span>

                                        </li>
                                        <li
                                            class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                            <span class="badge font-weight-bold "> Username </span>
                                            <span class=" badge px-3 text-light">
                                                <?php echo $row['dusername']; ?></span>

                                        </li>
                                        <li
                                            class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                            <span class="badge font-weight-bold "> Email</span>
                                            <span class=" badge px-3 text-light">
                                                <?php echo $row['demail'] ?></span>

                                        </li>
                                        <li
                                            class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                            <span class="badge font-weight-bold "> Phone</span>
                                            <span class=" badge px-3 text-light"> <?php echo $row['dphn']; ?>
                                            </span>

                                        </li>

                                        <li
                                            class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                            <span class="badge font-weight-bold ">Gender</span>
                                            <span class=" badge px-3 text-light"> <?php echo $row['dgender'] ?>
                                            </span>
                                        </li>
                                    </ul>
                                    <a
                                        href="update_password.php?id=<?php echo $row['duser_id'] ?>&username=<?php echo $row['dusername']?> ">
                                        <button class="btn btn-primary mx-3 my-3">Change Password</button>
                                    </a>
                                </div>

                                <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div> -->
                            </div>
                        </div>

                    </div>

                    <?php } elseif(isset($id) && $position == 'Driver') {

                           // Quering the staff table to get the staff information
                           $sql2 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position' ");

                           if($conn->connect_error) {
                            die("Connection Error:" .$conn->connect_error);

                        } elseif($sql2 -> num_rows > 0) {
                            
                            $row2 = $sql2->fetch_assoc();

                            // echo '<pre>';
                            // print_r($row2);
                            // echo '</pre>';

                            // Quering the vehicle table to get the vehicle information
                            $sql3 = $conn->query("SELECT * FROM ((dvehicle_registration JOIN drivers ON drivers.driver_id = dvehicle_registration.ddriver_id)
                            JOIN dstate_registration ON dstate_registration.dstate_id = dvehicle_registration.dvehicle_dest) WHERE driver_id = '$id'");
                            $row3 = $sql3->fetch_assoc();

                            // Driver information
                            $fullname = $row2['dfname'] . " " . $row2['dlname'];
                            $email = $row2['demail'];
                            $role = $row2['dposition'];
                            $dob = $row2['ddob'];
                            $gender = $row2['dgender'];


                             // Vehicle Informamtion
                            $v_name = $v_type = $v_num = $v_dest = '';
                            if(isset($row3['ddriver_id'])) {
                                $v_name = $row3['dvname'];
                                $v_num = $row3['dvehicle_num'];
                                $v_type = $row3['dvehicle_type'];
                                $v_dest = $row3['dstate_name'] .' '.'State';
                            }
                           
                            // echo '<pre>';
                            // print_r($row3);
                            // echo '</pre>';


                        } ?>


                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">My account</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-8 ">
                                <div class="card mb-4">
                                    <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></span>

                                    <?php echo isset($_SESSION['edit_profile']) ? $_SESSION['edit_profile'] : '' ?>
                                    <?php echo isset($_SESSION['update']) ? $_SESSION['update'] : '' ?>
                                    <div class="card-header bg-black text-warning" style="border-radius: none;">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Driver Informamtion
                                    </div>

                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold p-2 "> Name</span>
                                        <span class=" badge px-3 text-light"> <?php echo $fullname; ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Role </span>
                                        <span class=" badge px-3 text-light"> <?php echo $role; ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Email</span>
                                        <span class=" badge px-3 text-light"> <?php echo $email ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Date of Birth</span>
                                        <span class=" badge px-3 text-light"> <?php echo $dob ; ?> </span>

                                    </li>
                                    <?php 
                                                if($row2['dstaff_state'] != 'in-transit') { 
                                                    $state_id = $row2['dstaff_state'];
                                                    $sql4 = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = '$state_id'");
                                                    $row4 = $sql4->fetch_assoc(); 
                                                    $state = $row4['dstate_name'];  ?>

                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Current State</span>
                                        <span class=" badge px-3 text-light"> <?php echo $state ?> </span>
                                    </li>
                                    <?php     } else { ?>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Current State</span>
                                        <span class=" badge px-3 text-light"> <?php echo 'in-transit' ?> </span>
                                    </li>
                                    <?php    } ?>




                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold ">Gender</span>
                                        <span class=" badge px-3 text-light"> <?php echo $gender ?> </span>
                                    </li>


                                    <div class="card-header bg-black text-warning">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Vehicle Information
                                    </div>

                                    <?php 
                                            if(isset($row3['driver_id'])) { ?>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold p-2 "> Vehicle name</span>
                                        <span class=" badge px-3 text-light"> <?php echo $v_name; ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Vehicle type </span>
                                        <span class=" badge px-3 text-light"> <?php echo $v_type; ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Vehicle number</span>
                                        <span class=" badge px-3 text-light"> <?php echo $v_num ?></span>

                                    </li>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class="badge font-weight-bold "> Vehcile Destination</span>
                                        <span class=" badge px-3 text-light"> <?php echo $v_dest ; ?> </span>

                                    </li>

                                    <?php  } else { ?>
                                    <li
                                        class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                        <span class=" badge font-weight-bold"> <?php echo 'not-assigned' ?></span>

                                    </li>
                                    <?php }  ?>
                                    <div>

                                        <a href="update_profile.php?id=<?php echo $id ?>">
                                            <button class="btn btn-primary mx-3 my-3">Update State</button>
                                        </a>
                                    </div>
                                </div>

                                <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div> -->
                            </div>
                        </div>
                    </div>

                    <?php  } else {

                         $sql = $conn->query("SELECT * FROM ((dstaff_registration JOIN dlocation ON dlocation.dlocation_id = dstaff_registration.dterminal_id) JOIN dstate_registration ON dstate_registration.dstate_id = dstaff_registration.dstaff_state) WHERE dstaff_id = '$id' AND dposition = '$position' ");

                    if($conn->connect_error) {
                        die("Connection Error:" .$conn->connect_error);

                    } elseif($sql -> num_rows > 0) {
                        
                        $rows = $sql->fetch_assoc();

                        // echo '<pre>';
                        // print_r($rows);
                        // echo '</pre>';

                        $fullname = $rows['dfname'] . " " . $rows['dlname'];
                        $state = $rows['dstaff_state'];
                        $terminal = $rows['dterminal_id'];

                    }
                ?>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">My account</li>
                        </ol>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-8 ">
                                <div class="card mb-4">

                                    <?php echo isset($_SESSION['edit_profile']) ? $_SESSION['edit_profile'] : '' ?>
                                    <?php echo isset($_SESSION['update']) ? $_SESSION['update'] : '' ?>
                                    <div class="card-header bg-black text-warning">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Profile Details
                                    </div>
                                    <div>
                                        <ul class="list-group">
                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold p-2 "> Name</span>
                                                <span class=" badge px-3 text-light">
                                                    <?php echo $fullname; ?></span>

                                            </li>
                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Role </span>
                                                <span class=" badge px-3 text-light">
                                                    <?php echo $rows['dusername']; ?></span>

                                            </li>
                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Email</span>
                                                <span class=" badge px-3 text-light">
                                                    <?php echo $rows['demail'] ?></span>

                                            </li>
                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Date of Birth</span>
                                                <span class=" badge px-3 text-light"> <?php echo $rows['ddob']; ?>
                                                </span>

                                            </li>

                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> State</span>
                                                <span class=" badge px-3 text-light">
                                                    <?php echo $rows['dstate_name'] ?>
                                                </span>

                                            </li>

                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Terminal</span>
                                                <span class=" badge px-3 text-light">
                                                    <?php echo $rows['dterminal'] ?>
                                                </span>

                                            </li>

                                            <li
                                                class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold ">Gender</span>
                                                <span class=" badge px-3 text-light"> <?php echo $rows['dgender'] ?>
                                                </span>
                                            </li>
                                        </ul>
                                        <a
                                            href="update_password.php?id=<?php echo $rows['dstaff_id'] ?>&position=<?php echo $rows['dposition']?> ">
                                            <button class="btn btn-primary mx-3 my-3">Change Password</button>
                                        </a>
                                    </div>

                                    <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div> -->
                                </div>
                            </div>

                        </div>

                        <?php   } ?>
        </main>
        <?php include '../includes/footer.php';
                unset($_SESSION['edit_profile']); 
                unset($_SESSION['update']);
                unset($_SESSION['output']);
                unset($_SESSION['null']); 
                unset($_SESSION['message']); ?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
<?php include '../includes/header.php';
      include '../includes/css_files.php'; 
      
      $position = $_SESSION['position'];
      $id = $_SESSION['staff_id'];
      ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage vehicle</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> My Vehicles </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Vehicle</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <?php echo isset($_SESSION['vehicle'])  ?   $_SESSION['vehicle']  : ''; ?>
                            <div class="card-body">
                                <?php
                              
                                // $id = $_GET['id'];
                                // $sql1 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' ");

                                // if($sql1 -> num_rows > 0) {
                                //     $rows1 = $sql1 -> fetch_assoc();
                                // }
                                
                            ?>

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
                                                    <th>Driver Location</th>
                                                    <th>Vehicle Destination</th>
                                                    <th>Date of Registration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Driver Name</th>
                                                    <th>Vehicle Name</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Driver Location</th>
                                                    <th>Vehicle Destination</th>
                                                    <th>Date of Registration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php  
                                            
                                            $sql = $conn->query("SELECT * FROM dvehicle_registration 
                                            JOIN dstate_registration ON dstate_registration.dstate_id = dvehicle_registration.dvehicle_dest
                                            ORDER BY dstate_name ");

                                            
                                                                                                                                        
                                                                                    
                                                if($conn->connect_error) {
                                                    die("Connection Error: ".$conn->connect_error);
                                                } elseif($sql->num_rows > 0) { 
                                                    echo '';
                                                }

                                            $num = 0;
                                            while($row = $sql->fetch_assoc()) { //print_r($row); 
                                                $vehicle_id = $row['dvehicle_id'];

                                                
                                                $sql1 = $conn->query("SELECT * FROM drivers
                                                JOIN dstaff_registration ON dstaff_registration.dstaff_id = drivers.driver_id  WHERE vehicle_id = '$vehicle_id'" ); 
                                                $row1 = $sql1->fetch_assoc();
                                                ?>


                                                <tr>
                                                    <td><?php echo $num +1?></td>

                                                    <?php if($row['ddriver_id'] == 'not-assigned') { ?>
                                                    <td>not-assigned</td>

                                                    <?php  } else {

                                                        $fullname = $row1['dfname'] . ' '. $row1['dlname']; ?>

                                                    <td><?php echo $fullname ?></td>

                                                    <?php } ?>
                                                    <td><?php echo $row['dvname'] ?></td>
                                                    <td><?php echo $row['dvehicle_type'] ?></td>
                                                    <td><?php echo $row['dvehicle_num'] ?></td>
                                                    <?php if($row['ddriver_id'] == 'not-assigned') { ?>
                                                    <td>not-assigned</td>

                                                    <?php }elseif($row1['dstaff_state'] == 'in-transit') { ?>
                                                    <td>in-transit</td>

                                                    <?php    } else {
                                                    $staff_id = $row1['dstaff_id'];
                                                    $sql2 = $conn->query("SELECT * FROM dstaff_registration JOIN dstate_registration ON dstate_registration.dstate_id = dstaff_registration.dstaff_state WHERE dstaff_id = '$staff_id'");
                                                    $row2 = $sql2->fetch_assoc(); ?>

                                                    <td><?php echo $row2['dstate_name']?></td>

                                                    <?php  }?>
                                                    <td><?php echo $row['dstate_name'] ?></td>
                                                    <td><?php echo $row['dregdate'] ?></td>

                                                    <td>

                                                        <!----- assigned specific links for each data from the database for easy GET request --->

                                                        <a href="update_vehicle.php?vehicle_id=<?php echo $row['dvehicle_id']?>"
                                                            class="btn btn-primary btn-sm" name="transfer">Update
                                                            Vehicle</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php $num ++; } ?>

                                        </table>

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
            unset($_SESSION['success1']); 
            unset($_SESSION['status_chg']);
            unset( $_SESSION['vehicle']); ?>

</body>

</html>
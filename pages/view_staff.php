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
    <title>Manage staff</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> My Staffs</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Staff</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <?php echo isset($_SESSION['status_change']) ?  $_SESSION['status_change'] : '';
                                echo isset($_SESSION['register']) ?  $_SESSION['register'] : '';
                                echo isset($_SESSION['transfer']) ?  $_SESSION['transfer'] : '';?>
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
                                        Manage Staffs
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Staff Full Name</th>
                                                    <th>Role</th>
                                                    <th>State</th>
                                                    <th>Terminal</th>
                                                    <th>Gender</th>
                                                    <th>Email</th>
                                                    <th>Date of Registration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Staff Full Name</th>
                                                    <th>Role</th>
                                                    <th>State</th>
                                                    <th>Terminal</th>
                                                    <th>Gender</th>
                                                    <th>Email</th>
                                                    <th>Date of Registration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php  
                                            
                                            $sql = $conn->query("SELECT * FROM ((dlocation JOIN dstaff_registration ON dstaff_registration.dterminal_id = dlocation.dlocation_id)
                                            JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id) WHERE dposition != 'admin' ORDER BY dposition"); 

                                                if($conn->connect_error) {
                                                    die("Connection Error: ".$conn->connect_error);
                                                } elseif($sql->num_rows > 0) {
                                                    $num = 0;
                                                    while($row = $sql->fetch_assoc()) { ?>

                                                <tr>
                                                    <td><?php echo $num +1?></td>
                                                    <td><?php echo $row['dfname'] . ' ' . $row['dlname'] ?></td>
                                                    <td><?php echo $row['dposition'] ?></td>
                                                    <td><?php echo $row['dstate_name'] ?></td>
                                                    <td><?php echo $row['dterminal'] ?></td>
                                                    <td><?php echo $row['dgender'] ?></td>
                                                    <td><?php echo $row['demail'] ?></td>
                                                    <td><?php echo $row['dregdate'] ?></td>
                                                    <td><?php echo $row['dstaff_status'] ?></td>
                                                    <td>


                                                        <!----- assigned specific links for each data from the database for easy GET request --->
                                                        <?php if($row['dstaff_status'] == 'enable' || $row['dstaff_status'] == 'online' || $row['dstaff_status'] == 'offline') { ?>
                                                        <a href="../process/staff_status_disable.php?id=<?php echo $row['dstaff_id'] ?>&position=<?php echo $row['dposition']?>"
                                                            class="btn btn-danger btn-sm" name="disable">Disable</a>
                                                        <?php } else { ?>

                                                        <a href="../process/staff_status_enable.php?id=<?php echo $row['dstaff_id'] ?>&position=<?php echo $row['dposition']?>"
                                                            class="btn btn-primary btn-sm" name="enable">Enable</a>
                                                        <?php } ?>

                                                        <a href="staff_transfer.php?id=<?php echo $row['dstaff_id'] ?>"
                                                            class=" btn btn-primary btn-sm" name="transfer">Transfer</a>

                                                    </td>
                                                </tr>
                                                <?php $num ++; } ?>
                                            </tbody>
                                            <?php  } ?>

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
            unset($_SESSION['transfer']); 
            unset($_SESSION['status_change']); ob_end_flush();?>

</body>

</html>
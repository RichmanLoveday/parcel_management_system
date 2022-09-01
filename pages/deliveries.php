<?php
include '../includes/css_files.php';
include '../includes/header.php';

$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];

//print_r($terminal);
($_SESSION['success'] != true) ? header('Location: login.php') : ''; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>History</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"> Deliveries</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage package</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        View Deliveries
                                    </div>
                                    <div class="card-body">
                                        <span
                                            class="alert-success"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?></span>
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Package Name</th>
                                                    <th>Package ID</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Package Name</th>
                                                    <th>Package ID</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <?php 
                                                        $sql = $conn->query("SELECT * FROM dpackage_registration WHERE dsender_id = '$id' ORDER BY id DESC");
                                                        //print_r($id);

                                                        
                                                        if($conn->connect_error) {
                                                            die("Connection Error: ".$conn->connect_error);
                                                        } elseif($sql == TRUE) {
                                                            
                                                            $num = 0;
                                                            while($row = $sql->fetch_assoc()) { 
                                                            $package_id = $row['dpackage_id']; ?>
                                            <tr>
                                                <td><?php echo $num +1 ?></td>
                                                <td><?php echo $row['dpackage_name']?></td>
                                                <td><?php echo $row['dpackage_id'] ?></td>
                                                <td><?php 
                                                        if($row['dpackage_status'] == 'approved' || $row['dpackage_status'] == 'arrived') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Approved</a>

                                                    <?php } elseif($row['dpackage_status'] == 'pending') { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Pending</a>

                                                    <?php } elseif($row['dpackage_status']== 'canceled') { ?>
                                                    <a href="#" class="btn btn-danger btn-sm disabled">canceled</a>

                                                    <?php } else { ?>
                                                    <a href="#" class="btn btn-primary btn-sm disabled">Delivered</a>

                                                    <?php }
                                                ?>
                                                </td>

                                                <td>
                                                    <?php if($row['dpackage_status'] != 'pending') { ?>
                                                    <a href="package_detail.php?id=<?php echo $row['dpackage_id'] ?>"
                                                        class="btn btn-primary btn-sm">View</a>

                                                    <?php  } else { ?>

                                                    <a href="package_detail.php?id=<?php echo $row['dpackage_id'] ?>"
                                                        class="btn btn-primary btn-sm">View</a>
                                                    <a href="../process/cancel_booking_process.php?id=<?php echo $row['dpackage_id'] ?>"
                                                        class="btn btn-danger btn-sm">Cancel</a>

                                                    <?php     } ?>

                                                </td>
                                            </tr>
                                            <?php $num++;  }
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
<?php include '../includes/header.php';
      include '../includes/css_files.php'; 
      ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
     
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Terminal</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> Registered Locations</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Terminal</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <?php $location_id = '';
                                if(isset($_GET['id'])) {
                                    $location_id = $_GET['id'];

                                    $sql = $conn->query("SELECT * FROM dlocation INNER JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id WHERE dlocation_id = '$location_id'");

                                    if($sql -> num_rows > 0) {
                                        $row = $sql -> fetch_assoc();
                                    }
                                } ?>

                            <span
                                class="alert-success mx-10"><?php echo isset($_SESSION['location_create']) ? $_SESSION['location_create'] : '' ?></span>
                            <?php echo isset($_SESSION['edit_successful']) ? $_SESSION['edit_successful'] : '' ?>
                            <?php echo isset($_SESSION['status_change']) ? $_SESSION['status_change'] : '' ?>
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Manage Staffs
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th></th>
                                                    <th>State</th>
                                                    <th>Terminal</th>
                                                    <th>Status</th>
                                                    <th>Date of Registration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>State</th>
                                                    <th>Terminal</th>
                                                    <th>Status</th>
                                                    <th>Date of Registration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php  
                                            
                                            // Querying database to get all registered location
                                            $sql = $conn->query("SELECT * FROM dlocation INNER JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id ORDER BY dstate");
                                            if($conn->connect_error) {
                                                die("Connection Error: ".$conn->connect_error);
                                            } elseif($sql -> num_rows > 0) {
                                                $num = 0;
                                            
                                            // Fetching each row and looping through the database
                                            while($row = $sql->fetch_assoc()) { ?>
                                                <tr>
                                                    <!----------- Outputing each column and row from the database -------->
                                                    <td><?php echo $num + 1 ?></td>
                                                    <td><?php echo $row['dstate_name']?></td>
                                                    <td><?php echo $row['dterminal'] ?></td>
                                                    <td><?php echo $row['dlocation_status'] ?></td>
                                                    <td><?php echo $row['dregdate'] ?></td>

                                                    <td>

                                                        <!----- assigned specific links for each data from the database for easy GET request --->
                                                        <?php if($row['dlocation_status'] == 'active') { ?>
                                                        <a href="../process/staff_status_disable.php?id=<?php echo $row['dlocation_id'] ?>&terminal=<?php echo $row['dterminal']?>"
                                                            class="btn btn-danger btn-sm" name="disable">Disable</a>

                                                        <?php } else { ?>
                                                        <a href="../process/staff_status_enable.php?id=<?php echo $row['dlocation_id'] ?>&terminal=<?php echo $row['dterminal']?>"
                                                            class="btn btn-primary btn-sm" name="enable">Enable</a>

                                                        <?php } ?>

                                                        <a href="edit_location.php?id=<?php echo $row['dlocation_id'] ?>"
                                                            class="btn btn-primary btn-sm" name="transfer">Edit
                                                            Location</a>
                                                    </td>

                                                </tr>
                                            </tbody>
                                            <?php $num ++; } ?>
                                            <?php } ?>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>
        <?php include '../includes/footer.php'; ?>
    </div>
    </div>
    <?php include '../includes/scripts.php';
            unset($_SESSION['location_create']);
            unset($_SESSION['edit_successful']); 
            unset($_SESSION['status_change']); ?>


</body>

</html>
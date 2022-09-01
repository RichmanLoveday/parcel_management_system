<?php 
    ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php';
    
    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];
    
    if(isset($_POST['register'])) {
        include '../process/vehicle_registration_process.php';
    }
    
    ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Vehicle</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Register Vehicle</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Vehicle Registration</li>
                </ol>
                <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                <div class="flex" style="display: flex; justify-content: center; align-content: center;">
                    <div class="card " style="width: 50%">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Please fill in all input correctly.
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <?php echo isset($message ) ? $message  : '' ?>
                                <form action="vehicle_registration.php" method="post" style="margin-top: 20px;">
                                    <div class="container form-group" style="margin-bottom: 10px">
                                        <label for="">Name of vehicle</label>
                                        <input type="text" name="v_name" class="form-control"
                                            placeholder="<?php echo isset($vname) ? $vname : ''?>">
                                        <?php echo isset($errVname) ? $errVname : '' ?>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px; ">
                                        <label for="">Vehicle Type</label>
                                        <input type="text" name="v_type" class="form-control"
                                            placeholder="<?php echo isset($vtype) ? $vtype : ''?>">
                                        <?php echo isset($errVtype) ? $errVtype : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px; ">
                                        <label for="">Vehicle Number</label>
                                        <input type="text" name="v_num" class="form-control"
                                            placeholder="<?php echo isset($vnum) ? $vnum : '' ?>">
                                        <?php echo isset($errVnum) ? $errVnum : '' ?>
                                    </div>

                                    <div class="container form-group " style="margin-bottom: 10px;">
                                        <label for="">Vehicle Destination</label>
                                        <select name="vehicle_destination" id="" class="form-control form-select">
                                            <option value="">---select destination---</option>

                                            <?php $sql = $conn->query("SELECT * FROM dstate_registration");
                                                if($sql->num_rows>0) {
                                                    // Fetching each data in a row and looping to the next data
                                                    while($row = $sql->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['dstate_id'] ?>">
                                                <?php echo $row['dstate_name']?></option>
                                            <?php } } ?>
                                        </select>
                                        <span class="text-danger"><?php echo isset($errDest) ? $errDest : '' ?></span>
                                    </div>
                            </div>
                            <button class="btn btn-primary" name="register" data-bs-toggle="moal"
                                data-bs-target="#myMoal" style="margin-left: 25px;">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include '../includes/footer.php'; 
                    ob_end_flush(); ?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
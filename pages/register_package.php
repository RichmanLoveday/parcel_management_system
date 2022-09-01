<?php 
    ob_start();
    include '../includes/css_files.php';
    include '../includes/config.php';
    include '../includes/header.php';      
    
    $id = $_SESSION['staff_id'];
    $position = $_SESSION['position'];


    if(isset($_POST['register'])) {
        include '../process/register_package_process.php';
    }
    ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Package Registration</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Register a package</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Static Navigation</li>
                </ol>
                <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                <div class="card" style="margin-bottom: 50px;">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Please fill in all forms correctly.
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="../process/register_package_process.php" method="post">

                                <div class="row mb-3">
                                    <?php
                                                $sql = $conn->query("SELECT * FROM duser_registration WHERE duser_id = '$id' AND dusername = '$position' ");

                                                if($conn->connect_error) {
                                                    die("Connection Error: ".$conn->connect_error);
                                                } elseif($sql->num_rows > 0) {
                                                    $row = $sql->fetch_assoc();
                                                    $fullname = $row['dfname'] . ' ' . $row['dlname'];
                                                } else {
                                                    echo 'Cannot Connect';
                                                }

                                            ?>
                                    <div class="form-group conatiner-flux col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Name of Sender</label>
                                        <input type="text" name="send_name" class="form-control"
                                            value="<?php echo $fullname ?>" disabled>
                                    </div>


                                    <div class="container-flux form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Name of Receiver</label>
                                        <input type="text" name="rec_name" class="form-control"
                                            value="<?php echo isset($receiver_name) ? $receiver_name : ''; ?>" required>
                                    </div>

                                    <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Receiver Phone</label>
                                        <input type="text" name="phn" class="form-control"
                                            value="<?php echo isset($phone) ? $phone : ''; ?>" required>

                                    </div>

                                    <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Name of package</label>
                                        <input type="text" name="pack_name" class="form-control"
                                            value="<?php echo isset($package) ? $package : ''; ?>" required>
                                    </div>

                                    <h5 style="margin-top: 10px; margin-bottom: 10px;">Destination of package</h5>
                                    <div class="form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">State</label>
                                        <select name="state" id="" class="form-control form-select" required>
                                            <option value="">---choose state---</option>

                                            <?php 
                                                        $sqlx = $conn->query("SELECT * FROM dstate_registration ORDER BY dstate_name");
                                                        if($sqlx->num_rows>0){
                                                        while($rowx = $sqlx->fetch_assoc()) { ?>
                                            <option value="<?php echo $rowx['dstate_id'] ?>">
                                                <?php echo $rowx['dstate_name'] ?></option>
                                            <?php }}  ?>

                                        </select>
                                        <span class="text-danger">
                                            <?php echo isset($errState) ? $errState : '' ?></span>
                                    </div>

                                    <div class="form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Terminal</label>
                                        <select name="terminal" id="" class="form-control form-select" required>
                                            <option value="">---choose terminal---</option>

                                            <?php
                                                        // Query database to get all registered terminal 
                                                        $sql = $conn->query("SELECT * FROM dlocation INNER JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id WHERE dlocation_status = 'active' order by dstate");

                                                        $num = 0;
                                                        if($sql->num_rows>0) {
                                                            // Fetching each data in a row and looping to the next data
                                                            while($row2 = $sql->fetch_assoc()) { ?>
                                            <option value="<?php echo $row2['dlocation_id']  ?>">
                                                <?php echo $row2['dstate_name'] . ' - ' . ucfirst($row2['dterminal']) ?>
                                            </option>
                                            <?php } } ?>

                                        </select>
                                        <span class="text-danger"> <?php echo isset($errTerm) ? $errTerm : '' ?></span>
                                    </div>

                                    <div class="container form-group col-md-20" style="margin-bottom: 10px;">
                                        <label for="">Address</label>
                                        <textarea name="ads" id="" value="" cols="30" rows="5" class="form-control"
                                            placeholder="Optional" name="<?php echo $ads ?>"></textarea>
                                        <span class="text-danger"> <?php echo isset($errAds) ? $errAds : '' ?></span>
                                    </div>
                                    <div>
                            </form>
                            <button class="btn btn-primary" name="register" data-bs-toggle="modal"
                                data-bs-target="#myModal">Submit</button>

                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include '../includes/footer.php'; 
                    unset($_SESSION['null']);
                    ob_end_flush(); ?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
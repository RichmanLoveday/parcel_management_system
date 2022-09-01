<?php 
ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php';
    
    if(isset($_POST['edit'])) {
        include_once '../process/edit_location_process.php';
    } elseif(isset($_POST['edit_state'])) {
        include_once '../process/edit_state.php';
    }
    ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard user</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Edit Location</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Location Registration</li>
                </ol>
                <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                <div class="flex" style="display: flex; justify-content: center; align-content: center;">
                    <div class="card " style="width: 100%">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Please fill in all input correctly.
                        </div>
                        <div class="card-body">
                            <?php
                                    $id = $_GET['id'];

                                    $sql = $conn->query("SELECT * FROM dlocation INNER JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id WHERE dlocation_id = '$id'");

                                    $sql1 = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = '$id'");

                                    if($conn->connect_error) {
                                        die("Connection Error: ".$conn->connect_error);
                                    } elseif($sql -> num_rows > 0) {

                                        $row = $sql->fetch_assoc(); ?>

                            <div class="container">
                                <form action="edit_location.php" method="post">
                                    <span
                                        class="alert-success my-10"><?php echo isset($success) ? $success : '' ?></span>
                                    <div class="container form-group" style="margin-bottom: 10px">
                                        <label for="">State</label>
                                        <input type="text" name="state" class="form-control"
                                            value="<?php echo $row['dstate_name'] ?>" disabled>
                                        <span
                                            class="text-danger my-10"><?php echo isset($errState) ? $errState : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px; ">
                                        <label for="">Terminal</label>
                                        <input type="text" name="terminal" class="form-control"
                                            value="<?php echo $row['dterminal'] ?>">
                                        <span
                                            class="text-danger my-10"><?php echo isset($errTerm) ? $errTerm : '' ?></span>

                                    </div>
                                    <div class="container form-group" style="margin-bottom: 10px; ">
                                        <input type="hidden" name="id" value="<?php echo $row['dlocation_id'] ?>">
                                    </div>

                                    <button class="btn btn-primary" name="edit" data-bs-toggle="moal"
                                        data-bs-target="#myMoal" style="margin-left: 25px;">Edit</button>
                                </form>
                            </div>

                            <?php    } else {  
                                    
                                $row1 = $sql1->fetch_assoc(); ?>

                            <div class="container">
                                <form action="edit_location.php" method="post">
                                    <span
                                        class="alert-success my-10"><?php echo isset($success) ? $success : '' ?></span>
                                    <div class="container form-group" style="margin-bottom: 10px">
                                        <label for="">State</label>
                                        <input type="text" name="state" class="form-control"
                                            value="<?php echo $row1['dstate_name'] ?>">
                                        <span
                                            class="text-danger my-10"><?php echo isset($errState) ? $errState : '' ?></span>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px; ">
                                        <input type="hidden" name="id" value="<?php echo $row1['dstate_id'] ?>">
                                    </div>

                                    <button class="btn btn-primary" name="edit_state" data-bs-toggle="moal"
                                        data-bs-target="#myMoal" style="margin-left: 25px;">Edit</button>
                                </form>
                            </div>
                            <?php       }
                            ?>

                        </div>
                    </div>
                </div>
        </main>
        <?php include '../includes/footer.php'; ?>
    </div>
    <?php include '../includes/scripts.php';
    ob_end_flush(); ?>

</body>

</html>
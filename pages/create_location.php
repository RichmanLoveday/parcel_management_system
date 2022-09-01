<?php 
    ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php';
    
    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];
    
    if(isset($_POST['create'])) {
        include '../process/create_location_process.php';
    }
    ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Terminal</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <?php if(isset($position) && isset($id)) { ?>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Create Location</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Create Terminal</li>
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
                            <div class="container">
                                <form action="create_location.php" method="post">
                                    <span
                                        class="alert-success my-10"><?php echo isset($success) ? $success : '' ?></span>
                                    <div class="container form-group" style="margin-bottom: 10px">
                                        <label for="">State</label>
                                        <select name="state" id="" class="form-control form-select">
                                            <option value="">----- select state ------</option>
                                            <?php
                                                $sql = $conn->query("SELECT * FROM dstate_registration");
                                                if($sql->num_rows > 0) {

                                                    while($row = $sql->fetch_assoc()) { ?>
                                            <label for="">State</label>
                                            <option value="<?php echo $row['dstate_id']?>">
                                                <?php echo $row['dstate_name'] ?></option>
                                            <span
                                                class="text-danger"><?php echo isset($errState) ? $errState : '' ?></span>
                                            <?php }
                                                }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="container form-group" style="margin-bottom: 10px; ">
                                        <label for="">Terminal</label>
                                        <input type="text" name="terminal" class="form-control"
                                            value="<?php echo isset($terminal) ? $terminal : '' ?>">
                                        <span
                                            class="text-danger my-10"><?php echo isset($errTerm) ? $errTerm : '' ?></span>
                                    </div>
                            </div>
                            <button class="btn btn-primary" name="create" data-bs-toggle="moal" data-bs-target="#myMoal"
                                style="margin-left: 25px;">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </main>
        <?php include '../includes/footer.php'; 
                    ob_end_flush(); ?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
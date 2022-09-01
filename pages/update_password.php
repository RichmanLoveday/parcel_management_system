<?php
    ob_start();
    include '../includes/config.php';
    include '../includes/css_files.php';
    include '../includes/header.php';
    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];

    //unset($_SESSION['update']);

    ($_SESSION['success'] != true) ? header('Location: login.php') : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
</head>

<body class="sb-nav-fixed">


    <div id="layoutSidenav_content">
        <main>
            <?php if(isset($position) AND isset($id)) {
        
        if(isset($_POST['update'])) {
            include "../process/update_password_process.php";
        }
        
        ?>
            <div class="container">
                <div class="row justify-content-start ">
                    <div class="col-lg-20">
                        <h1 class="mt-4">Change Password</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage password</li>
                        </ol>
                        <div class="card rounded-lg mt-5">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Change Password
                            </div>

                            <div class="card-body">
                                <form action="update_password.php" method="post">
                                    <div class="row mb-3">
                                        <div class="container-flux form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Password</label>
                                            <input type="password" name="oldpass" class="form-control"
                                                value="<?php echo isset($old_password) ? $rightPass : ''; ?>" required>
                                            <span class="text-danger">
                                                <?php echo isset($errPass) ? $errPass : '' ?>
                                            </span>
                                        </div>


                                        <div class="container-flux form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">New Password</label>
                                            <input type="password" name="newpass" class="form-control"
                                                value="<?php echo isset($new_password) ? $rightNewpass : ''; ?>"
                                                required>
                                            <span class="text-danger">
                                                <?php echo isset($errNewpass) ? $errNewpass : '' ?>
                                            </span>
                                        </div>

                                        <div class="container-flux form-group col-md-6" style="margin-bottom: 10px;">
                                            <label for="">Confirm password</label>
                                            <input type="password" name="confirm" class="form-control"
                                                value="<?php echo isset($confirm_password) ? $rightConpass : ''; ?>"
                                                required>
                                            <span class="text-danger">
                                                <?php echo isset($errConpass) ? $errConpass : '' ?>
                                            </span>
                                        </div>

                                    </div>

                                    <button href="update_password_process.php?id=<?php echo$rows['dstaff_id']?>"
                                        class="btn btn-primary" type="update" name="update">Update
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  } ?>
        </main>
        <?php include '../includes/footer.php'; ?>
    </div>
    </div>
</body>
<?php include '../includes/scripts.php'; 
ob_end_flush();?>

</html>
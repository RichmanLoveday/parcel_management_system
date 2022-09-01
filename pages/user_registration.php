<?php 
    ob_start();
    include '../includes/config.php';
    include '../includes/css_files.php'; 


    if(isset($_POST['register'])) {
        include '../process/user_registration_process.php';
    }
    //print_r($_SESSION) ;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration </title>
</head>

<body class="sb-nav-fixed bg-secondary">
    <div id="layoutSidenav_content">
        <main>
            <div class=" container" style="margin-bottom: 60px;">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <h1 class="mt-4" style="padding: 25px">Registeration </h1>
                            <!-- <div class="card mb-4">
                                <div class="card-body">
                                    <p class="mb-0">
                                        Notification for every package been delivered and asswell for error purposes.
                                    </p>
                                </div>
                            </div> -->

                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Please fill in all input correctly.
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <form action="user_registration.php" method="post">
                                            <span
                                                class="alert-success my-10"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?></span>
                                            <div class="row mb-3">

                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="fname" class="form-control"
                                                        value="<?php echo isset($fname) ? $fname : ''; ?>" required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errFname) ? $errFname : '' ?>
                                                    </span>
                                                </div>

                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">Last Name</label>
                                                    <input type="text" name="lname" class="form-control"
                                                        value="<?php echo isset($lname) ? $lname : ''; ?>" required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errLname) ? $errLname : '' ?>
                                                    </span>
                                                </div>

                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">Username</label>
                                                    <input type="text" name="username" class="form-control"
                                                        value="<?php echo isset($uname) ? $uname : ''; ?>" required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errUname) ? $errUname : '' ?>
                                                    </span>
                                                </div>

                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">Email</label>
                                                    <input type="text" name="email" class="form-control"
                                                        value="<?php echo isset($email) ? $email : ''; ?>" required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errEmail) ? $errEmail : '' ?>
                                                    </span>
                                                </div>

                                                <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                                    <label for="">Gender</label> <br>
                                                    <input type="radio" checked name="gender" value="MALE">
                                                    <label for="male">Male</label>
                                                    <input type="radio" name="gender" value="FEMALE">
                                                    <label for="female">Female</label><br>
                                                </div>

                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">Phone</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errPhn) ? $errPhn : '' ?>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">Password</label>
                                                    <input type="text" name="password" class="form-control"
                                                        value="<?php echo isset($password) ? $password : ''; ?>"
                                                        required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errPass) ? $errPass : '' ?>
                                                    </span>
                                                </div>


                                                <div class="container-flux form-group col-md-6"
                                                    style="margin-bottom: 10px;">
                                                    <label for="">Confirm Password</label>
                                                    <input type="text" name="conpass" class="form-control"
                                                        value="<?php echo isset($conpass) ? $conpass : ''; ?>" required>
                                                    <span class="text-danger">
                                                        <?php echo isset($errCon) ? $errCon : '' ?>
                                                    </span>
                                                </div>

                                            </div>
                                            <button class="btn btn-primary" name="register" data-bs-toggle="moal"
                                                data-bs-target="#myMoal">
                                                Submit
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    <?php include '../includes/footer.php'; 
                     ob_end_flush();
                     //unset($_SESSION['message'])?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
<?php 
    ob_start();
    include '../includes/config.php';
    include '../includes/header.php';
    include '../includes/css_files.php'; 
        
      $position = $_SESSION['position'];
      $id = $_SESSION['staff_id'];
      ($_SESSION['success'] != true) ? header('Location: login.php') : '';
      
     if(isset($_POST['register'])) {
        include '../process/staff_registration_process.php';
     } 

    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Register Staff</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Staff Registration</li>
                </ol>
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
                            <form action="registration.php" method="post">
                                <span
                                    class="alert-success my-10"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?></span>
                                <div class="row mb-3">

                                    <div class="form-group conatiner-flux col-md-6" style="margin-bottom: 10px; wid">
                                        <label for="">First Name</label>
                                        <input type="text" name="fname" class="form-control" value="" required>
                                        <span class="text-danger">
                                            <?php echo isset($errFname) ? $errFname : '' ?></span>
                                    </div>

                                    <div class="container-flux form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Last Name</label>
                                        <input type="text" name="lname" class="form-control" value="" required>
                                        <span class="text-danger">
                                            <?php echo isset($errLname) ? $errLname : '' ?></span>
                                    </div>

                                    <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" value="" required>
                                        <span class="text-danger">
                                            <?php echo isset($errEmail) ? $errEmail : '' ?></span>
                                    </div>

                                    <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Gender</label> <br>
                                        <input type="radio" checked name="gender" value="MALE">
                                        <label for="male">Male</label>
                                        <input type="radio" name="gender" value="FEMALE">
                                        <label for="female">Female</label><br>
                                    </div>

                                    <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Date of birth</label>
                                        <input type="date" name="birth" class="form-control" placeholder="" value=""
                                            required>
                                        <span class="text-danger">
                                            <?php echo isset($errBirth) ? $errBirth : '' ?></span>

                                    </div>

                                    <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Role</label>
                                        <select name="position" id="" class="form-control form-select" required>
                                            <option value="">---choose role---</option>
                                            <option value="Driver">Driver</option>
                                            <option value="Office-staff">Office-staff</option>
                                        </select>
                                        <span class="text-danger">
                                            <?php echo isset($errPosition) ? $errPosition : '' ?></span>
                                    </div>

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

                                    <div class="container form-group col-md-25" style="margin-bottom: 10px;">
                                        <label for="">Address</label>
                                        <textarea name="ads" id="" value="" cols="30" rows="5" class="form-control"
                                            required name="<?php echo $ads ?>"></textarea>
                                        <span class="text-danger"> <?php echo isset($errAds) ? $errAds : '' ?></span>
                                    </div>
                                </div>





                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" value="" required>
                                        <span class="text-danger"> <?php echo isset($errPass) ? $errPass : '' ?></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Confirm password</label>
                                        <input type="password" name="conpass" class="form-control" value="" required>
                                        <span class="text-danger"> <?php echo isset($errCon) ? $errCon : '' ?></span>
                                    </div>

                                </div>
                                <button class="btn btn-primary" name="register" data-bs-toggle="moal"
                                    data-bs-target="#myMoal" style="margin-left: 10px;">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </main>
        <?php include '../includes/footer.php'; 
                     ob_end_flush();
                     //unset($_SESSION['message'])?>
    </div>
    <?php include '../includes/scripts.php';
                    //unset($_SESSION['message']) ?>

</body>

</html>
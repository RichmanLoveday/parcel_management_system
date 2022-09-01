<?php 
    include '../includes/header.php';
    include '../includes/css_files.php';
    
    // When transfer button is clicked include admin_transfer page
    if(isset($_POST['transfer'])) {
      include_once "../process/staff_transfer_process.php";
  }

    // Get the request from the transfer button
    $id = $_GET['id'];

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
                <h1 class="mt-4">Transfer Staff</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">My staffs</a></li>
                    <li class="breadcrumb-item active">Staff Transfer</li>
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
                        Select Preffered Location
                    </div>
                    <div class="card-body">

                        <div class="container">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>S/N</th>
                                        <th>Staff Full Name</th>
                                        <th>Postion</th>
                                        <th>State</th>
                                        <th>Terminal</th>
                                        <th>Gender</th>
                                        <th>Date of Registration</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-primary text-white">
                                        <th>S/N</th>
                                        <th>Staff Full Name</th>
                                        <th>Postion</th>
                                        <th>State</th>
                                        <th>Terminal</th>
                                        <th>Gender</th>
                                        <th>Date of Registration</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <?php  // Run sql to display result on the table
                                                    $sql = $conn->query("SELECT * FROM ((dlocation JOIN dstaff_registration ON dstaff_registration.dterminal_id = dlocation.dlocation_id)
                                                    JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id) WHERE dstaff_id = '$id'; ");

                                                    if($conn->connect_error) {
                                                        die('Connection Error: '.$conn->connect_error );

                                                    } elseif($sql->num_rows > 0) {
                                                        $row = $sql->fetch_assoc();

                                                    //   echo '<pre>';
                                                    //   print_r($row);
                                                    //   echo '</pre>';
                                                    } ?>

                                        <td>1</td>
                                        <td><?php echo $row['dfname'] . ' ' . $row['dlname'] ?></td>
                                        <td><?php echo $row['dposition'] ?></td>
                                        <td><?php echo $row['dstate_name'] ?></td>
                                        <td><?php echo $row['dterminal'] ?></td>
                                        <td><?php echo $row['dgender'] ?></td>
                                        <td><?php echo $row['dregdate'] ?></td>
                                        <td><?php echo $row['dlocation_status'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="../process/staff_transfer_process.php" method="post">


                                <!---- Outputing data from the location and terminal database --->
                                <div class="row mb-3">
                                    <div class="form-group container col-md-6" style="margin-bottom: 10px;">
                                        <label for="">State</label>
                                        <select name="state" id="" class="form-control form-select">


                                            <?php 
                                                        // $sqlx = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dlocation.state = dstate_registration.state_id GROUP BY dstate_name"); 
                                                        $sqlx = $conn->query("SELECT * FROM dstate_registration JOIN dlocation ON dstate_registration.dstate_id =  dlocation.dstate GROUP BY dstate_name" );?>

                                            <option value="<?php echo $row['dstate_id'] ?>">
                                                <?php echo $row['dstate_name'] ?></option>

                                            <?php if($sqlx->num_rows>0){
                                                        while($rowx = $sqlx->fetch_assoc()) { ?>
                                            <option value="<?php echo $rowx['dstate_id']  ?>">
                                                <?php echo $rowx['dstate_name'] ?></option>
                                            <?php }}  ?>

                                        </select>
                                        <span class="text-danger">
                                            <?php echo isset($errState) ? $errState : '' ?></span>
                                    </div>

                                    <div class="form-group container col-md-6" style="margin-bottom: 10px;">
                                        <label for="">Terminal</label>
                                        <select name="terminal" id="" class="form-control form-select">


                                            <?php

                                                        // Query database to get all registered terminal 
                                                        $sql2 = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dlocation.dstate = dstate_registration.dstate_id WHERE dlocation_status = 'active' order by dstate_name"); ?>

                                            <option value="<?php echo $row['dlocation_id']?>">
                                                <?php echo $row['dstate_name'] . ' - ' . ucfirst($row['dterminal']) ?>
                                            </option>

                                            <?php if($sql2->num_rows > 0) {
                                                            $row = $sql->fetch_assoc();
                                                        } 

                                                       
                                                        $num = 0;
                                                        // Fetching each data in a row and looping to the next data
                                                        while($row2 = $sql2->fetch_assoc()) { ?>
                                            <option value="<?php echo $row2['dlocation_id']?>">
                                                <?php echo $row2['dstate_name'] . ' - ' . ucfirst($row2['dterminal']) ?>
                                            </option>
                                            <?php } $num++; ?>

                                        </select>
                                        <span class="text-danger"> <?php echo isset($errTerm) ? $errTerm : '' ?></span>
                                    </div>

                                </div>


                                <!--- This input helps to hold id of the variable cl  -->
                                <input type="hidden" name="id" value="<?php echo $id ?>">

                                <button name="transfer" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#myModal" style="margin-left: 10px;">Transfer</button>
                            </form>



                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include '../includes/footer.php' ?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
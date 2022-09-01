<?php 
    ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php';
    
    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];
    
    if(isset($_POST['create'])) {
        include '../process/create_state_process.php';
    }
    
    ($_SESSION['success'] != true) ? header('Location: login.php') : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create state</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <?php if(isset($position) && isset($id)) { ?>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Create State</h1>
                <ol class="breadcrumb mb-4">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create state</li>
                    </ol>
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

                        <?php echo isset($_SESSION['state_create']) ? $_SESSION['state_create'] : '' ?>
                        <?php echo isset($_SESSION['state_edit']) ? $_SESSION['state_edit'] : '' ?>
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Please fill in all input correctly.
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <form action="create_state.php" method="post">
                                    <div class="container form-group" style="margin-bottom: 10px">
                                        <label for="">State</label>
                                        <input type="text" name="state" class="form-control"
                                            value="<?php echo isset($state) ? $state : '' ?>">
                                        <span
                                            class="text-danger my-10"><?php echo isset($errState) ? $errState : '' ?></span>
                                    </div>
                            </div>
                            <button class="btn btn-primary" name="create" data-bs-toggle="moal" data-bs-target="#myMoal"
                                style="margin-left: 25px;">
                                Create
                            </button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row" style="margin-top: 50px">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <?php echo isset($_SESSION['status_change']) ? $_SESSION['status_change'] : '' ?>
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Manage States
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th></th>
                                                    <th>Created By</th>
                                                    <th>State</th>
                                                    <th>Date of Creation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>State</th>
                                                    <th>Date of Creation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php  


                                                // Querying database to get all registered location
                                                $sql = $conn->query("SELECT * FROM dstate_registration ORDER BY dstate_name");
                                                
                                                if($conn->connect_error) {
                                                die("Connection Error: ".$conn->connect_error);
                                                } elseif($sql -> num_rows > 0) {
                                                $num = 0;

                                                // Fetching each row and looping through the database
                                                while($row = $sql->fetch_assoc()) { ?>
                                                <tr>
                                                    <!----------- Outputing each column and row from the database -------->
                                                    <td><?php echo $num + 1 ?></td>
                                                    <td><?php echo $row1['dposition']?></td>
                                                    <td><?php echo $row['dstate_name'] ?></td>
                                                    <td><?php echo $row['dreg_date'] ?></td>

                                                    <td>

                                                        <!----- assigned specific links for each data from the database for easy GET request --->
                                                        <a href="edit_location.php?id=<?php echo $row['dstate_id'] ?>"
                                                            class="btn btn-primary btn-sm" name="transfer">
                                                            Edit
                                                            state
                                                        </a>
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
            <?php } ?>
        </main>
        <?php include '../includes/footer.php';
                   // unset($_SESSION['state_create']); 
                    unset($_SESSION['state_edit']);
                    ob_end_flush(); ?>
    </div>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>
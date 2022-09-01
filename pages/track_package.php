<?php
    ob_start();
    include '../includes/header.php';
    include '../includes/css_files.php';
    //include '../includes/config.php'; 
        
      $position = $_SESSION['position'];
      $id = $_SESSION['staff_id'];
      //$terminal = $_SESSION['terminal'];
      //$state = $_SESSION['state'];
      
      //print_r($state);

      if(isset($_POST['search'])) {
          include '../process/track_package_process.php';
      }
      //print_r($position)
      ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>

<style>
.flex {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-content: center;
    padding: 30px;
    /* border: 1px solid brown; */
}

.col {
    border-radius: 10px;
    width: 50%;
    margin: auto;
    padding: 10px;
    text-align: center;
}

.col1 {
    height: 50px;
    width: 1%;
    margin: auto;
}

@media(max-width: 450px) {
    .col {
        width: 100%;
    }
}
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Track Package</title>
</head>

<body class='sb-nav-fixed'>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Track Package</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tracking Package</li>
                </ol>
                <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                <div class="container my-lg-5">
                    <form action="track_package.php" method="post">
                        <div class="container form-group" style="width: 65%;">
                            <label for="">Input Booking Id</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="booking_id" placeholder="203873633"
                                    value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                                <button class="btn btn-primary" name="search" id="btnNavbarSearch"><i
                                        class="fas fa-search"></i></button>
                            </div>
                            <span class="text-danger"><?php echo isset($errId) ? $errId : '' ?></span>

                        </div>
                    </form>
                </div>

                <?php 
                        //checking if theirs an ID in the url and it is set
                        if(isset($_GET['id'])) {
                            
                            $booking_id = $_GET['id'];      // storing the url ID in a variable 

                            // quering the database to get the package destinations or booking destinations
                            $sql = $conn->query("SELECT * FROM track_package WHERE booking_id = '$booking_id'");

                        // checking if connection exists
                        if($conn->connect_error) {
                            die("Connection Error: ".$conn->connect_error);
                        } elseif($sql->num_rows > 0) {      // checking if sql has the booking ID
                              
                ?>


                <div class="card">
                    <div class="card-header">
                        Destination of package
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="flex">

                                <?php 
                                    while($row = $sql->fetch_assoc()) {
                                        $tracking_status = $row['tracking_status']; 
                                        //print_r($row);

                                        $tracking_date = $row['tracking_date'];
                                        $time = strtotime($tracking_date);
                                        $to_date = getdate($time);
                                        $day = $to_date['weekday'];
                                        $date = $to_date['mday'];
                                        $month = $to_date['month'];
                                        $year = $to_date['year'];

                                        $date = $day. ','. ' '. $date. 'th'. ' ' .$month . ' ' .$year;

                                        $sql1 = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$booking_id'");
                                        $row1 = $sql1->fetch_assoc();
                                        $state_id = $row1['dstate_id'];
                                        $terminal = $row1['dlocation_id'];
                                        $book_terminal = $row1['dlocation_id'];
                                        $package_id = $row1['dpackage'];
                                            // print_r($to_date);
                                            
                                        ?>
                                <?php 
                                    switch($tracking_status) {
                                          
                                            
                                            case '1': 
                                            $sql2 = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dstate_registration.dstate_id = dlocation.dstate WHERE dstate = '$state_id' AND dlocation_id = '$terminal'");
                                            $row2 = $sql2->fetch_assoc();
                                            ?>
                                <div class="col bg-secondary text-white">
                                    <h6>Was booked</h6>
                                    <P>
                                        Your package has been booked and fulfied in
                                        <?php echo "{$row2['dstate_name']} state, {$row2['dterminal']} terminal station."?>
                                    </P>
                                    <p><?php echo $date ?></p>
                                </div>

                                <?php break;

                                    case '2': ?>
                                <span class="col1 bg-danger"></span>
                                <div class=" col bg-danger text-white">
                                    <h6>Was cancelled</h6>
                                    <P>
                                        Unfortunatelly your package was canceled.
                                    </P>
                                    <p><?php echo $date ?></p>
                                </div>

                                <?php break;
                                            
                                            case '3': 
                                                
                                                $sql2 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id' ");
                                                $row2 = $sql2->fetch_assoc();
                                                $state = $row2['dstate_id'];
                                                $terminal = $row2['dlocation_id'];
                                                $sql3 = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dstate_registration.dstate_id = dlocation.dstate WHERE dlocation_id = '$terminal' AND dstate = '$state'");
                                                $row3 = $sql3->fetch_assoc();

                                            ?>
                                <span class="col1 bg-info"></span>
                                <div class="col bg-info text-white">
                                    <h6>In transit</h6>
                                    <P>
                                        Your package is in transit to
                                        <?php echo "{$row3['dstate_name']} state, {$row3['dterminal']} terminal station."?>
                                    </P>
                                    <p><?php echo $date ?></p>
                                </div>

                                <?php break;

                                            case '4': 
                                                $sql2 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id' ");
                                                $row2 = $sql2->fetch_assoc();
                                                $state = $row2['dstate_id'];
                                                $terminal = $row2['dlocation_id'];
                                                $sql4 = $conn->query("SELECT * FROM dlocation JOIN dstate_registration ON dstate_registration.dstate_id = dlocation.dstate WHERE dlocation_id = '$terminal' AND dstate = '$state'");
                                                $row4 = $sql4->fetch_assoc();
                                            ?>
                                <span class="col1 bg-primary"></span>
                                <div class="col bg-primary text-white">
                                    <h6>Was received</h6>
                                    <P>
                                        Your package has been received in
                                        <?php echo "{$row3['dterminal']}, terminal station."?>
                                    </P>
                                    <p><?php echo $date ?></p>
                                </div>

                                <?php break;

                                            case '5': ?>
                                <span class="col1 bg-success"></span>
                                <div class="col bg-success text-white">
                                    <h6>Was picked up</h6>
                                    <P>
                                        Your package has been delivered.
                                    </P>
                                    <p><?php echo $date ?></p>
                                </div>

                                <?php default:
                                                echo '';
                                        }
                                    ?>

                                <?php  } ?>

                            </div>
                        </div>
                    </div>

                    <?php //outputed value when booking ID can't be found in the data-base 

                       } else { ?>

                    <span class="text-danger">
                        No booking matching such number!
                    </span>

                    <?php
                    
                        }
                
                } ?>

                    <?php if(isset($_SESSION['null'])) {  ?>
                    <span class="text-danger"><?php echo $_SESSION['null']?></span>
                    <?php } ?>
                </div>

        </main>
        <?php include '../includes/footer.php'; ?>

    </div>
    <?php include '../includes/scripts.php';
            ob_end_flush(); ?>

</body>

</html>
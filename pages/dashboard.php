<?php 
    ob_start();
    include '../includes/config.php';
    include '../includes/header.php';
    include '../includes/css_files.php'; 
      
    
    $id = $_SESSION['staff_id'];
    $position = $_SESSION['position'];
    $status = $_SESSION['status'];
    
    //echo $status;

    // $staff_id = $_SESSION['staffid'];
    // $staff_position = $_SESSION['staff'];
    //print_r($_SESSION);

    ($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>

            <?php if(isset($id) && $position == 'admin') {
                                     
                                    $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position' ");

                                    $online = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'online' WHERE dstaff_id = '$id' AND (dstaff_status = 'enable' OR dstaff_status = 'offline') ");

                                    if($conn->connect_error) {
                                        die("Connection" . $conn->connect_error);

                                    } elseif($sql->num_rows > 0) {
                                        $row = $sql->fetch_assoc();
                                        // echo '<pre>';
                                        // print_r($row);
                                        // echo '</pre>';
                                    }
                                    
                                ?>

            <?php
                                    // Getting all sales for today
                                    $date = date("Y-m-d");
                                    $sql2 = $conn->query("SELECT * FROM dbooking");
                                    $sql3 = $conn->query("SELECT * FROM dbooking");
                                    $sql4 = $conn->query("SELECT * FROM dbooking");
                                    $sql5 = $conn->query("SELECT * FROM dbooking");
                                    $sql6 = $conn->query("SELECT * FROM dbooking");
                                    $sql7 = $conn->query("SELECT * FROM dbooking");
                                    $sql8 = $conn->query("SELECT * FROM dbooking");
                                    
                                    // Storing all sales and canceled bookings in array
                                    $today_sales = array();
                                    $total_sales = array();
                                    $canceled_book = array();
                                    $shipping = array();
                                    $deliveries = array();
                                    $arrival = array();
                                    $booking = array();
    
                                    // condition to get today sales
                                    while($row2 = $sql2->fetch_assoc()) {
                                        if($row2['dbooking_date'] == $date && $row2['dbooking_status'] != 'cancelled') {
                                            $t_sales = $row2['damount'];
                                            $push = array_push($today_sales, $t_sales);
                                        }
                                    }
    
                                    // condition to get total sales
                                    while($row3 = $sql3->fetch_assoc()) {
                                        if($row3['dbooking_status'] != 'cancelled') {
                                            $tt_sales = $row3['damount'];
                                            $push = array_push($total_sales, $tt_sales);
                                        }
                                    }
    
                                    //condition to get cancelled Bookings 
                                    while($row4 = $sql4->fetch_assoc()) {
                                        if($row4['dbooking_status'] == 'canceled') {
                                            $can_book = $row4['dbooking_status'];
                                            $push = array_push($canceled_book, $can_book);
                                        }
                                    }
    
                                    
                                     // condition to get to total shipped packages 
                                    while($row5 = $sql5->fetch_assoc()) {
                                        if($row5['dbooking_status'] == 'in-transit') {
                                            $ship = $row5['dbooking_status'];
                                            $push = array_push($shipping, $ship);
                                        }
                                    }
    
                                      // condition to get total deliveries
                                    while($row6 = $sql6->fetch_assoc()) {
                                        if($row6['dbooking_status'] == 'delivered') {
                                            $delivery = $row6['dbooking_status'];
                                            $push = array_push($deliveries, $delivery);
                                        }
                                    }

                                     // condition to get total arrivers
                                     while($row7 = $sql7->fetch_assoc()) {
                                        if($row7['dbooking_status'] == 'arrived') {
                                            $arrived = $row7['dbooking_status'];
                                            $push = array_push($arrival, $arrived);
                                        }
                                    }

                                    // condition to get total bookings
                                    while($row8 = $sql8->fetch_assoc()) {
                                        if($row8['dbooking_status'] == 'booked') {
                                            $book = $row8['dbooking_status'];
                                            $push = array_push($booking, $book);
                                        }
                                    }
    
                                    // print_r($sales);
                                    // Summ all sales for today
                                    $today_sum = array_sum($today_sales);
                                    $total_sum = array_sum($total_sales);
                                    $total_can = count($canceled_book);
                                    $total_shippings = count($shipping);
                                    $total_deliveries = count($deliveries);
                                    $arrivers = count($arrival);
                                    $bookings = count($booking);

             ?>



            <div class="flex" style=" display: block;
                                    margin-left: auto;
                                    margin-right: auto;">
                <div class="card mb-4" style="margin: 30px;">
                    <div class="card-body">
                        <div class="container-fluid px-4">
                            <h1 class="mt-4" style="font-size: 30px;">Welcome!</h1>
                            <li class="breadcrumb-item active "
                                style="list-style: none; margin-bottom: 20px; font-size: 18px;">
                                <?php echo $row['dusername'] ?></li>
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-success text-white mb-4">
                                        <div class="card-body">Account</div>
                                        <div class="card-footer">
                                            <h6>Today Income: <?php echo '$' . $today_sum ?></h6>
                                            <h6>Total Income: <?php echo '$' . $total_sum ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-warning text-white mb-4">
                                        <div class="card-body">Shipped Packages</div>
                                        <div class="card-footer">
                                            <h6>Shipped: <?php echo $total_shippings ?></h6>
                                            <h6>Arrivals: <?php echo $arrivers ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary text-white mb-4">
                                        <div class="card-body">Delivered Packages</div>
                                        <div class="card-footer">
                                            <h6>Arrivals: <?php echo $arrivers ?></h6>
                                            <h6>Deliveries: <?php echo $total_deliveries ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-danger text-white mb-4">
                                        <div class="card-body">Bookings</div>
                                        <div class="card-footer">
                                            <h6>Succesfull: <?php echo $bookings ?></h6>
                                            <h6>Unsuccesfull: <?php echo $total_can ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xl-4 col-md-6">
                                    <a href="create_state.php" style="text-decoration: none;">
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body text-center"
                                                style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                Create State
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="create_location.php" style="text-decoration: none;">
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body text-center"
                                                style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                Create Terminal
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-xl-4 col-md-6">
                                    <a href="registration.php" style="text-decoration: none;">
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body text-center"
                                                style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                Register Staff
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if(isset($id) && $position == 'Office-staff' && $status != 'disabled') {
         
                                    $sqlx = $conn->query("SELECT * FROM dstaff_registration JOIN dlocation ON dstaff_registration.dterminal_id = dlocation.dlocation_id WHERE dstaff_id = '$id' AND dposition = '$position' ");

                                    $online = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'online' WHERE dstaff_id = '$id' AND (dstaff_status = 'enable' OR dstaff_status = 'offline') ");

                                    if($conn->connect_error) {
                                        die("Connection" . $conn->connect_error);

                                    } elseif($sqlx->num_rows > 0) {
                                        $row1 = $sqlx->fetch_assoc();
                                        // echo '<pre>';
                                        // print_r($row);
                                        // echo '</pre>';
                                    }
                                ?>


                <div class="flex" style=" display: block;
                                    margin-left: auto;
                                    margin-right: auto; margin-top: 10%;">
                    <div class="card mb-4" style="margin: 30px;">
                        <div class="card-body">
                            <div class="container-fluid px-4">
                                <h1 class="mt-4" style="font-size: 30px;">Welcome!</h1>
                                <li class="breadcrumb-item active "
                                    style="list-style: none; margin-bottom: 20px; font-size: 18px;">
                                    <?php echo 'Staff' ?></li>
                                <div class="row">

                                    <div class="col-xl-4 col-md-6">
                                        <a href="registration.php?id=<?php echo $row1['dstaff_id']?>&position=<?php $row1['dposition'] ?>"
                                            style="text-decoration: none;">
                                            <div class="card bg-primary text-white mb-4">
                                                <div class="card-body text-center"
                                                    style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                    Register Staff</div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <a href="#" style="text-decoration: none;">
                                            <div class="card bg-warning text-white mb-4">
                                                <div class="card-body text-center"
                                                    style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                    View Orders</div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <a href="admin_view_user.php?id=<?php echo isset($_SESSION['staffid']) ? $_SESSION['staffid']: ""?>"
                                            style="text-decoration: none;">
                                            <div class="card bg-success text-white mb-4">
                                                <div class="card-body text-center"
                                                    style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                    View Users</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } elseif(isset($id) && $position == 'Office-staff' && $status == 'disabled') {
                        $_SESSION['suspend'] = "<span class=alert-danger my-10 style=padding:10px> contact admin@quickdelivery.com </span>";
                        // $_SESSION['suspend'] = "contact admin@quickdelivery.com"; 
                        header('Location: login.php');
                    ?> <?php } ?>



                    <?php if(isset($id) && $position == 'Driver' && $status != 'disabled') {
                        
                        $sql1 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position' ");

                        $online = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'online' WHERE dstaff_id = '$id' AND (dstaff_status = 'enable' OR dstaff_status = 'offline') ");

                        if($conn->connect_error) {
                            die("Connection" . $conn->connect_error);

                        } elseif($sql1->num_rows > 0) {
                            $row2 = $sql1->fetch_assoc();
                            // echo '<pre>';
                            // print_r($row);
                            // echo '</pre>';
                        }    
                    
                    ?>

                    <div class="flex" style=" display: block;
                    margin-left: auto;
                    margin-right: auto; margin-top: 10%;">
                        <div class="card mb-4" style="margin: 30px;">
                            <div class="card-body">
                                <div class="container-fluid px-4">
                                    <h1 class="mt-4" style="font-size: 30px;">Welcome!</h1>
                                    <li class="breadcrumb-item active "
                                        style="list-style: none; margin-bottom: 20px; font-size: 18px;">
                                        <?php echo 'Driver'?></li>
                                    <div class="row">

                                        <div class="col-xl-4 col-md-6">
                                            <a href="assigned_package.php" style="text-decoration: none;">
                                                <div class="card bg-primary text-white mb-4">
                                                    <div class="card-body text-center"
                                                        style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                        View Assigned Packages</div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-xl-4 col-md-6">
                                            <a href="profile.php" style="text-decoration: none;">
                                                <div class="card bg-warning text-white mb-4">
                                                    <div class="card-body text-center"
                                                        style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                        View Profile</div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-xl-4 col-md-6">
                                            <a href="update_profile.php?id=<?php echo $id ?>"
                                                style="text-decoration: none;">
                                                <div class="card bg-success text-white mb-4">
                                                    <div class="card-body text-center"
                                                        style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                        Change Location</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } elseif(isset($id) && $position == 'Driver'  &&  $status == 'disabled') {
                        $_SESSION['suspend'] = "<span class=alert-danger style=padding:10px> contact admin@quickdelivery.com </span>";
                        // $_SESSION['suspend'] = "contact admin@quickdelivery.com"; 
                        header("Location:login.php");    
                    

                    } ?>


                        <?php if(isset($id) && $position != 'Driver' && $position != 'Office-staff' && $position != 'admin' && $status != 'disabled' ) { 
                        
                        $sql2 = $conn->query("SELECT * FROM duser_registration WHERE duser_id = '$id' AND dusername = '$position';");

                        $online = $conn->query("UPDATE duser_registration SET duser_status = 'online' WHERE duser_id = '$id' AND (duser_status = 'enable' OR duser_status = 'offline') ");

                        if($conn->connect_error) {
                            die("Connection Error: ".$sql2->connect_error);

                        } elseif($sql2->num_rows > 0) {
                            $row3 = $sql2->fetch_assoc();
                        } else {
                            echo '';
                        } ?>

                        <div class="flex" style=" display: block;
                                    margin-left: auto;
                                    margin-right: auto; margin-top: 10%;">
                            <div class="card mb-4" style="margin: 30px;">
                                <div class="card-body">
                                    <div class="container-fluid px-4">
                                        <h1 class="mt-4" style="font-size: 30px;">Welcome!</h1>
                                        <li class="breadcrumb-item active "
                                            style="list-style: none; margin-bottom: 20px; font-size: 18px;">
                                            <?php echo $row3['dusername'] ?></li>
                                        <div class="row">

                                            <div class="col-xl-4 col-md-6">
                                                <a href="register_package.php?>" style="text-decoration: none;">
                                                    <div class="card bg-primary text-white mb-4">
                                                        <div class="card-body text-center"
                                                            style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                            Register Package</div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-xl-4 col-md-6">
                                                <a href="inbox.php" style="text-decoration: none;">
                                                    <div class="card bg-warning text-white mb-4">
                                                        <div class="card-body text-center"
                                                            style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                            My Inbox</div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-xl-4 col-md-6">
                                                <a href="deliveries.php" style="text-decoration: none;">
                                                    <div class="card bg-success text-white mb-4">
                                                        <div class="card-body text-center"
                                                            style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">
                                                            Deliveries</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php }  elseif(isset($id) && $status == 'disabled') {
                        $_SESSION['suspend'] = "<span class=alert-danger style=padding:10px> contact admin@quickdelivery.com </span>";
                        // $_SESSION['suspend'] = "contact admin@quickdelivery.com"; 
                        header("Location:login.php");
                    }
                    ?>

        </main>
        <?php include '../includes/footer.php';
                unset($_SESSION['update']); 
                unset($_SESSION['null']);?>
    </div>
    <?php include '../includes/scripts.php'; ob_end_flush(); ?>

</body>

</html>
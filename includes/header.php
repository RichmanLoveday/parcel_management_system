<?php
ob_start();
include_once 'config.php';
$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];


//($_SESSION['success'] != true) ? header('Location: login.php') : '';
//(_SESSION['success1'] != true) ? header('Location: login.php') : '';

  
 
?>


<?php 
    if(isset($id) && $position == 'Office-staff') { 
        
          
   $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position'");


   if($conn->connect_error) {
       die("Connection" . $conn->connect_error);
 
   } elseif($sql->num_rows > 0) {
       $row = $sql->fetch_assoc();
       // echo '<pre>';
       // print_r($row);
       // echo '</pre>';
   } else {
       echo '';
   }
        
?>


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="../pages/dashboard.php">Quick Delivery</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="../pages/update_password.php">Change
                        password
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <a class="dropdown-item" href="../pages/logout.php">
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">My Dashboard</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Packages</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        <i class="fas fa-book-open" style="margin-right: 10px;"></i>
                        Bookings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../pages/book_package.php">Book a
                                package</a>
                            <a class="nav-link" href="../pages/view_bookings.php">View Bookings</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pageCollapseError"
                        aria-expanded="false" aria-controls="pagesCollapseError"> <i class="fas fa-table"
                            style="margin-right: 10px;"></i>
                        Orders
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pageCollapseError" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="incoming_package.php">Incoming Package</a>
                            <a class="nav-link" href="pickup.php">Pick-up</a>
                            <a class="nav-link" href="records.php">Records</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">About Me</div>
                    <a class="nav-link" href="../pages/profile.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Profile
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Settings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../pages/update_password.php">Change
                                Password</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: <?php echo $row['dusername'] ?></div>
            </div>
        </nav>
    </div>

    <?php } elseif(isset($id) && $position == 'admin') {
                
                $sqlx = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position'");


                if($conn->connect_error) {
                    die("Connection" . $conn->connect_error);
              
                } elseif($sqlx->num_rows > 0) {
                    $row1 = $sqlx->fetch_assoc();
                    // echo '<pre>';
                    // print_r($row);
                    // echo '</pre>';
                } else {
                    echo '';
                }
                
            ?>


    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../pages/dashboard.php">Quick Delivery</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="../pages/update_password.php">Change
                            password
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="../pages/logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">My Dashboard</div>
                        <a class="nav-link" href="../pages/dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Staffs</div>
                        <a class="nav-link collapsed" href="../pages/registration.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Register Staff
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down">
                                </i>
                            </div>
                        </a>
                        <a class="nav-link collapsed" href="../pages/view_staff.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            Manage Staff
                        </a>

                        <div class="sb-sidenav-menu-heading">Location</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapse"
                            aria-expanded="false" aria-controls="collapse">
                            <i class="fas fa-book-open" style="margin-right: 10px;"></i>
                            Manage Location
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapse" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link collapsed" href="../pages/create_state.php">
                                    <div class="sb-nav-link-icon"></div>
                                    Create State
                                </a>
                                <a class="nav-link collapsed" href="../pages/create_location.php">
                                    <div class="sb-nav-link-icon"></div>
                                    Create Terminal
                                </a>
                                <a class="nav-link collapsed" href="../pages/view_location.php">
                                    <div class="sb-nav-link-icon"></div>
                                    View Terminals
                                </a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">Vehicle</div>
                        <a class="nav-link" href="../pages/vehicle_registration.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Register Vehcile
                        </a>

                        <a class="nav-link" href="../pages/view_vehicles.php">
                            <div class=" sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            View Vehciles
                        </a>

                        <div class="sb-sidenav-menu-heading">Packages</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            <i class="fas fa-book-open" style="margin-right: 10px;"></i>
                            Bookings
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="book_package.php">Book
                                    a package
                                </a>
                                <a class="nav-link" href="view_bookings.php">View Bookings</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pageCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError"> <i class="fas fa-table" style="margin-right: 10px;"></i>
                            Orders
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pageCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../pages/incoming_package.php">Incoming Package</a>
                                <a class="nav-link" href="../pages/pickup.php">Pick-up</a>
                                <a class="nav-link" href="../pages/records.php">Records</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Customers</div>
                        <a class="nav-link" href="../pages/view_users.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-area"></i>
                            </div>
                            View Users
                        </a>
                        <div class="sb-sidenav-menu-heading">About Me</div>
                        <a class="nav-link" href="../pages/profile.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-area"></i>
                            </div>
                            Profile
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Settings
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../pages/update_password.php">Change
                                    Password
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?php echo $row1['dusername']; ?> </div>
                </div>
            </nav>
        </div>

        <?php } elseif(isset($id) && $position == 'Driver') {

                    $sql1 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id' AND dposition = '$position'");


                    if($conn->connect_error) {
                        die("Connection" . $conn->connect_error);
                  
                    } elseif($sql1->num_rows > 0) {
                        $row2 = $sql1->fetch_assoc();
                        // echo '<pre>';
                        // print_r($row);
                        // echo '</pre>';
                    } else {
                        echo '';
                    }    
            ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="staff_dashboard.html">Quick Delivery</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="../pages/update_profile.php?id=<?php echo $id  ?>">
                                Change Location
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="../pages/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">My Dashboard</div>
                            <a class="nav-link" href="../pages/dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Packages</div>
                            <a class="nav-link" href="assigned_package.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Assigned Packages
                            </a>

                            <div class="sb-sidenav-menu-heading">About Me</div>
                            <a class="nav-link" href="../pages/profile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Profile
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Settings
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../pages/update_profile.php?id=<?php echo $id ?>">
                                        Change Location</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../pages/update_password.php">Change
                                        Password</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo $row2['dusername'] ?></div>
                    </div>
                </nav>
            </div>


            <?php } elseif(isset($id) && isset($position)) {
                
                $sql2 = $conn->query("SELECT * FROM duser_registration WHERE duser_id = '$id' AND dusername = '$position';");
                if($conn->connect_error) {

                }  elseif($sql2->num_rows > 0) {
                    $row3 = $sql2 ->fetch_assoc();

                    // echo '<pre>';
                    // print_r($row3);
                    // echo '</pre>';

                } else {
                    echo '';
                } ?>

            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3" href="../pages/dashboard.php">Quick Delivery</a>
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                        class="fas fa-bars"></i></button>
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                            aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                                class="fas fa-search"></i></button>
                    </div>
                </form>
                <!-- Navbar-->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="../pages/update_password.php">Change
                                    password
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="../pages/logout.php">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">My Dashboard</div>
                                <a class="nav-link" href="../pages/dashboard.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i>
                                    </div>
                                    Dashboard
                                </a>

                                <div class="sb-sidenav-menu-heading">Packages</div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                    <i class="fas fa-book-open" style="margin-right: 10px;"></i>
                                    Manage Packages
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">

                                        <a class="nav-link collapsed" href="../pages/register_package.php">
                                            <div class="sb-nav-link-icon"></div>
                                            Register Package
                                        </a>
                                        <a class="nav-link collapsed" href="../pages/inbox.php">
                                            <div class="sb-nav-link-icon">

                                            </div>
                                            Inbox
                                        </a>
                                        <a class="nav-link collapsed" href="../pages/track_package.php">
                                            <div class="sb-nav-link-icon"></div>
                                            Track Package
                                        </a>
                                    </nav>
                                </div>

                                <div class="sb-sidenav-menu-heading">History</div>
                                <a class="nav-link collapsed" href="../pages/deliveries.php">
                                    <i class="fas fa-book-open" style="margin-right: 10px;"></i>
                                    Delivered Packages

                                </a>
                                <div class="sb-sidenav-menu-heading">About Me</div>
                                <a class="nav-link" href="../pages/profile.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Profile
                                </a>

                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapseLayouts" aria-expanded="false"
                                    aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Settings
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="../pages/update_password.php">Change
                                            Password</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as: <?php echo $row3['dusername']; ?> </div>
                        </div>
                    </nav>
                </div>
                <?php } 
                ob_end_flush(); ?>
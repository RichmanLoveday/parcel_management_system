<?php include '../includes/driver_header.php';
      include '../includes/css_files.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard - SB Admin</title>
    </head>
    <body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="flex" style=" display: block;
                    margin-left: auto;
                    margin-right: auto; margin-top: 10%;">
                        <div class="card mb-4" style="margin: 30px;">
                            <div class="card-body">
                                <div class="container-fluid px-4">
                                    <h1 class="mt-4 text-center" style="font-size: 50px;">Welcome</h1>
                                        <li class="breadcrumb-item active text-center" style="list-style: none; margin-bottom: 20px; font-size: 20px;">Username</li>
                                    <div class="row">
                                       
                                        <div class="col-xl-4 col-md-6">
                                            <a href="user_register_package.html" style="text-decoration: none;">
                                                <div class="card bg-primary text-white mb-4">
                                                    <div class="card-body text-center" style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">View Incoming Package</div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-xl-4 col-md-6">
                                            <a href="user_packages.html" style="text-decoration: none;">
                                                <div class="card bg-warning text-white mb-4">
                                                    <div class="card-body text-center" style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">Confirm Delivery</div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-xl-4 col-md-6">
                                            <a href="track_package.html" style="text-decoration: none;">
                                                <div class="card bg-success text-white mb-4">
                                                    <div class="card-body text-center" style="padding: 50px; font-size: 20px;box-shadow: 5px 5px 20px #8888; cursor:pointer;">Change Location</div>
                                                </div>
                                            </a>
                                        </div>
                                        </div>
                                            </div>
                                        </div> 
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    
                </main>
                <?php include '../includes/footer.php' ?>
            </div>
        </div>

        
        <?php include '../includes/scripts.php' ?>
    </body>
</html>

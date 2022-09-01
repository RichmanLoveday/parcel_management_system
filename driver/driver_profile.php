<?php include '../includes/driver_header.php';
      include '../includes/css_files.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Static Navigation - SB Admin</title>
    </head>
    <body>
            <div id="layoutSidenav_content" class="bg-info">
                <main>

                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">My Account</li>
                        </ol>

                        <div class="row">
                            <div class="col-xl-8 ">
                                <div class="card mb-4">
                                    <div class="card-header bg-black text-warning">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Profile Details
                                       </div>
                                       <div> <ul class="list-group">
                                            <li class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                               <span class="badge font-weight-bold p-2 "> Name:</span>
                                               <span class=" badge px-3 text-light"> Null</span>
                                             
                                            </li>
                                            <li class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Username: </span>
                                                <span class=" badge px-3 text-light"> Null</span>
                                              
                                             </li>
                                             <li class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Email:</span>
                                                <span class=" badge px-3 text-light"> Null</span>
                                              
                                             </li>
                                             <li class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Date of Birth:</span>
                                                <span class=" badge px-3 text-light"> Null</span>
                                              
                                             </li>
                                             <li class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold "> Location:</span>
                                                <span class=" badge px-3 text-light"> Null</span>
                                              
                                             </li>

                                             <li class="list-group-item d-flex  bg-primary justify-content-between align-items-center">
                                                <span class="badge font-weight-bold ">Gender</span>
                                                <span class=" badge px-3 text-light"> Null</span>
                                             </li>
                                          </ul>
                                          
                                            <a href="driver_edit.php">
                                                <button class="btn btn-primary mx-3 my-3">Edit Profile</button>
                                            </a> 
                                          
                                            <a href="driver_change_location.php">
                                                <button class="btn btn-primary mx-3 my-3">Change Location</button>
                                            </a>
                                        
                                          
                                    </div>

                                    <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div> -->
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

<?php include '../includes/driver_header.php';
      include '../includes/css_files.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Static Navigation - SB Admin</title>
    </head>
    <body>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Confirm package</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Booking Package</li>
                        </ol>
                        <!-- <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Notification for every package been delivered and asswell for error purposes.
                                </p>
                            </div>
                        </div> -->

                         <div class="container my-lg-5">
                             <form action="">
                                <div class="container form-group" style="width: 65%;">
                                    <label for="">Input Booking Id</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="203873633">
                                        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                             </form>
                         </div>

                        <div class="card">
                            <div class="card-body">
                                    <div class="container">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>

                                                    <th>Booking ID</th>
                                                    <th>Package Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Location</th>
                                                    <th>Destination</th>
                                                    <th>Amount</th>
                                                    <th>Payment</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>

                                                    <th>Booking ID</th>
                                                    <th>Package Name</th>
                                                    <th>Receiver Name</th>
                                                    <th>Receiver Phn</th>
                                                    <th>Weight of Package</th>
                                                    <th>Location</th>
                                                    <th>Amount</th>
                                                    <th>Payment</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                
                                                <tr>
                                                    <td>1</td>
                                                    <td>Laptop</td>
                                                    <td>Edinburgh Richman</td>
                                                    <td>Pickup</td>
                                                    <td>039376353737</td>
                                                    <td>5kg</td>
                                                    <td>Port Harcourt</td>
                                                    <td>Lagos</td>
                                                    <td>$10</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                       <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left: 10px;">Accept</button> 
                                       <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="margin-left: 10px;">Reject</button>
                                        
                                    </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
                </main>


                
                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                        <div class="modal-content">
                    
                            <!-- Modal Header -->
                            <div class="modal-header bg-black text-white">
                            <h4 class="modal-title">Delivered</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body bg-success text-white">
                                <p class="text-center">Booking ID: 12345678</p>
                                <p class="text-center">Package Name: Device</p>
                                <p class="text-center">Receiver Name: John</p>
                                <p class="text-center">Weight of package: 5kg</p>
                                <p class="text-center">Amount: $20</p>

                            </div>
                    
                            <!-- Modal footer -->
                            <div class="modal-footer bg-black">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                    
                        </div>
                        </div>
                    </div>


                <?php include '../includes/footer.php' ?>
            </div>
        </div>
        <?php include '../includes/scripts.php' ?>
    </body>
</html>

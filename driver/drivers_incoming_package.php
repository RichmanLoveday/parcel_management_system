<?php include '../includes/driver_header.php';
      include '../includes/css_files.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard user</title>
    </head>
    <body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="col-md-12">
                            <div class="card mb-4">
                            
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        Incoming Orders
                                    </div>
                                    <div class="card-body">
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
                                                    <th>Status</th>
                                                    <th>Booking Date</th>
                                                    <th>Driver ID</th>
                                                    <th>Action</th>
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
                                                    <th>Delivery</th>
                                                    <th>Booking Date</th>
                                                    <th>Driver ID</th>
                                                    <th>Action</th>
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
                                                    <td>Pending</td>
                                                    <td>Delivered</td>
                                                    <td>2011/04/25</td>
                                                    <td>6763243747437</td>
                                                    <td>
                                                        <button type="button"class="btn btn-primary btn-sm">Accept</button>
                                                    </td>
                                                </tr>
                                                
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
                                                    <td>Pending</td>
                                                    <td>Delivered</td>
                                                    <td>2011/04/25</td>
                                                    <td>6763243747437</td>
                                                    <td>
                                                        <button type="button"class="btn btn-primary btn-sm">Accept</button>
                                                    </td>
                                                </tr>
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
                                                    <td>Pending</td>
                                                    <td>Delivered</td>
                                                    <td>2011/04/25</td>
                                                    <td>6763243747437</td>
                                                    <td>
                                                        <button type="button"class="btn btn-primary btn-sm">Accept</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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

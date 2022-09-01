<?php include '../includes/admin_header.php';
      include '../includes/css_files.php';
      ($_SESSION['success'] != true) ? header('Location: login.php') : '';  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tables - SB Admin</title>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"> My Orders</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Welcome Iyke</li>
                </ol>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">

                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-table me-1"></i>
                                        My Order History
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th>S/N</th>
                                                    <th>Full Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Location</th>
                                                    <th>Gender</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Full Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Location</th>
                                                    <th>Gender</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Richman Loveday</td>
                                                    <td>richy</td>
                                                    <td>lovedayrichman@yahoo.com</td>
                                                    <td>07055553109</td>
                                                    <td>Rivers</td>
                                                    <td>Male</td>
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
    </div>

    </div>
    </div>
    </div>

    </main>
    <?php include '../includes/footer.php' ?>
    </div>
    <?php include '../includes/scripts.php' ?>

</body>

</html>
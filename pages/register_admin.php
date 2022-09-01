<?php 
    ob_start();
    include '../includes/config.php';
    include '../includes/css_files.php'; 


    if(isset($_POST['register'])) {
        include '../process/register_admin.php';
    }
    //print_r($_SESSION) ;
    //($_SESSION['success'] != true) ? header('Location: login.php') : ''; 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed bg-secondary">
    <div id="layoutSidenav_content">
        <main>
            <div class="container px-4" style="margin-bottom: 60px;">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <h1 class="mt-4" style="padding: 25px">Register Admin </h1>
                            <!-- <div class="card mb-4">
                                <div class="card-body">
                                    <p class="mb-0">
                                        Notification for every package been delivered and asswell for error purposes.
                                    </p>
                                </div>
                            </div> -->

                            <div class="card">
                                <?php echo isset($_SESSION['admin']) ? $_SESSION['admin'] : ' ' ?>
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Please fill in all input correctly.
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <form action="register_admin.php" method="post">
                                            <span
                                                class="alert-success my-10"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?></span>
                                            <div class="row mb-3">

                                                <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                                    <label for="">Email</label>
                                                    <input type="text" name="email" class="form-control"
                                                        value="<?php echo isset($email) ? $email : '' ?>">
                                                    <span class="text-danger">
                                                        <?php echo isset($errEmail) ? $errEmail : '' ?></span>
                                                </div>

                                                <div class="container form-group col-md-6" style="margin-bottom: 10px;">
                                                    <label for="">Role</label>
                                                    <select name="position" id="" class="form-control form-select">
                                                        <option value="">
                                                            ---choose role---
                                                        </option>
                                                        <option value="admin">admin</option>
                                                    </select>
                                                    <span class="text-danger">
                                                        <?php echo isset($errPos) ? $errPos : '' ?></span>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            value="<?php echo isset($password) ? $password : '' ?>">
                                                        <span class="text-danger">
                                                            <?php echo isset($errPass) ? $errPass : '' ?></span>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">Confirm password</label>
                                                        <input type="password" name="conpass" class="form-control"
                                                            value="<?php echo isset($conpass) ? $conpass : ''  ?>">
                                                        <span class="text-danger">
                                                            <?php echo isset($errCon) ? $errCon : '' ?></span>
                                                    </div>

                                                </div>

                                            </div>
                                            <button class="btn btn-primary" name="register" data-bs-toggle="moal"
                                                data-bs-target="#myMoal" style="margin-left: 10px;">Submit</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include '../includes/footer.php'; 
                     ob_end_flush();
                     //unset($_SESSION['message'])?>
    </div>
    <?php include '../includes/scripts.php'; 
    ?>

</body>

</html>
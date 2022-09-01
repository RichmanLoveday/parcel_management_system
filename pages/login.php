<?php 
    include '../process/login_process.php'; 
    include '../includes/css_files.php';

    (isset($_SESSION['success']) == true) ? header('Location: dashboard.php') : ''; 
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
</head>

<body class="bg-black">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">

                                    <?php echo isset($_SESSION['suspend']) ? $_SESSION['suspend'] : '' ;
                                              echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ;
                                              echo isset($_SESSION['wrong_input']) ? $_SESSION['wrong_input'] : ''; ?>

                                    <form method="post" action="../process/login_process.php">
                                        <div class="form-floating mb-3" style="margin-top: 20px;">
                                            <input class="form-control" id="inputEmail" type="text"
                                                placeholder="name@example.com" name="user" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <span class="text-danger"><?php echo isset($userErr) ? $userErr : ''; ?></span>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="pass" type="password"
                                                placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <span class="text-danger"><?php echo isset($passErr) ? $passErr : ''; ?></span>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember
                                                Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <!-- <a class="btn btn-primary" type='login'>Login</a> -->
                                            <button class="btn btn-primary" name="submit" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="user_registration.php">Need an account? Sign
                                            up!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php include '../includes/footer.php' ?>
        </div>
    </div>
    <?php include '../includes/scripts.php';
                unset($_SESSION['wrong_input']);
                unset($_SESSION['suspend']); 
                unset($_SESSION['message']);
                ?>
</body>

</html>
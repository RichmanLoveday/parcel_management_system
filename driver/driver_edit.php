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
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7">
                                <div class="card rounded-lg mt-5">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Edit Profile
                                    </div>
                                    <div class="card-body">
                                        <form action="">
                                            
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">First Name</label>
                                                <input type="text" class="form-control">
                                            </div>
        
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Last Name</label>
                                                <input type="text" class="form-control">
                                            </div>

                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Username</label>
                                                <input type="text" class="form-control">
                                            </div>
        
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control">
                                            </div>
        
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Gender</label> <br>
                                                <input type="radio" id="male" name="gender" value="MALE">
                                                <label for="male">Male</label>
                                                <input type="radio" id="css" name="gender" value="FEMALE">
                                                <label for="female">Female</label><br>
                                                
                                            </div>
        
        
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Date of birth</label>
                                                <input type="date" class="form-control">
        
                                            </div>

                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Postion</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Location</label>
                                                <select name="" id="" class="form-control form-select">
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                </select>
                                            </div>
                                            
                                            <div class="container form-group" style="margin-bottom: 10px;">
                                                <label for="">Address</label>
                                                <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                            </div>

                                        
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="">Password</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputLastName">New password</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            <div class="col-md-6">
                                                <label for="inputLastName">Confirm password</label>
                                                <input type="text" class="form-control">
                                            </div>

                                           </div>

                                            <div class="btn btn-primary mx-4">Submit</div>
                                        </form>
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

<?php
ob_start();
include_once '../includes/config.php';
$error = false;
$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo '<pre>';
    // print_r($_POST);
    // echo '<pre>';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $position = $_POST['position'];
    $state = $_POST['state'];
    $terminal = $_POST['terminal'];
    $ads = $_POST['ads'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $conpass = $_POST['conpass'];

    if(!empty($email)) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errEmail = 'Pls Fill in a valid Email';
        } else {
            $email = clean($_POST['email']);

            // checking if email aready exist in data base
            $sql = $conn->query("SELECT * FROM dstaff_registration WHERE demail = '$email' ");
            $sql1 = $conn->query("SELECT * FROM duser_registration WHERE demail = '$email' ");
            if($conn->connect_error) {
                die('Connection Error: '.$conn->connect_error);
                $error = true;
            } elseif($sql -> num_rows > 0 || $sql1 -> num_rows > 0) {
                $errEmail = $email . ' ' .'already exist';
                $error = true;

            } else {
                echo '';
            }
    
        }
    } else {
        $errEmail = 'Pls fill in this field';
        $error = true;
    }


    if(empty($fname)) {
        $errFname = 'Pls fill in this field';
        $error = true;
    } elseif(is_numeric($fname)) {
        $errFname = 'Pls input alphabelt';
        $error = true;
    }
     else {
        $fname = clean(ucfirst($_POST['fname']));
    }


    if(empty($lname)) {
        $errLname = 'Pls fill in this field';
        $error = true;
    } elseif(is_numeric($lname)) {
        $errLname = 'Pls input alphabelt';
        $error = true;
    }
     else {
        $lname = clean(ucfirst($_POST['lname']));
    }


    if(empty($birth)) {
        $errBirth = 'Pls fill in this field';
        $error = true;
    }
     else {
        $birth = clean(($_POST['birth']));
    }


    if(empty($state)) {
        $errState = 'Pls fill in this field';
        $error = true;
    }
     else {
        $state = clean(($_POST['state']));
    }

    if(empty($terminal)) {
        $errTerm = 'Pls fill in this field';
        $error = true;
    }
     else {
        $terminal = clean(($_POST['terminal']));
    }


    if(empty($position)) {
        $errPosition = 'Pls fill in this field';
        $error = true;
    }
     else {
        $position = clean($_POST['position']);
    }


    if(empty($ads)) {
        $errAds = 'Pls fill in this field';
        $error = true;
    }
     else {                 
        $ads = clean($_POST['ads']);
    }
    

    if(empty($password)) {
        $errPass = 'Pls fill in this field';
        $error = true;
    }
     else {
        $password = clean($_POST['password']);
    }


    if(empty($conpass)) {
        $errCon= 'Pls fill in this field';
        $error = true;
    } elseif($conpass != $password) {
        $errCon = 'Password does not match';
        $error = true;
    }
     else {
        $conpass = clean($_POST['conpass']);
    }


    if($error == false) {

        $staff_id = date('Ymdhis');
        $password = md5($password);

        if($position == 'Office-staff') {

            $sql = $conn->query("INSERT INTO dstaff_registration SET dstaff_id = '$staff_id', dpassword = '$password', dfname = '$fname',  dlname = '$lname', dstaff_state = '$state', dterminal_id = '$terminal', dposition = '$position', dstaff_status = 'offline', dads = '$ads', ddob = '$birth', demail = '$email', dgender = '$gender', dusername = '$position'");

            if($conn -> connect_error) {
                die("Connection Error: ".$conn->connect_error);
            } elseif($sql == TRUE) {
    
                $_SESSION['message'] = "<span class=alert-success my-10 style=padding: 20px;>Staff Registered Successfully </span>";
                header("Location: ../pages/view_staff.php?id=$id&position=$position");
            } else {
                $_SESSION['message'] = "<span class=alert-success my-10 style=padding: 20px;>Staff Not Registered Successfully </span>";
                header("Location: ../pages/view_staff.php?id=$id&position=$position");
            } 


        } else {
            $sql = $conn->query("INSERT INTO dstaff_registration SET dstaff_id = '$staff_id', dpassword = '$password', dfname = '$fname',  dlname = '$lname', dstaff_state = '$state', dterminal_id = '$terminal', dposition = '$position', dstaff_status = 'offline', dads = '$ads', ddob = '$birth', demail = '$email', dgender = '$gender', dusername = '$position'");
            

            $sql1 = $conn->query("INSERT INTO drivers SET driver_id = '$staff_id', vehicle_id = 'not-assigned'");

            if($conn -> connect_error) {
                die("Connection Error: ".$conn->connect_error);
            } elseif($sql == TRUE && $sql1 == TRUE) {
    
                $_SESSION['message'] = "<span class=alert-success my-10 style=padding: 20px;>Staff Registered Successfully </span>";
                header("Location: ../pages/view_staff.php?id=$id&position=$position");
            } else {
                $_SESSION['message'] = "<span class=alert-success my-10 style=padding: 20px;>Staff Not Registered Successfully </span>";
                header("Location: ../pages/view_staff.php?id=$id&position=$position");
            } 


        }

        

        
    }
}
ob_end_flush();

?>
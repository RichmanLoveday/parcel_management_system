<?php

include_once '../includes/config.php';
$error = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];
    $phone = $_POST['phone'];

    if(empty($fname)) {
        $errFname = "Fill in this field";
        $error = true;
    } else {
        $fname = clean(ucfirst($_POST['fname']));
    }

    if(empty($lname)) {
        $errLname = "Fill in this field";
        $error = true;
    } else {
        $lname = clean(ucfirst($_POST['lname']));
    }

    if(empty($phone)) {
        $errPhn = "Fill in this field";
       $error = true;

    } elseif(!is_numeric($phone)) {
        $errPhn = "Pls enter numbers";
        $error = true;
        
    } else {
        $phone = clean(ucfirst($_POST['phone']));
    }

    if(empty($uname)) {
        $errUname = "Fill in this field";
        $error = true;
    } else {
        $uname = clean($_POST['username']);

        // Query database to check for similar username
        $sql = $conn->query("SELECT * FROM duser_registration");
        if($conn->connect_error) {
            die('Connection Error' .$conn->connect_error);

        } elseif($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();

            if($row['dusername'] == $uname) {
                $errUname = $uname . ' ' .  'already taken';
                $error = true;
            } else {
                $uname = clean(ucfirst($_POST['username']));
            }
        }
    }

    if(empty($password)) {
        $errPass = "Fill in this field";
        $error = true;
    } else {
        $password = clean(ucfirst($_POST['password']));
    }

    if(empty($conpass)) {
        $errCon = "Fill in this field";
        $error = true;
    } elseif($conpass != $password) {
        $errCon = 'Passord does not match';
        $error = true;
    } else {
        $conpasss = clean(ucfirst($_POST['conpass']));
    }


    // Validating email
    if (!empty($email)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errEmail = 'Please Fill in a valid email';
            // $errorStyle = 'alert';
            $error = true;

        } else {
            //echo 'Pass';
            $email = clean($_POST['email']);

            // Checking if email exist in the data base
            $sql = $conn->query("SELECT * FROM duser_registration WHERE demail='$email'");
            $sql2 = $conn->query("SELECT * FROM dstaff_registration WHERE demail='$email'");

            if($sql->num_rows > 0 || $sql2->num_rows > 0) {
                $errEmail = $email .' '. 'Email is already taken!';
                $error = true;
            }
        }
    } else {
        $errEmail = 'Please Fill in this field';
        // $errorStyle = 'alert';
        $error = true;
    }

    if($error == false) {

        // User unique identification
        $user_id = date('Ymdhis');
        $password = md5($password);
        $sqlx = $conn->query("INSERT INTO duser_registration SET duser_id = '$user_id', dfname = '$fname', dlname = '$lname', dusername = '$uname', dgender = '$gender', demail = '$email', dpassword = '$password', dphn = '$phone', duser_status = 'offline'; ");

        if($sqlx) {
            $_SESSION['message'] = "<span class=alert-success my-10 style=padding:10px> Registered Successfully </span>";
            header("Location: ../pages/login.php");

        } else {
            $_SESSION['message'] = 'Unable to register';
            header("Location: ../pages/user_registration.php");
        }
    }

}


?>
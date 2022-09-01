<?php

include_once '../includes/config.php';
$error = false;



if($_SERVER['REQUEST_METHOD'] ==  'POST') {

    //print_r($_POST);
    $position = $_POST['position'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $conpass = $_POST['conpass'];
    unset($_SESSION['admin']);

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

    if(empty($password)) {
        $errPass = 'Pls fill in this field';
        $error = true;
    } else {
        $password = clean($_POST['password']);
    }

    if(empty($email)) {
        $errEmail = 'Pls fill in this field';
        $error = true;
    } else {
        $email = clean($_POST['email']);
    }
    

    if(empty($position)) {
        $errPos = 'Pls fill in this field';
        $error = true;
    } else {
        $position = clean($_POST['position']);
    }
    
    
    
    if($error == false) {
        $staff_id = date('Ymdhis');
        $password = md5($password);
        
        $sql = $conn->query("INSERT INTO dstaff_registration SET dstaff_id = '$staff_id', dpassword = '$password', dposition = '$position', dstaff_status = 'offline', demail = '$email', dusername = '$position'");
        
        if($conn -> connect_error) {
            die("Connection Error: ".$conn->connect_error);
        } elseif($sql) {
        
            $_SESSION['admin'] = "<span class=alert-success my-10 style=padding:10px>Admin Registered Successfully </span>";
            header("Location: ../pages/register_admin.php");
        } else {
            $_SESSION['admin'] = "<span class=alert-success my-10 style=padding:10px;>Staff Not Registered Successfully </span>";
            header("Location: ../pages/register_admin.php");
        } 
        
    }
    
}



?>
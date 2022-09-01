<?php

include_once '../includes/config.php';

$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];


$error = false;
$rightPass = $rightConpass = $rightNewpass = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Checking if post request is working
    // echo 'Working';

    // print_r($_POST);
    


    $old_password = md5($_POST['oldpass']);
    $new_password = $_POST['newpass'];
    $confirm_password = $_POST['confirm'];


    if($position == 'admin') {
        $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dposition = '$position' AND dstaff_id = '$id' ");
        if($conn->connect_error) {
            die('Connection Error: '.$conn->connect_error);
    
    
        } elseif($sql->num_rows > 0) {
            $rows = $sql->fetch_assoc();
    
            // echo '<pre>';
            // print_r($rows);
            // echo '</pre>';
            
            // Checking if password is same in database
           
            if($rows['dpassword'] != $old_password) {
                $errPass = 'Incorrect password';
                $error = true;
                //echo $errPass;
            } else { 
                $rightPass = clean($old_password);
            }
            
        } else {
            echo 'Not connected';
        }

        
        
    } elseif($position == 'Office-staff') {

        $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dposition = '$position' AND dstaff_id = '$id' ");
        if($conn->connect_error) {
            die('Connection Error: '.$conn->connect_error);
    
    
        } elseif($sql->num_rows > 0) {
            $rows = $sql->fetch_assoc();
    
            // echo '<pre>';
            // print_r($rows);
            // echo '</pre>';
            
            // Checking if password is same in database
           
            if($rows['dpassword'] != $old_password) {
                $errPass = 'Incorrect password';
                $error = true;
                //echo $errPass;
            } else { 
                $rightPass = clean($old_password);
            }
            
        } else {
            echo 'Not connected';
        }
        
    } elseif($position == 'Driver') {

        $sql = $conn->query("SELECT * FROM dstaff_registration WHERE dposition = '$position' AND dstaff_id = '$id' ");
        if($conn->connect_error) {
            die('Connection Error: '.$conn->connect_error);
    
    
        } elseif($sql->num_rows > 0) {
            $rows = $sql->fetch_assoc();
    
            // echo '<pre>';
            // print_r($rows);
            // echo '</pre>';
            
            // Checking if password is same in database
           
            if($rows['dpassword'] != $old_password) {
                $errPass = 'Incorrect password';
                $error = true;
                //echo $errPass;
            } else { 
                $rightPass = clean($old_password);
            }
            
        } else {
            echo 'Not connected';
        }
        
    } else {

        $sql = $conn->query("SELECT * FROM duser_registration WHERE duser_id = '$id' ");
        if($conn->connect_error) {
            die('Connection Error: '.$conn->connect_error);
    
    
        } elseif($sql->num_rows > 0) {
            $rows = $sql->fetch_assoc();
    
            // echo '<pre>';
            // print_r($rows);
            // echo '</pre>';
            
            // Checking if password is same in database
           
            if($rows['dpassword'] != $old_password) {
                $errPass = 'Incorrect password';
                $error = true;
                //echo $errPass;
            } else { 
                $rightPass = clean($old_password);
            }
            
        } else {
            echo 'Not connected';
        }
        
    }
    
    
    // Validating new password
    if(empty($old_password)) {
        $errPass = 'Pls fill in this field';
        $error = true;
    } 

    if(empty($new_password)) {
        $errNewpass = 'Pls fill in this field';
        $error = true;

    } else {
        $rightNewpass = clean($new_password);
    }

    if(empty($confirm_password)) {
        $errConpass = 'Pls fill in this field';
        $error = true;

    } elseif($confirm_password != $new_password) {
        $errConpass = 'Password does not match';
        $error = true;
    }
    else {
        $rightConpass = clean($confirm_password);
    }

    
    // Updating the passowrd in the database
    if($error == false) {

        if($position == 'admin') {
            $password = md5($rightNewpass);     // helps to protect the password
            $sql = $conn->query("UPDATE dstaff_registration SET dpassword = '$password' WHERE dposition = '$position' AND dstaff_id = '$id'");

            if($conn->connect_error) {
                die('Connection Error: '.$conn->connect_error);

            } elseif($sql) {
                $_SESSION['update'] = 'Password Updated Successfully';
                header("Location:../pages/profile.php ");
            } else {
                $_SESSION['update'] = 'Password Not Updated';
                header("Location:update_password.php ");
            }
        
        } elseif($position == 'Office-staff') {
            $password = md5($rightNewpass);     // helps to protect the password
            $sql = $conn->query("UPDATE dstaff_registration SET dpassword = '$password' WHERE dposition = '$position' AND dstaff_id = '$id'");
    
            if($conn->connect_error) {
                die('Connection Error: '.$conn->connect_error);
    
            } elseif($sql) {
                $_SESSION['update'] = 'Password Updated Successfully';
                header("Location:../pages/profile.php ");
            } else {
                $_SESSION['update'] = 'Password Not Updated';
                header("Location:update_password.php ");
            }
            
        } elseif($position == 'Driver') {
            $password = md5($rightNewpass);     // helps to protect the password
            $sql = $conn->query("UPDATE dstaff_registration SET dpassword = '$password' WHERE dposition = '$position' AND dstaff_id = '$id'");
    
            if($conn->connect_error) {
                die('Connection Error: '.$conn->connect_error);
    
            } elseif($sql) {
                $_SESSION['update'] = 'Password Updated Successfully';
                header("Location:../pages/profile.php?id=$id ");
            } else {
                $_SESSION['update'] = 'Password Not Updated';
                header("Location:update_password.php?id=$id ");
            }
            
        } else {
            $password = md5($rightNewpass);     // helps to protect the password
            $sql = $conn->query("UPDATE duser_registration SET dpassword = '$password' WHERE duser_id = '$id'");
    
            if($conn->connect_error) {
                die('Connection Error: '.$conn->connect_error);
    
            } elseif($sql) {
                $_SESSION['update'] = "<span class=alert-success my-10 style=padding:10px> Password Updated Successfully </span>";
                header("Location:../pages/profile.php");
            } else {
                $_SESSION['update'] = "<span class=alert-success my-10 style=padding:10px> Password not updated </span>";
                header("Location:update_password.php");
            }
        }
        

    }

}


?>
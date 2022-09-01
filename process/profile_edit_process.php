<?php

include_once '../includes/config.php';
$error = false;
$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];


// Get post requst from admin_edit.php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
   

        // display message if post method is set
        // echo 'Update Is set';

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        // store all post request in a variable
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['ads'];
        $birth = $_POST['birth'];
        $state = $_POST['state'];
        $terminal = $_POST['terminal'];
        $gender = $_POST['gender'];

        print_r($_POST);
        

        // run validation for every input

        if(is_numeric($_POST['fname'])) {
            $fnameError = 'Pls input alphabelts';
            $error = true;
        } else {
            $fname = clean($_POST['fname']);
        }

        if(is_numeric($_POST['lname'])) {
            $lnameError = 'Pls input alphabelts';
            $error = true;
        } else {
            $lname = clean($_POST['lname']);
        }





        // connect to mysql database and update to admin row
        if($error == false) {
            // $admin_id = date('Ymdhis');

            // Update all inputed values into the data-base
            $sql = $conn->query("UPDATE dstaff_registration SET dfname = '$fname', dlname = '$lname', dgender = '$gender', dads = '$address', ddob = '$birth', dterminal_id = '$terminal', dstaff_state = '$state' WHERE dposition = '$position'; ");

            $sql1 = $conn->query("UPDATE duser_registration SET dfname = '$fname', dlname = '$lname', dgender = '$gender', daddress = '$address', ddob = '$birth', dstate = '$state' WHERE dusername = '$position'; ");
       
            //c Check if database is connected and out put the messages
            if($conn -> connect_error) {
                echo 'Connection Error: '.$conn->conn_error;
            } elseif($sql) {
               $_SESSION['edit_profile'] = "<span class=alert-success my-10 style=padding:10px> Profile Updated Successfull </span>";
               header("Location:../pages/profile.php");
            } elseif($sql1) {
                $_SESSION['edit_profile'] = "<span class=alert-success my-10 style=padding:10px> Profile Updated Successfull </span>";
               header("Location:../pages/profile.php");
            } else {
                $_SESSION['edit_profile'] = "<span class=alert-success my-10 style=padding:10px> Profile not updated </span>";
                header("Location:../pages/profile.php");
            }
        }        
}


?>
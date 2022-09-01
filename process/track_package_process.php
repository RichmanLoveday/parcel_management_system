<?php

include_once '../includes/config.php';
$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    //print_r($_POST);
    $booking_id = $_POST['booking_id'];

    if(empty($booking_id)) { // checking if search input is empty
        $errId = 'Please input a package ID';
        $error = true;

        // When empty unset all the session variables below
        //unset($_SESSION['output']);
        unset($_SESSION['null']);
    } else {
        
        // store the value of the the package and unset all session variables below
        $package_id = $_POST['package_id'];     
        unset($_SESSION['null']);
        unset($_SESSION['booked']);
    }

    
    if($error == false) {
        // query for a specific package ID that is pending
        $sql = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$booking_id'");
        $row = $sql->fetch_assoc();
        if($conn->connect_error) {
            die("Connection Error: ".$conn->connect_error);
        } elseif($sql->num_rows > 0) {

            // session variable to declared to display details about a specific package
            //$_SESSION['output'] = ' ';
            // unseting a previous session variable
            unset($_SESSION['null']);
            header("Location: ../pages/track_package.php?id=$booking_id");
            
        } elseif($row['dbooking_id'] != $booking_id) {
            $_SESSION['null'] = 'No booking matching such number!';
            // unsetting previous package displayed if the sql condition is not meet.
            unset($_SESSION['output']);
            header("Location: ../pages/track_package.php");
        }
    }
    

}


?>
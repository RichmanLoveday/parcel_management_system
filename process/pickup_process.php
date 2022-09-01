<?php
include_once '../includes/config.php';

//print_r($_POST);

$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];
    $state = $_SESSION['state'];
    $terminal = $_SESSION['terminal'];
    
    //print_r($_POST);
    $pickup_id = $_POST['pickup_id'];

    if(empty($pickup_id)) { // checking if search input is empty
        $errId = 'Please input a pickup ID';
        $error = true;

        // when empty unset all the session variables below
        unset($_SESSION['output']);
        unset($_SESSION['null']);
        unset($_SESSION['delivered']);
    } else {
        
        // store the value of the the package and unset all session variables below
        $booking_id = $_POST['pickup_id'];     
        unset($_SESSION['null3']);
        unset($_SESSION['delivered']);
    }

    
    if($error == false) {
        // query for a specific pickup ID that is arrived and joining with dbooking
        $sql = $conn->query("SELECT * FROM arrived_package JOIN dbooking ON dbooking.dbooking_id = arrived_package.booking WHERE pickup_id = '$pickup_id' AND delivery_status = '1' AND dbooking_status = 'arrived'");
        $row = $sql->fetch_assoc();
        if($conn->connect_error) {
            die("Connection Error: ".$conn->connect_error);
        } elseif($sql->num_rows > 0) {

            // getting the package ID to query package table.
            $package_id = $row['dpackage'];
            $sql1 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
            $row1 = $sql1->fetch_assoc();
            $delivery_state = $row1['dstate_id'];
            $delivery_terminal = $row1['dlocation_id'];
            
            // condition to check if the place of pickup is same with the staff location
            if($delivery_state == $state && $delivery_terminal == $terminal) {
                
                // session variable to declared to display details about a specific package
                $_SESSION['output'] = ' ';
                
                // unseting a previous session variable
                unset($_SESSION['null3']);
                header("Location: ../pages/pickup.php?id=$pickup_id");
                
            } elseif($position == 'admin') {    
                // session variable to declared to display details about a specific package
                $_SESSION['output'] = ' ';
                
                // unseting a previous session variable
                unset($_SESSION['null3']);
                header("Location: ../pages/pickup.php?id=$pickup_id");
                
            } else {
                // $sql3 = $conn->query("SELECT * FROM dlocation WHERE dlocation_id = '$delivery_terminal'");
                // $sql4 = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = '$delivery_state'");
                // $row3 = $sql3->fetch_assoc();
                // $row4 = $sql4->fetch_assoc();

                // $state_name = $row4['dstate_name'];
                // $terminal_name = $row3['dterminal'];

                $_SESSION['null3'] = "No Package Found!";
                unset($_SESSION['output']);
                header("Location: ../pages/pickup.php?id=$pickup_id");
            }

            
        } else {
            $_SESSION['null3'] = 'No Package found!';
            // unsetting previous package displayed if the sql condition is not meet.
            unset($_SESSION['output']);
            unset($_SESSION['delivered']);
            header("Location: ../pages/pickup.php");
        }
    }

}


?>
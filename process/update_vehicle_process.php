<?php

include '../includes/config.php';




$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Vehicle Id and Driver Id
    $driver_id = $_POST['driver_id'];
    $vehicle_id = $_POST['vehicle_id'];


    $vehicle_dest = $_POST['vehicle_destination'];
    $driver_state = $_POST['driver_state'];
    $chg_driver = $_POST['driver'];


    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    


    /* Change driver for a particular vehicle */
    $sql = ' ';
    // This code updates the vehicle ID to not-assigned or assignes a vehicle ID to a driver
    if($chg_driver == 'not-assigned') { 
        $sql = $conn->query("UPDATE drivers SET vehicle_id = 'not-assigned' WHERE vehicle_id = '$vehicle_id'");
    } else {
        $sql = $conn->query("UPDATE drivers SET vehicle_id = '$vehicle_id' WHERE driver_id = '$chg_driver' ");
    }
    

    // This code updates a driver ID to not assigned or assignes a driver ID to a vehicle
    $sql1 = $conn->query("UPDATE dvehicle_registration SET ddriver_id = '$chg_driver' WHERE dvehicle_id = '$vehicle_id' AND dvehicle_status = 'active'");

    // This code select and fetches the driver ID when updated
    $sql2 = $conn->query("SELECT * FROM dvehicle_registration WHERE dvehicle_id = '$vehicle_id'");
    $row = $sql2->fetch_assoc();

    $driver_id1 = $row['ddriver_id'];
    print_r($driver_id1);

    // This code compares the selected driver to fetched driver ID and compares the driver ID in drivers table to driver ID in vehicle table
    // and updates the drivers table to the current driver
    if($chg_driver == $driver_id1 AND $driver_id != $driver_id1) {
        $sql3 = $conn->query("UPDATE drivers SET vehicle_id = 'not-assigned' WHERE driver_id = '$driver_id'");
    }
    

    // Changing driver current location
    $sql4 = $conn->query("UPDATE dstaff_registration SET dstaff_state = '$driver_state' WHERE dstaff_id = '$driver_id'");


    // Change vehicle destination
    $sql5 = $conn->query("UPDATE dvehicle_registration SET dvehicle_dest = '$vehicle_dest' WHERE dvehicle_id = '$vehicle_id' AND dvehicle_status = 'active'");



    // $sql6 = $conn->query("SELECT * FROM dvehicle_registration JOIN dstate_registration WHERE dvehicle_id = '$vehicle_id' ");
    // $row2 = $sql1->fetch_assoc();


    if(($sql2 || $slq3 || $sql4 || $sql5) && $error == false) {
        $output = $row2['dvname'] . ','.$row2['dvehicle_type']. ' '. 'updated successfully';
        $_SESSION['output'] = $output;
        header("Location:../pages/view_vehicles.php");

    } else {
        $_SESSION['output'] = 'Unable to update'. ' '.$row['dvname'] . ','.$row['dvehicle_type'];
        header("Location:../pages/view_vehicles.php");
    }


}


?>
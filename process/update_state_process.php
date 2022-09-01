<?php
include '../includes/config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    print_r($_POST);

    $state = $_POST['state'];
    $id = $_POST['id'];

    
    $sql = $conn->query("UPDATE dstaff_registration SET dstaff_state = '$state' WHERE dstaff_id = '$id' ");
    

    $sql1 = $conn->query("SELECT * FROM drivers WHERE driver_id = '$id'");
    $row1 = $sql1->fetch_assoc();
    $vehicle_id = $row1['vehicle_id'];

    // $sql2 = $conn->query("UPDATE driver_inbox SET inbox_status = '2' WHERE vehicle_id = '$vehicle_id' AND inbox_status = '1'");
   
    
    // Getting the state destination 
    $sql3 = $conn->query("SELECT * FROM dvehicle_registration
    JOIN dstate_registration ON dstate_registration.dstate_id = dvehicle_registration.dvehicle_dest WHERE dvehicle_id = '$vehicle_id'");
    $row3 = $sql3->fetch_assoc();
    $state_name = $row3['dstate_name'];

    if($state == 'in-transit') {
        // Gettig  the vehicle id
        $_SESSION['message'] = "<span class=alert-success my-10 style=padding:10px> You are in transit to deliver packages in {$state_name} </span>";
       header("Location: ../pages/profile.php");

    } elseif($state != 'in-transit') {
        $_SESSION['message'] = "<span class=alert-success my-10 style=padding:10px> Your current state has been updated successfully </span>";
        header("Location: ../pages/profile.php");
    } else {
        $_SESSION['message'] = "<span class=alert-success my-10 style=padding:10px> Unable to update state </span>";
        header("Location: ../pages/profile.php");
    }

}


?>
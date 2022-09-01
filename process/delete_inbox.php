<?php
include '../includes/config.php';

$id = $_SESSION['staff_id'];
$position = $_SESSION['position'];

if(isset($id) && $position == 'admin') {

    $booking_id = $_GET['id'];
    //print_r($_GET);
    
    $sql = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$booking_id'");
    $row = $sql->fetch_assoc();
    $package_id = $row['dpackage'];
    //print_r($package_id);
    $sql2 = $conn->query("DELETE FROM dinbox WHERE dpackage_id = '$package_id'");
    $sql9 = $conn->query("DELETE FROM arrived_package WHERE booking = '$booking_id' ");


    if($sql9 && $sql2) {
        header("Location: ../pages/records.php");
    } else {
        echo 'Unable to connect to Sql';
    }
        

} elseif(isset($id) && $position == 'Driver') {
    $booking_id = $_GET['id'];
    $sql1 = $conn->query("DELETE FROM driver_inbox WHERE booking_id = '$booking_id' ");

    if($sql1 == true) {
        header("Location: ../pages/assigned_package.php");
    } else {
        echo 'Unable to connect to Sql';
    }

} elseif(isset($id) && $position != 'Driver') {
        $package_id = $_GET['id'];
        $status = $_GET['status'];
        print_r($_GET);
        $sql = $conn->query("DELETE FROM dinbox WHERE duser_id = '$id' AND dpackage_id = '$package_id' AND dinbox_status = '$status'");

        $sql = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
        $row = $sql->fetch_assoc();
        header("Location: ../pages/inbox.php");
    
        // if($row['dpackage_status'] == 'pending') {
        //     $sql1 = $conn->query("UPDATE dpackage_registration SET dpackage_status = 'canceled' WHERE dpackage_id = '$package_id' ");
        //     header("Location: ../pages/inbox.php");
        // } else {
        //     header("Location: ../pages/inbox.php");
        // }
} else {
    echo '';
}

?>
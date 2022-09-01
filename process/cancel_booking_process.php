<?php
include '../includes/config.php';
$position = $_SESSION['position'];

if($position == 'admin' || $position == 'Office-staff') {
    $id = $_GET['id'];

    $sql = $conn->query("UPDATE dbooking SET dbooking_status = 'canceled' WHERE dbooking_id = '$id'");
    $sql1 = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$id'");
    $row1 = $sql1->fetch_assoc();
    $package_id = $row1['dpackage'];
    $vehicle_id = $row1['dvehicle_id'];

    $sql2 = $conn->query("UPDATE dpackage_registration SET dpackage_status = 'canceled' WHERE dpackage_id = '$package_id'");

    $sql3 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
    $row3 = $sql3->fetch_assoc();
    $customer_id = $row3['dsender_id'];

    $sql4 = $conn->query("INSERT INTO dinbox SET duser_id = '$customer_id', dpackage_id = '$package_id', dinbox_status = '3' ");

    $sql5 = $conn->query("UPDATE driver_inbox SET inbox_status = '3' WHERE vehicle_id = '$vehicle_id' AND booking_id = '$id' ");

    $sql6 = $conn->query("INSERT INTO track_package SET booking_id = '$id', tracking_status = '2' ");

    if($conn->connect_error) {
        die("Connection Error".$conn->connect_error);

    } elseif($sql && $sql3 && $sql2 && $sql5 && $sql1 && $sql4) {
        $_SESSION['message'] = 'Booking'.' '.$id. ' '. 'cancelled succesfully';
        header("Location: ../pages/view_bookings.php");
    } else {
        $_SESSION['message'] = 'Unable to cancel booking'. ' '.$id;
        header("Location: ../pages/view_bookings.php");
    }

} else {
    $package_id = $_GET['id'];

    $sql1 = $conn->query("UPDATE dpackage_registration SET dpackage_status = 'canceled' WHERE dpackage_id = '$package_id'");

    $sql2 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
    $row2 = $sql2->fetch_assoc();
    $customer_id = $row2['dsender_id'];

    $sql3 = $conn->query("INSERT INTO dinbox SET duser_id = '$customer_id', dpackage_id = '$package_id', dinbox_status = '3' ");


    if($conn->connect_error) {
        die("Connection Error".$conn->connect_error);

    } elseif($sql1 && $sql2 && $sql3) {
        $_SESSION['deleted'] = 'Package Cancelled Succesfully';
        header("Location: ../pages/deliveries.php");
    } else {
        $_SESSION['deleted'] = 'Unable to cancel package';
        header("Location: ../pages/deliveries.php");
    }

}







?>
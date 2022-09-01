<?php
include '../includes/config.php';

$booking_id = $_GET['id'];
    $sql9 = $conn->query("DELETE FROM arrived_package WHERE booking = '$booking_id' ");

    $sql = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$booking_id'");
    $row = $sql->fetch_assoc();
    $package_id = $row['dpackage'];
    $sql2 = $conn->query("DELETE * FROM dinbox WHERE package_id = '$package_id'");

    if($sql9) {
        header("Location: ../pages/records.php");
    } else {
        echo 'Unable to connect to Sql';
    }

?>
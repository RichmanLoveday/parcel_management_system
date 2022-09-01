<?php

include '../includes/config.php';
$booking_id = $_GET['id'];
print_r($booking_id);

$sql = $conn->query("UPDATE dbooking SET dbooking_status = 'in-transit' WHERE dbooking_id = '$booking_id'");
$sql1 = $conn->query("INSERT INTO track_package SET booking_id = '$booking_id', tracking_status = '3'");
$sql2 = $conn->query("UPDATE driver_inbox SET inbox_status = '2' WHERE booking_id = '$booking_id' AND inbox_status = '1' ");

$sql3 = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$booking_id' ");
$row3 = $sql3->fetch_assoc();
$package_id = $row3['dpackage'];

$sql4 = $conn->query("SELECT * FROM ((dpackage_registration JOIN dstate_registration ON dstate_registration.dstate_id = dpackage_registration.dstate_id)
JOIN dlocation ON dlocation.dlocation_id = dpackage_registration.dlocation_id) WHERE dpackage_id = '$package_id'");
$row4 = $sql4->fetch_assoc();
$state = $row4['dstate_name'];
$terminal = $row4['dterminal'];


$_SESSION['transit'] = "<span class=alert-success my-10 style=padding:10px> Package is in transit to {$state}, {$terminal} terminal </span>"; 
header("Location:../pages/view_bookings.php");








//echo 'Yes';


?>
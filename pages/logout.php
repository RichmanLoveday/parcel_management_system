<?php

include_once '../includes/config.php';
$id = $_SESSION['staff_id'];
$position = $_SESSION['position'];

session_destroy();
header('Location: index.php');

if(isset($id) && $position == 'Office-staff') {
    $offline = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'offline' WHERE dstaff_id = '$id' AND (dstaff_status = 'online')");

} elseif(isset($id) && $position == 'Driver') {
    $offline = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'offline' WHERE dstaff_id = '$id' AND (dstaff_status = 'online')");

} elseif(isset($id) && $position == 'admin') {
    $offline = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'offline' WHERE dstaff_id = '$id' AND (dstaff_status = 'online')");
} elseif(isset($id) && isset($position)) {
    $offline = $conn->query("UPDATE duser_registration SET duser_status = 'offline' WHERE duser_id = '$id' AND (duser_status = 'online')");
} else {
    echo '';
}



?>
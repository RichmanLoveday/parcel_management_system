<?php

include '../includes/config.php';

$id = $_GET['id'];
//$username = $_GET['username'];

print_r($_GET);

if(isset($id)) {
    $sql = $conn->query("UPDATE dbooking SET dbooking_status = 'canceled' WHERE dbooking_id = '$id'");
    $sql1 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$id'");
    $row = $sql1->fetch_assoc();
    $package = $row['dpackage_name'];

    if($conn->connect_error) {
        die("Connection Error: ".$conn->connect_error);
    } elseif($sql) {
        $_SESSION['message'] = "<span class=alert-success style=padding:10px;> $package canceled  </span>";
        header("Location: ../pages/view_booking.php");
    } else {
        $_SESSION['message'] = "<span class=alert-success style=padding:10px;> $package not canceled  </span>";
        header("Location: ../pages/view_booking.php");
    }
}


?>
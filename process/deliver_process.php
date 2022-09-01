<?php
include_once '../includes/config.php';
echo 'Yes';
print_r($_POST);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $position = $_SESSION['position'];
    $id = $_SESSION['staff_id'];
    $terminal = $_SESSION['terminal'];
    $state = $_SESSION['state'];

    $pickup_id = $_POST['pickup_id'];
    $sql = $conn->query("SELECT * FROM arrived_package JOIN dbooking ON dbooking.dbooking_id = arrived_package.booking WHERE pickup_id = '$pickup_id'");
    $row = $sql->fetch_assoc();
    $package_id = $row['dpackage'];
    $booking_id = $row['booking'];

    $sql1 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id' ");
    $row1 = $sql1->fetch_assoc();
    $user_id = $row1['dsender_id'];



    $sql2 = $conn->query("INSERT INTO arrived_package SET staff = '$id', booking = '$booking_id', pickup_id = '$pickup_id', delivery_status = '2'");
    $sql3 = $conn->query("INSERT INTO track_package SET booking_id = '$booking_id', tracking_status = '5'");
    $sql4 = $conn->query("INSERT INTO dinbox SET duser_id = '$user_id', dpackage_id = '$package_id', dinbox_status = '5' ");

    $sql5 = $conn->query("UPDATE dbooking SET dbooking_status = 'delivered' WHERE dbooking_id = '$booking_id' ");
    $sql6 = $conn->query("UPDATE dpackage_registration SET dpackage_status = 'delivered' WHERE dpackage_id = '$package_id' ");

    if($sql && $sql1 && $sql3 && $sql4 && $sql5 && $sql6) {
        $_SESSION['delivered'] = "Package delivered successfully";
        header("Location: ../pages/pickup.php");
    } else {
        $_SESSION['delivered'] = "Package not delivered";
        header("Location: ../pages/pickup.php");
    }

}

?>
<?php
include '../includes/config.php';
echo 'Yes';
print_r($_POST);

$staff_id = $_SESSION['staff_id'];
$booking_id = $_POST['booking_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $sql = $conn->query("SELECT * FROM dbooking WHERE dbooking_id = '$booking_id'");
    $row = $sql->fetch_assoc();
    
    $package_id = $row['dpackage'];
    $sql1 = $conn->query("SELECT * FROM dpackage_registration WHERE dpackage_id = '$package_id'");
    $row1 = $sql1->fetch_assoc();
    $user_id = $row1['dsender_id'];
    $date = date('Y-m-d');
    
    if($sql && $sql1) {
        
        $sql2 = $conn->query("UPDATE dbooking SET dbooking_status = 'arrived' WHERE dbooking_id = '$booking_id'");
        $sql3 = $conn->query("UPDATE dpackage_registration SET dpackage_status = 'arrived' WHERE dpackage_id = '$package_id'");
        $sql4 = $conn->query("UPDATE driver_inbox SET inbox_status = '4', reg_date = '$date' WHERE booking_id = '$booking_id'");
        $sql5 = $conn->query("INSERT INTO dinbox SET dinbox_status = '4', duser_id = '$user_id', dpackage_id = '$package_id'");
        $sql6 = $conn->query("INSERT INTO track_package SET booking_id = '$booking_id', tracking_status = '4'");

        $pickup_id = gen_uid();
        $sql5 = $conn->query("INSERT INTO arrived_package SET pickup_id = '$pickup_id', staff = '$staff_id', booking = '$booking_id', delivery_status = '1'");
        
        $_SESSION['arrived'] = 'Package arrived terminal successully';
        header("Location:../pages/incoming_package.php");
        
    } else {
        $_SESSION['arrived'] = 'Problem accepting package';
        header("Location:../pages/incoming_package.php");
    }
    
}

?>
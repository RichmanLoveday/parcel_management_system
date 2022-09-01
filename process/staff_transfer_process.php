<?php

include_once '../includes/config.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $state = $_POST['state'];
    $terminal = $_POST['terminal'];
    $staff_id = $_POST['id'];
    //$_SESSION['staffid'] = $staff_id;
    

    // Query to update the location and the terminal
    $sql = $conn->query("UPDATE dstaff_registration SET dstaff_state = '$state', dterminal_id = '$terminal' WHERE dstaff_id = '$staff_id' ");

    $sql2 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = $staff_id");
    $row = $sql2->fetch_assoc();
    $fullname = $row['dfname'] . ' '.$row['dlname'];
    print_r($row);

    if($conn->connect_error) {
        die('Connection Error: '.$conn->connect_error);

    } elseif($sql == TRUE) {
        $_SESSION['transfer'] = "<span class=alert-success style=padding:10px> {$fullname} transfered Succesfully</span>";
        header("Location:../pages/view_staff.php");
    } else {
        $_SESSION['transfer'] = "<span class=alert-success style=padding:10px> {$fullname} transfered Succesfully</span>";
        header("Location:../pages/view_staff.php");
    }
}


?>
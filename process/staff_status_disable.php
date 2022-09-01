<?php

include "../includes/config.php";

// get the request from the url and store in a variable
$id = $_GET['id'];
$position = $_GET['position'];
$terminal = $_GET['terminal'];






// query database to update the status of the staff 


if(isset($id) && isset($position)) {
    
    $sql = $conn->query("UPDATE dstaff_registration SET dstaff_status = 'disabled' WHERE dstaff_id = '$id' AND dposition = '$position';");

    $sql1 = $conn->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$id'");
    $row1 = $sql1->fetch_assoc();
    $fname = $row1['dfname'];
    $lname = $row1['dlname'];

    if($conn->connect_error) {
        die("Connection Error: ".$conn->connect_error);
    } elseif($sql) {
        $_SESSION['status_change'] = "<span class=alert-success style=padding:10px;> $lname $fname disabled successfully </span>";
        header("Location: ../pages/view_staff.php?id=$id&position=$position"); 
    } else {
        $_SESSION['status_change'] = "<span class=alert-success style=padding:10px;>$lname $fname unable to disable </span>";
        header("Location: ../pages/view_staff.php?id=$id&position=$position"); 
    }

} elseif(isset($id) && isset($terminal)) {
    
    //query database to update the status of the the location and terminal
    $sqlx = $conn->query("UPDATE dlocation SET dlocation_status = 'disabled' WHERE dlocation_id = '$id' AND dterminal = '$terminal'");

    $sql2 = $conn ->query("SELECT * FROM dlocation WHERE dlocation_id = '$id'");
    $row2 = $sql2->fetch_assoc();
    $terminal_name = $row2['dterminal'];

    if($conn->connect_error) {
        die("Connection Error: ".$conn->connect_error);
    } elseif($sqlx) {
        $_SESSION['status_change'] = "<span class=alert-success style=padding:10px;> $terminal_name disabled successfully </span>";
        header("Location: ../pages/view_location.php?id=$id&terminal=$terminal"); 
    } else {
        $_SESSION['status_change'] = "<span class=alert-success style=padding:10px;> $terminal_name unable to disable </span>";
        header("Location: ../pages/view_location.php?id=$id&terminal=$terminal"); 
    }
}






?>
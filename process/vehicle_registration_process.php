<?php
ob_start();
include_once '../includes/config.php';
$error = false;


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo '<pre>';
    // print_r($_POST);
    // echo '<pre>';

    $vname= $_POST['v_name'];
    $vtype = $_POST['v_type'];
    $driver = $_POST['driver'];
    $vnum = $_POST['v_num'];
    $vehicle_dest = $_POST['vehicle_destination'];
   // print_r($vehicle_dest);


    


    if(empty($vname)) {
        $errVname = "<span class=text-danger> Pls fill in this field </span>";
        $error = true;
    } else {
        $vname = clean(ucfirst($_POST['v_name']));
    }

    if(empty($vtype)) {
        $errVtype = "<span class=text-danger> Pls fill in this field </span>";
        $error = true;
    } else {
        $vtype = clean(ucfirst($_POST['v_type']));
    }

    if(empty($vnum)) {
        $errVnum = "<span class=text-danger> Pls fill in this field </span>";
        $error = true;
    } else {
        $vnum = clean(ucfirst($_POST['v_num']));
    }

    if(empty($vehicle_dest)) {
        $errDest = "<span class=text-danger> Pls fill in this field </span>";
        $error = true;
    } else {
        $vehicle_dest = clean(ucfirst($_POST['vehicle_destination']));
    }

    // if(empty($driver)) {
    //     $errDrive = "<span class=text-danger> Pls fill in this field </span>";
    //     $error = true;
    // } else {
    //     $driver = clean(ucfirst($_POST['driver']));

    //     // checking if driver already exist
    //     $sql = $conn->query("SELECT * FROM dvehicle_registration WHERE ddriver_id = '$driver'");
    //     $sql1 = $conn ->query("SELECT * FROM dstaff_registration WHERE dstaff_id = '$driver'");
    //     if($conn->connect_error) {
    //         die("Connection Error: ".$conn->connect_error);

    //     } elseif($sql->num_rows > 0) {
    //         $row = $sql1->fetch_assoc();
    //         $errDrive = $row['dfname']. ' '.$row['dlname'] . ' '. "already assigned";
    //         $error = true;
    //     } else {
    //         echo '';
    //     }

    // }

    
    if($error == false) {
        $vehicle_id = date('Ymdhis');
        $sql = $conn->query("INSERT INTO dvehicle_registration SET ddriver_id = 'not-assigned', dvehicle_id = '$vehicle_id', dvehicle_num = '$vnum',  dvname = '$vname', dvehicle_dest = '$vehicle_dest', dvehicle_type = '$vtype', dvehicle_status = 'active'");

        if($conn -> connect_error) {
            die("Connection Error: ".$conn->connect_error);
        } elseif($sql == TRUE) {
            $_SESSION['vehicle'] = "<span class=alert-success style=padding:10px;> New Vehicle Registered </span>";
            header("Location: ../pages/view_vehicles.php");
        } else {
            $_SESSION['vehicle']  = "<span class=alert-success style=padding:10px;> Vehicle Not Registered </span>";
            header("Location: ../pages/view_vehicles.php");
        }
    }
}
ob_end_flush();

?>
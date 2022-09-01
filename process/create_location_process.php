<?php

include_once '../includes/config.php';
$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];

$error = false;


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $state = $_POST['state'];
    $terminal = $_POST['terminal'];
    //$state2 = $_POST['state1'];

    if(empty($state)) {
        $errState = 'Fill in this field';
        $error = true;
    } else {
        $state = clean(ucfirst($_POST['state']));
    }

    if(empty($terminal)) {
        $errTerm = 'Fill in this field';
        $error = true;
    } else {
        $terminal = clean(ucfirst($_POST['terminal']));
    }


    if($error == false) {

        $location_id = date('Ymdhis');
        $sql = $conn->query("INSERT INTO dlocation SET dlocation_id = '$location_id', dstate = '$state', dterminal = '$terminal', dlocation_status = 'active'; ");

        

        if($conn -> connect_error) {
            die("Connection Error: ".$conn -> connect_error);

        } elseif($sql) {
            $_SESSION['location_create'] = 'New location created';
            header("Location:../pages/view_location.php?id=$id");

        }  
        else {
            $_SESSION['location_create'] = 'Error in creating location';
        }
    }

}


?>
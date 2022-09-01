<?php

include_once '../includes/config.php';
$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];

$error = false;


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $state = $_POST['state'];

    
    if(empty($state)) {
        $errState = 'Fill in this field';
        $error = true;
    } else {

        $state = clean(ucfirst($_POST['state']));
        $sql = $conn->query("SELECT * FROM dstate_registration WHERE dstate_name = '$state' ");
        if($sql->num_rows > 0) {
            $errState = $state . ' ' . 'alraedy exists';
            $error = true;
        } else {
            $state = clean(ucfirst($_POST['state']));
        }
        
    }

    if($error == false) {
        $state_id = date('Ymdhis');
        $sql1 = $conn->query("INSERT INTO dstate_registration SET dstate_id = '$state_id', dstate_name = '$state'");

        if($sql1) { 
            $_SESSION['state_create'] = "<span class=alert-success style=padding:10px> State created successfully </span>";
            header("Location:../pages/create_state.php?id=$id");
        } else {
            echo '';
        }
    }
    

    

}


?>
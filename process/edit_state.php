<?php

include_once '../includes/config.php';
$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $state = $_POST['state'];
    $sql = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = '$id' ");
    $row1 = $sql->fetch_assoc();
    //print_r($_POST);
        if(empty($state)) {
            $errState = 'Pls fill in this field';
            $error = true;
        } else {
            $state = clean(ucfirst($_POST['state'])); 
        }

        if($error == false) {
            $sql1 = $conn->query("UPDATE dstate_registration SET dstate_name = '$state' WHERE dstate_id = '$id'; ");

            if($sql1) {
                $_SESSION['state_edit'] = "<span class=alert-success my-10 style=padding:10px> {$row1['dstate_name']} edited successfully </span>";
                header("Location:../pages/create_state.php?id=$id");
            } else {
                $_SESSION['state_edit'] = "<span class=alert-success my-10 style=padding:10px> {$row1['dstate_name']} not edited successfully </span>";
                header("Location:../pages/create_state.php?id=$id");
            }
        }
    

    

    
    

    

}

?>
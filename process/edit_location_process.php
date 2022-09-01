<?php

include '../includes/config.php';
$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    print_r($_POST);

    $sql = $conn->query("SELECT * FROM dlocation WHERE dlocation_id = '$id'");
    $row = $sql->fetch_assoc();
    $sql1 = $conn->query("SELECT * FROM dstate_registration WHERE dstate_id = '$id'");
    $row1 = $sql1->fetch_assoc();

    if($conn->connect_error) {
        die("Error in connection".$conn->connect_error);
        
    } elseif($sql) {
        $terminal = $_POST['terminal'];
        if(empty($terminal)) {
            $errTerm = 'Pls fill in this field';
            $error = true;
        } else {
            $terminal = clean(ucfirst($_POST['terminal']));
        }

        if($error == false) {
            $sql = $conn->query("UPDATE dlocation SET dterminal = '$terminal' WHERE dlocation_id = '$id'; ");
    
            if($sql) {
                $_SESSION['edit_successful'] =  "<span class=alert-success my-10 style=padding:10px> {$row['dterminal']} edited successfully </span>";
                header("Location:../pages/view_location.php?id=$id");
            } else {
                $_SESSION['edit_successful'] =  "<span class=alert-success my-10 style=padding:10px> {$row['dterminal']} not edited successfully </span>";
                header("Location:../pages/view_location.php?id=$id");
            }
        }
        
    } else {
        $state = $_POST['state'];
        if(empty($state)) {
            $errState = 'Pls fill in this field';
            $error = true;
        } else {
            $state = clean(ucfirst($_POST['state'])); 
        }

        if($error == false) {
            $sql = $conn->query("UPDATE dstate_registration SET dstate_name = '$state' WHERE dstate_id = '$id'; ");

            if($sql1) {
                $_SESSION['state_edit'] = "<span class=alert-success my-10 style=padding:10px> {$row1['dstate_name']} edited successfully </span>";
                header("Location:../pages/create_state.php?id=$id");
            } else {
                $_SESSION['state_edit'] = "<span class=alert-success my-10 style=padding:10px> {$row1['dstate_name']} not edited successfully </span>";
                header("Location:../pages/create_state.php?id=$id");
            }
        }
    } 
    

    

    
    

    

}

?>
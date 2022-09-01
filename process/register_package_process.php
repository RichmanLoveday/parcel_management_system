<?php
    include_once '../includes/config.php';
    $id = $_SESSION['staff_id'];
    $position = $_SESSION['position'];
    $error = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        $receiver_name = $_POST['rec_name'];
        $phone = $_POST['phn'];
        $package = $_POST['pack_name'];
        $state = $_POST['state'];
        $terminal = $_POST['terminal'];


        if(empty($receiver_name)) {
            $errRec = 'Pls input this field';
            $error = true;
        } else {
            $receiver_name = clean(ucfirst($_POST['rec_name']));
        }

        if(empty($phone)) {
            $errPhn = 'Pls input this field';
            $error = true;

        } else {
            $phone = clean($_POST['phn']);
        }

        if(empty($package)) {
            $errPack = 'Pls input this field';
            $error = true;

        } else {
            $package = clean(ucfirst($_POST['pack_name']));
        }

        if(empty($state)) {
            $errState = 'Pls input this field';
            $error = true;

        } else {
            $state = clean($_POST['state']);
        }

        if(empty($terminal)) {
            $errTerm = 'Pls input this field';
            $error = true;

        } else {
            $terminal = clean($_POST['terminal']);
        }

        if($error == false) {
            $package_id = date('Ymdhis');
            $sql = $conn->query("INSERT INTO dpackage_registration SET dpackage_id = '$package_id', dsender_id = '$id', dreceiver = '$receiver_name', dreceiver_phone = '$phone', dpackage_name = '$package', dstate_id = '$state', dlocation_id = '$terminal', dpackage_status = 'pending'; ");

            $sql1 = $conn->query("INSERT INTO dinbox SET duser_id = '$id', dpackage_id = '$package_id', dinbox_status = '1'; ");

            if($conn->connect_error) {
                die("Connection Error: ".$conn->conect_error);

            } elseif($sql) {
                $output = "<span class=alert-success style=padding:20px;>Package Registered Successfully</span>";
                header("Location: ../pages/inbox.php");
            } else {
                $_SESSION['message'] = "<span class=alert-success style=padding:20px;>Package Not Registered </span>";
            }
        }

    }

?>
<?php
include_once '../includes/config.php';
$position = $_SESSION['position'];
$id = $_SESSION['staff_id'];
$state = $_SESSION['state'];
$terminal = $_SESSION['terminal'];
$error= false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    $package_id = $_POST['package_id'];
    $driver = $_POST['driver'];
    $weight = $_POST['weight'];
    $amount = $_POST['amt'];
    $customer = $_POST['customer_id'];


    $sql = $conn->query("SELECT * FROM dbooking WHERE dpackage = '$package_id'");
    if($sql->num_rows > 0) {
        $_SESSION['booked'] = 'Package Booked already';
        $error = true;
    } else {
        echo '';
    }


    if($error == false) {
        $booking_id = date('Ymdhis');
        $weight = clean(preg_replace("/[^0-9]/", "", $weight));
        $amount = clean(preg_replace("/[^0-9]/", "", $amount));

        if($position == 'Office-staff') {
            $sql = $conn->query("INSERT INTO dbooking SET dbooking_id = '$booking_id', staff_id = '$id', dcustomer_id = '$customer', dweight = '$weight', dvehicle_id = '$driver', dlocation_id = '$terminal', dstate_id = '$state', damount = '$amount', dpackage = '$package_id', dbooking_status = 'booked' ");
        } else {
            $book_state = $_POST['book_state'];
            $book_term = $_POST['book_term'];
            
            $sql = $conn->query("INSERT INTO dbooking SET dbooking_id = '$booking_id', staff_id = '$id', dcustomer_id = '$customer', dweight = '$weight', dvehicle_id = '$driver', dlocation_id = '$book_term', dstate_id = '$book_state', damount = '$amount', dpackage = '$package_id', dbooking_status = 'booked' ");
        }
       


        $sql2 = $conn->query("INSERT INTO dinbox SET duser_id = '$customer', dpackage_id = '$package_id', dinbox_status = '2'; ");

        $sql3 = $conn->query("INSERT INTO driver_inbox SET vehicle_id = '$driver', booking_id = '$booking_id', inbox_status = '1' ");

        $sql4 = $conn->query("INSERT INTO track_package SET booking_id = '$booking_id', tracking_status = '1'");

    } 

    if($conn->connect_error) {
        die("Connection Error: ".$conn->connect_error);
    } elseif ($sql) {

        $sql2 = $conn->query("UPDATE dpackage_registration SET dpackage_status = 'approved' WHERE dpackage_id = '$package_id' ");

        // $sql = $conn->query("SELECT * FROM dbooking WHERE dpackage = '$package_id ");
        // $row = $sql->fetch_assoc();
        //$_SESSION['vehicle_id'] = $row['dvehicle_id'];
        
        unset($_SESSION['output']);
        $_SESSION['booked'] = 'Package successfully Booked';


    } 

    



}



?>
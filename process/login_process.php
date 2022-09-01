<?php

// Adding config file to the page 

include '../includes/config.php';

//Checking if the request method is equal to post method
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo 'Yes It is working';
    $_SESSION['status'];
    $_SESSION['success'];
    $_SESSION['staff_id'];
    $_SESSION['position'];
    $_SESSION['terminal'];
    $_SESSION['state'];
    $_SESSION['package_id'];

    //print_r($_POST);        // Prints an array of all post request
    $user = clean($_POST['user']);
    $password = md5($_POST['pass']);

    // if(empty($user)) {
    //     $userErr = 'Pls Input In this field';
    // } else {
    //     $user = clean($_POST['user']);
    // }

    // if(empty($password)) {
    //     $passErr = 'Pls Input In this field';
    // } else {
    //     $password = md5(clean($_POST['pass']));
    // }


    // Staff query to login
    $sql = $conn->query("SELECT * FROM dstaff_registration WHERE (demail = '$user' OR dusername = '$user') AND dpassword = '$password' ");

    $sqlx = $conn->query("SELECT * FROM duser_registration WHERE (demail = '$user' OR dusername = '$user') AND dpassword = '$password'");
    
   

    if($conn->connect_error) {
        die('Connection Error:' .$conn->connect_error);       // Checking if connection has an error

    } elseif($sql->num_rows > 0) {         // Checking if the row is greater than zero
        
        $row = $sql->fetch_assoc();  // Fetching an associate array of the row in database
        //$row1 = $sql1->fetch_assoc();

        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";

        // Selecting and storing in a variable
        $staff_id = $row['dstaff_id'];
        $position = $row['dposition'];
        $status = $row['dstaff_status'];
        $terminal = $row['dterminal_id'];
        $state = $row['dstaff_state'];
        

        $_SESSION['success'] = true;
        $_SESSION['staff_id'] = $staff_id;
        $_SESSION['position'] = $position;
        $_SESSION['status'] = $status;
        $_SESSION['terminal'] = $terminal;
        $_SESSION['state'] = $state;
        $_SESSION['package_id'] = $row1['dpackage_id'];
        $_SESSION['vehicle_id'] = $vehicle_id;
        header("Location:../pages/dashboard.php?id=$staff_id&position=$position");

    }  elseif( $sqlx->num_rows > 0) {
        
        $rowx = $sqlx->fetch_assoc();

        echo "<pre>";
        print_r($rowx);
        echo "</pre>";

        $user_id = $rowx['duser_id'];
        $username = $rowx['dusername'];
        $status = $rowx['duser_status'];

        $_SESSION['success'] = true;
        $_SESSION['staff_id'] = $user_id;
        $_SESSION['position'] = $username;
        $_SESSION['status'] = $status;
        header("Location:../pages/dashboard.php?id=$user_id&username=$username");
     } else {
        $_SESSION['wrong_input'] = "<span class=alert-danger my-10 style=padding:10px> Invalid email or password </span>";
        header("Location:../pages/login.php");
     }
    

    // Login for users
    // Query the users table to get datas for login
    
    // $_SESSION['wrong_input'] = "<span class=alert-danger my-10 style=padding:10px> Invalid Details </span>";
    // header("Location:login.php");

}

?>
<?php

session_start();

// connectiing mySql database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'package_delivery';
$conn = new mysqli($host, $user, $password, $dbname);



// Formating use in text inputs, incase of wrong inputs
function clean($data) {
    Global $conn;
    $data = htmlentities($data);
    $data = trim($data);
    $data = strip_tags($data);
    $data = $conn->real_escape_string($data);
    return $data;
}


function states() {
    $states = ['Abia', 'Adamawa', 'Akwa-Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross-river', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe','Zamfara', 'Fct'];
    foreach($states as $state) {
        $options = "<option value= $state> {$state} </options>";
        echo $options . ' ' . 'State';
        
    };
};


// Generating Unique ID
function gen_uid($lenght = 6) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $lenght);
};

?>